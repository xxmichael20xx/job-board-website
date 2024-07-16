<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://N/A
 * @since             1.0.0
 * @package           Job_Board_Website
 *
 * @wordpress-plugin
 * Plugin Name:       Job Board Website
 * Plugin URI:        https://N/A
 * Description:       A simple application for job board / posting for Employers. The application uses Filament for easy use on panel
and handles API requests for any platforms to use.
 * Version:           1.0.0
 * Author:            Michaelangelo Mamaclay
 * Author URI:        https://N/A/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       job-board-website
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'JOB_BOARD_WEBSITE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-job-board-website-activator.php
 */
function activate_job_board_website() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-job-board-website-activator.php';
	Job_Board_Website_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-job-board-website-deactivator.php
 */
function deactivate_job_board_website() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-job-board-website-deactivator.php';
	Job_Board_Website_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_job_board_website' );
register_deactivation_hook( __FILE__, 'deactivate_job_board_website' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-job-board-website.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_job_board_website() {

	$plugin = new Job_Board_Website();
	$plugin->run();

}
run_job_board_website();
