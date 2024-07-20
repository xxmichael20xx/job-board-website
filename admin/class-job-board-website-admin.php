<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://N/A
 * @since      1.0.0
 *
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/admin
 * @author     Michaelangelo Mamaclay <mamaclaymichael20@gmail.com>
 */
class Job_Board_Website_Admin
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
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since 1.0.0
	 *
     * @return void
	 */
	public function enqueue_styles(): void
    {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Job_Board_Website_Loader as all the hooks are defined
		 * in that particular class.
		 *
		 * The Job_Board_Website_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'css/job-board-website-admin.css',
            array(),
            $this->version,
        );

		// Enqueue the compiled tailwind css file
		wp_enqueue_style(
            'jbw-main-css',
			JBW_PLUGIN_DIR . 'build/css/jbw-main.css',
            array(),
            $this->version,
        );

		// Enqueue SweetAlert2 CDN
	    wp_enqueue_script(
			'sweetalert2-cdn-script',
		    'https://cdn.jsdelivr.net/npm/sweetalert2@11'
	    );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since 1.0.0
	 *
     * @return void
	 */
	public function enqueue_scripts(): void
    {
		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Job_Board_Website_Loader as all the hooks are defined
		 * in that particular class.
		 *
		 * The Job_Board_Website_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . 'js/job-board-website-admin.js',
            array( 'jquery' ),
            $this->version,
            false
        );
	}

	/**
	 * Define the admin dashboard settings page.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function define_settings_page(): void
	{
		$settingsPage = add_menu_page(
			'JBW - Settings',
			'JBW - Settings',
			'manage_options',
			'jbw-settings',
			array( $this, 'settings_page_display' ),
			'dashicons-admin-generic',
		);

		add_action( 'load-' . $settingsPage, array( $this, 'settings_page_enqueue' ) );
	}

	/**
	 * Define the settings page display.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function settings_page_display(): void
	{
		require_once plugin_dir_path( __FILE__ ) . 'partials/job-board-website-admin-settings-page.php';
	}

	/**
	 * Enqueue the script for the settings page.
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function settings_page_enqueue(): void
	{
		wp_enqueue_script(
			'jbw-settings-page-script',
			plugin_dir_url( __FILE__ ) . 'js/job-board-website-settings-page-script.js',
			array( 'jquery' ),
			$this->version,
			true
		);

		wp_localize_script(
			'jbw-settings-page-script',
			'jbwSettingsPageScript',
			[
				'ajaxUrl' => admin_url( 'admin-ajax.php' )
			]
		);
	}
}
