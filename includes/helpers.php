<?php

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
