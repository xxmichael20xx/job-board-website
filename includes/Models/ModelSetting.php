<?php

class Job_Board_Website_Model_Setting extends Job_Board_Website_Model
{
	/**
	 * Create a new instance of Setting model
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Define the table name.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function table_name(): string
	{
		return JBW_TABLE_SETTINGS;
	}

	/**
	 * Get all settings.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function get_all_settings(): array
	{
		return $this->all();
	}

	/**
	 * Get the lone settings.
	 *
	 * @since 1.0.0
	 *
	 * @return array|object
	 */
	public function get_settings(): array|object
	{
		$sql = "SELECT * FROM {$this->table_name()} LIMIT 1";
		$result = $this->query_result( $sql );

		if ( count( $result ) < 1 ) {
			return [];
		}

		return data_get( $result, '0' );
	}

	/**
	 * Get the API token.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	public function get_token(): string
	{
		$settings = $this->get_settings();

		return data_get( $settings, '_token' );
	}
}
