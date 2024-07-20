<?php

abstract class Job_Board_Website_Model
{
	/**
	 * @since 1.0.0
	 * @var wpdb $wpdb WordPress database abstraction object
	 */
	public wpdb $wpdb;

	abstract public function table_name(): string;

	/**
	 * Create a new instance of Model.
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		global $wpdb;
		$this->wpdb = $wpdb;
	}

	/**
	 * Save a record.
	 *
	 * @since 1.0.0
	 * @param array $data
	 *
	 * @return int|bool
	 */
	public function create( array $data ): int|bool
	{
		return $this->wpdb->insert(
			$this->table_name(),
			$data
		);
	}

	/**
	 * Update a record.
	 *
	 * @since 1.0.0
	 * @param array $data
	 *
	 * @return int|bool
	 */
	public function update( array $data ): int|bool
	{
		return $this->wpdb->update(
			$this->table_name(),
			$data,
			[
				'id' => $data['id']
			]
		);
	}

	/**
	 * Get records as associative array.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	public function all(): array
	{
		$query = "SELECT * FROM {$this->table_name()}";
		return $this->wpdb->get_results( $query, ARRAY_A );
	}

	/**
	 * @param string $sql
	 *
	 * @since 1.0.0
	 *
	 * @return int|bool|mysqli_result|null
	 */
	public function query(string $sql): int|bool|null|mysqli_result
	{
		return $this->wpdb->query( $sql );
	}

	/**
	 * Query sql as array result.
	 *
	 * @since 1.0.0
	 * @param string $sql
	 *
	 * @return array|object|null
	 */
	public function query_result( string $sql ): array|object|null
	{
		return $this->wpdb->get_results( $sql, ARRAY_A );
	}
}
