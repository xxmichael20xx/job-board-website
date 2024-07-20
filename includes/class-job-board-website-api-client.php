<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\StreamInterface;

class Job_Board_Website_API_Client
{
	/** @var string $api_url */
	public string $api_url;

	/** @var Client $client */
	public Client $client;

	/**
	 * Create a new instance of API Service
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		$this->api_url = JBW_API_URL;
		$this->client = new Client([
			'base_uri' => $this->api_url
		]);
	}

	/**
	 * Send a post request.
	 *
	 * @since 1.0.0
	 * @param string $uri
	 * @param array $body
	 *
	 * @return array
	 * @throws GuzzleException
	 */
	public function send_post( string $uri, array $body ): array
	{
		$body['device_name'] = $_SERVER['HTTP_USER_AGENT'];

		$response = $this->client->post(
			$uri,
			[
				'verify' => false,
				'headers' => [
					'Accept' => 'application/json',
				],
				'json' => $body
			]
		);

		return json_decode( $response->getBody(), true );
	}

	/**
	 * Authenticate the user to the API.
	 *
	 * @since 1.0.0
	 * @param string $email
	 * @param string $password
	 *
	 * @return array
	 * @throws GuzzleException
	 */
	public function login( string $email, string $password ): array
	{
		$body = [
			'email' => $email,
			'password' => $password
		];

		return $this->send_post( 'login', $body );
	}
}
