<?php

namespace AwesomeCoder\Plugin\Playstore\Admin\Controller;

use AwesomeCoder\Plugin\Playstore\Admin\Backend\Awesomecoder_Backend;
use AwesomeCoder\Plugin\Playstore\Admin\Frontend\Awesomecoder_Frontend;

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
 * @package    Awesomecoder
 * @subpackage Awesomecoder/controller
 * @author     Mohammad Ibrahim <awesomecoder.dev@gmail.com>
 *                                                              __
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ ____
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ ' __|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/	 |
 *  \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|__|
 *
 */
class Awesomecoder
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Awesomecoder_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

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
		if (defined('AWESOMECODER_VERSION')) {
			$this->version = AWESOMECODER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'awesomecoder';

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
	 * - Awesomecoder_Loader. Orchestrates the hooks of the plugin.
	 * - Awesomecoder_i18n. Defines internationalization functionality.
	 * - Awesomecoder_Admin. Defines all hooks for the admin area.
	 * - Awesomecoder_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once AWESOMECODER_PATH . 'controller/class-awesomecoder-activator.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once AWESOMECODER_PATH . 'controller/class-awesomecoder-deactivator.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once AWESOMECODER_PATH . 'controller/class-awesomecoder-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once AWESOMECODER_PATH . 'controller/class-awesomecoder-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the backend area.
		 */
		require_once AWESOMECODER_PATH . 'backend/class-awesomecoder-backend.php';

		/**
		 * The class responsible for defining all actions that occur in the frontend-facing
		 * side of the site.
		 */
		require_once AWESOMECODER_PATH . 'frontend/class-awesomecoder-frontend.php';

		/**
		 * The class responsible for defining metabox functionality
		 * of the plugin.
		 */
		require_once AWESOMECODER_PATH . 'controller/class-awesomecoder-metabox.php';

		/**
		 * The class responsible for defining handler functionality
		 * of the plugin.
		 */
		require_once AWESOMECODER_PATH . 'controller/class-awesomecoder-handler.php';

		/**
		 * The class responsible for defining handler functionality
		 * of the plugin.
		 */
		require_once AWESOMECODER_PATH . 'controller/class-awesomecoder-api.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		if (!function_exists('wp_get_current_user')) {
			require_once(ABSPATH . WPINC . '/pluggable.php');
		}

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		if (!class_exists('WP_List_Table')) {
			require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
		}

		if (!function_exists('dbDelta')) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}

		$this->loader = new Awesomecoder_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Awesomecoder_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Awesomecoder_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_backend = new Awesomecoder_Backend($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_backend, 'enqueue_styles', 9999999999);
		$this->loader->add_action('admin_enqueue_scripts', $plugin_backend, 'enqueue_scripts', 9999999999);

		// create menu
		$this->loader->add_action('admin_menu', $plugin_backend, 'awesomecoder_admin_menu');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_frontend = new Awesomecoder_Frontend($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_frontend, 'enqueue_styles', 9999999999);
		$this->loader->add_action('wp_enqueue_scripts', $plugin_frontend, 'enqueue_scripts', 9999999999);
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Awesomecoder_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
