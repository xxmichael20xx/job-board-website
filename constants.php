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
	define( 'JBW_PLUGIN_DIR', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'JBW_API_URL' ) ) {
	define( 'JBW_API_URL', 'https://job-board-website-api.dev/api/v1' );
}

if ( ! defined( 'JBW_API_SECRET_KEY' ) ) {
	define ( 'JBW_API_SECRET_KEY', '8647f59da1661c6ee2ccbe7dca302cdc989eb9b8d2802756f1d56944d455d4e7' );
}
