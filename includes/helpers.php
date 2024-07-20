<?php

use JetBrains\PhpStorm\NoReturn;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! function_exists( 'debug_log' ) ) {
    /**
     * Log custom messages to the debug.log file.
     *
     * @since 1.0.0
     *
     * @param mixed $data The data to log.
     * @return void
     */
    function debug_log( mixed $data ): void
    {
        if ( WP_DEBUG === true ) {
            if ( is_array( $data ) || is_object( $data ) ) {
                error_log( print_r( $data, true ) );
            } else {
                error_log( $data );
            }
        }
    }
}

if ( ! function_exists( 'data_get' ) ) {


	/**
	 * Retrieve an item from a nested array or object using "dot" notation.
	 *
	 * @param mixed $target The array or object to get the value from.
	 * @param array|string|null $key The key to retrieve the value for. Can be a string with dot notation or an array of keys.
	 * @param mixed $default The default value to return if the key does not exist.
	 *
	 * @return mixed The value from the target array or object, or the default value if the key does not exist.
	 */
	function data_get( mixed $target, array|string|null $key, mixed $default = null ): mixed {
		if ( is_null( $key ) ) {
			return $target;
		}

		$key = is_array( $key ) ? $key : explode( '.', $key );

		foreach ( $key as $segment ) {
			if ( is_array( $target ) && array_key_exists( $segment, $target ) ) {
				$target = $target[ $segment ];
			} elseif ( is_object( $target ) && property_exists( $target, $segment ) ) {
				$target = $target->{$segment};
			} else {
				return $default;
			}
		}

		return $target;
	}
}

if ( ! function_exists( 'response_json' ) ) {
	/**
	 * Send a json response.
	 *
	 * @param array $response
	 * @return void
	 */
	#[NoReturn]
	function response_json( array $response ): void
	{
		$data = data_get( $response, 'data', [] );
		$status = data_get( $response, 'status', 'Success' );
		$message = data_get( $response, 'message', 'Request Response' );
		$code = data_get( $response, 'code', 200 );

		wp_send_json([
			'status' => $status,
			'message' => $message,
			'data' => $data,
		], $code);
		wp_die();
	}
}
