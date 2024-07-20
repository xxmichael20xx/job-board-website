<?php

use GuzzleHttp\Exception\GuzzleException;

class Job_Board_Website_Ajax_Hooks
{
	/**
	 * The ID of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $plugin_name The ID of this plugin.
	 */
	private string $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string $version The current version of this plugin.
	 */
	private string $version;

	/**
	 * The API Service for the Job Boards Website API.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var Job_Board_Website_API_Service $api_service
	 */
	protected Job_Board_Website_API_Service $api_service;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since 1.0.0
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 */
	public function __construct( string $plugin_name, string $version )
	{
		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->api_service = new Job_Board_Website_API_Service();
	}

	/**
	 * Define the ajax hooks.
	 *
	 * @since 1.0.0
	 *
	 * @return array<string>
	 */
	public static function defineAjaxHooks(): array
	{
		return [
			'jbw_save_settings'
		];
	}

	/**
	 * Save the settings into the database.
	 * Sending an API request to the external API for token generation.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 * @throws GuzzleException
	 */
	public function jbw_save_settings(): void
	{
		$data = array_map( 'sanitize_text_field', $_POST );
		$this->api_service->authenticate( $data );
	}
}
