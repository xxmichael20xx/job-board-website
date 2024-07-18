<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if ( ! defined( 'JBW_TABLE_PREFIX' ) ) {
    define( 'JBW_TABLE_PREFIX', 'job_board_website_' );
}

if ( ! defined( 'JBW_TABLE_SETTINGS' ) ) {
    define( 'JBW_TABLE_SETTINGS', JBW_TABLE_PREFIX . 'settings' );
}

if ( ! defined( 'JBW_PLUGIN_DIR' ) ) {
	define( 'JBW_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}
