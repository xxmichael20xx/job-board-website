<?php

use GuzzleHttp\Exception\GuzzleException;

class Job_Board_Website_API_Service
{
	/**
	 * The API Client wrapper.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var Job_Board_Website_API_Client $client
	 */
	protected Job_Board_Website_API_Client $client;

	/**
	 * The class for the setting model.
	 *
	 * @since 1.0.0
	 * @var Job_Board_Website_Model_Setting
	 */
	protected Job_Board_Website_Model_Setting $board_website_model_setting;

	/**
	 * The data to be processed.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	protected array $data;

	/**
	 * Create a new instance of API Service
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->client = new Job_Board_Website_API_Client();
		$this->board_website_model_setting = new Job_Board_Website_Model_Setting();
		$this->data = [];
	}

	/**
	 * Encrypt the password.
	 *
	 * @since 1.0.0
	 * @param string $password
	 *
	 * @return string
	 */
	protected function encrypt_password( string $password ): string
	{
		$encryption_key = JBW_API_SECRET_KEY;
		$cipher = "aes-256-cbc";
		$iv_length = openssl_cipher_iv_length( $cipher );
		$iv = openssl_random_pseudo_bytes( $iv_length );

		$encrypted_password = openssl_encrypt( $password, $cipher, $encryption_key, 0, $iv );
		return base64_encode( $encrypted_password . '::' . $iv );
	}

	/**
	 * Decrypt the encrypted password.
	 *
	 * @since 1.0.0
	 * @param string $encrypted_password
	 *
	 * @return string
	 */
	protected function decrypt_password( string $encrypted_password ): string
	{
		$encryption_key = JBW_API_SECRET_KEY;
		$cipher = "aes-256-cbc";

		list( $encrypted_data, $iv ) = explode( '::', base64_decode( $encrypted_password ), 2 );
		return openssl_decrypt( $encrypted_data, $cipher, $encryption_key, 0, $iv );
	}

	/**
	 * Authenticate and get a _token from the API.
	 *
	 * @since 1.0.0
	 * @param array $data
	 *
	 * @return void
	 * @throws GuzzleException
	 */
	public function authenticate( array $data ): void
	{
		$this->prepare_data( $data );

		( ! $this->get_existing_setting() )
			? $this->process_new_settings()
			: $this->process_update_settings();
	}

	/**
	 * Check if an existing setting exists.
	 *
	 * @since 1.0.0
	 *
	 * @return bool
	 */
	protected function get_existing_setting(): bool
	{
		return count( $this->board_website_model_setting->get_all_settings() ) > 0;
	}

	/**
	 * Prepare the request data.
	 *
	 * @since 1.0.0
	 * @param array $data
	 *
	 * @return void
	 */
	protected function prepare_data( array $data ): void
	{
		// Remove the 'action' from the request
		unset( $data['action'] );

		// Encrypt the password
		$encrypted_password = $this->encrypt_password( data_get( $data, 'api_password' ) );
		$data['api_password'] = $encrypted_password;

		$this->data = $data;
	}

	/**
	 * Create a new settings record.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 * @throws GuzzleException
	 */
	protected function process_new_settings(): void
	{
		// Prepare the credentials
		$email = data_get( $this->data, 'api_email' );
		$encrypted_password = data_get( $this->data, 'api_password' );

		// Save the credentials
		$this->board_website_model_setting->create([
			'email' => $email,
			'password' => $encrypted_password,
		]);

		$this->processToken();

		response_json([
			'status' => 'Success',
			'message' => 'Settings has been saved and token is generated!',
			'data' => []
		]);
	}

	/**
	 * Update the settings record.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	protected function process_update_settings(): void
	{
		//
	}

	/**
	 * Process the settings and fetch a token from API.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 * @throws GuzzleException
	 */
	protected function processToken(): void
	{
		$settings = $this->board_website_model_setting->get_settings();

		if ( ! $settings ) {
			response_json([
				'status' => 'Fail',
				'message' => 'Something went wrong!',
				'data' => [],
				'code' => 500
			]);
		} else {
			$id = data_get( $settings, 'id' );
			$email = data_get( $settings, 'email' );
			$password = $this->decrypt_password( data_get( $settings, 'password' ) );
			$response = $this->client->login( $email, $password );

			$token = data_get( $response, 'data._token' );
			$this->updateSettingToken( $id, $token );
		}
	}

	/**
	 * Update the token value.
	 *
	 * @param int $id
	 * @param string $token
	 *
	 * @return void
	 */
	protected function updateSettingToken( int $id, string $token ): void
	{
		$this->board_website_model_setting->update([
			'_token' => $token,
			'id' => $id
		]);
	}
}
