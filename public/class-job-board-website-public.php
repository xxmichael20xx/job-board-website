<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://N/A
 * @since      1.0.0
 *
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/public
 * @author     Michaelangelo Mamaclay <mamaclaymichael20@gmail.com>
 */
class Job_Board_Website_Public {

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
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of the plugin.
	 * @param string $version The version of this plugin.
	 * @since 1.0.0
	 */
	public function __construct(string $plugin_name, string $version)
    {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since 1.0.0
     * @return void
	 */
	public function enqueue_styles(): void
    {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Job_Board_Website_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Job_Board_Website_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/job-board-website-public.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since 1.0.0
     * @return void
	 */
	public function enqueue_scripts(): void
    {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Job_Board_Website_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Job_Board_Website_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/job-board-website-public.js', array( 'jquery' ), $this->version, false );
	}
}
