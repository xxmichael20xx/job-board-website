<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://N/A
 * @since      1.0.0
 *
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Job_Board_Website
 * @subpackage Job_Board_Website/includes
 * @author     Michaelangelo Mamaclay <mamaclaymichael20@gmail.com>
 */
class Job_Board_Website
{
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var Job_Board_Website_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected Job_Board_Website_Loader $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected string $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since 1.0.0
	 * @access protected
	 * @var string $version The current version of the plugin.
	 */
	protected string $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
    {
		if ( defined( 'JOB_BOARD_WEBSITE_VERSION' ) ) {
			$this->version = JOB_BOARD_WEBSITE_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'job-board-website';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Job_Board_Website_Loader. Orchestrates the hooks of the plugin.
	 * - Job_Board_Website_i18n. Defines internationalization functionality.
	 * - Job_Board_Website_Admin. Defines all hooks for the admin area.
	 * - Job_Board_Website_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
     * @return void
	 */
	private function load_dependencies(): void
    {
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-job-board-website-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-job-board-website-i18n.php';

        /**
         * The file responsible for helper functions of the plugin.
         */
        require_once plugin_dir_path( dirname( __FILE__) ) . 'includes/helpers.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-job-board-website-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-job-board-website-public.php';

		$this->loader = new Job_Board_Website_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Job_Board_Website_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
     * @return void
	 */
	private function set_locale(): void
    {
		$plugin_i18n = new Job_Board_Website_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since 1.0.0
	 * @access private
     * @return void
	 */
	private function define_admin_hooks(): void
    {
		$plugin_admin = new Job_Board_Website_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
	}

	/**
	 * Register all the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since 1.0.0
	 * @access private
     * @return void
	 */
	private function define_public_hooks(): void
    {
		$plugin_public = new Job_Board_Website_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all the hooks with WordPress.
	 *
	 * @since 1.0.0
     * @return void
	 */
	public function run(): void
    {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since 1.0.0
	 * @return string The name of the plugin.
	 */
	public function get_plugin_name(): string
    {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since 1.0.0
	 * @return Job_Board_Website_Loader Orchestrates the hooks of the plugin.
	 */
	public function get_loader(): Job_Board_Website_Loader
    {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since 1.0.0
	 * @return string The version number of the plugin.
	 */
	public function get_version(): string
    {
		return $this->version;
	}
}
