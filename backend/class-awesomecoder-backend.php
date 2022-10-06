<?php

namespace AwesomeCoder\Plugin\Playstore\Admin\Backend;

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
class Awesomecoder_Backend
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The pages of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $pages    The pages of this plugin.
	 */
	private  $pages;

	/**
	 * The metabox of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $metabox    The metabox of this plugin.
	 */
	private  $metabox;


	/**
	 * The metabox of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $post_types    Skip the post types.
	 */
	private  $post_types = [
		'attachment',
		'revision',
		'nav_menu_item',
		"attachment",
		"custom_css",
		"customize_changeset",
		"nav_menu_item",
		"oembed_cache",
		"product_variation",
		"revision",
		"shop_coupon",
		"shop_order",
		"shop_order_placehold",
		"shop_order_refund",
		"user_request",
		"wp_block",
		"wp_global_styles",
		"wp_navigation",
		"wp_template",
		"wp_template_part",
	];

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		// $icon = AWESOMECODER_PATH . "backend/icons/icon.svg";
		// $icon = file_get_contents($icon);
		// $icon = base64_encode($icon);
		// $this->icon = "data:image/svg+xml;base64,$icon";

		$this->pages = [
			"toplevel_page_playstore",
		];

		$this->metabox = [
			"post.php",
			"post-new.php",
		];
	}

	/**
	 * Initialize the main menu and set its properties.
	 *
	 * @since    1.0.0
	 *
	 */
	public function awesomecoder_admin_menu()
	{
		$icon = "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyMyAyMyIgc3R5bGU9ImZpbGw6IzcyYWVlNiI+PHBhdGggZD0ibTEyLjk1NCAxMS42MTYgMi45NTctMi45NTdMNi4zNiAzLjI5MWMtLjYzMy0uMzQyLTEuMjI2LS4zOS0xLjc0Ni0uMDE2bDguMzQgOC4zNDF6bTMuNDYxIDMuNDYyIDMuMDc0LTEuNzI5Yy42LS4zMzYuOTI5LS44MTIuOTI5LTEuMzQgMC0uNTI3LS4zMjktMS4wMDQtLjkyOC0xLjM0bC0yLjc4My0xLjU2My0zLjEzMyAzLjEzMiAyLjg0MSAyLjg0ek00LjEgNC4wMDJjLS4wNjQuMTk3LS4xLjQxNy0uMS42NTh2MTQuNzA1YzAgLjM4MS4wODQuNzA5LjIzNi45N2w4LjA5Ny04LjA5OEw0LjEgNC4wMDJ6bTguODU0IDguODU1TDQuOTAyIDIwLjkxYy4xNTQuMDU5LjMyLjA5LjQ5NS4wOS4zMTIgMCAuNjM3LS4wOTIuOTY4LS4yNzZsOS4yNTUtNS4xOTctMi42NjYtMi42N3oiPjwvcGF0aD48L3N2Zz4=";
		add_menu_page(__("Playstore", "awesomecoder"), __("Playstore", "awesomecoder"), 'manage_options', 'playstore', array($this, 'menu_activator_callback'), $icon, 50);
		add_submenu_page('playstore', __("Dashboard", "awesomecoder"), __("Dashboard", "awesomecoder"), 'manage_options', 'playstore', array($this, 'awesomecoder_dashboard_callback'));
	}

	/**
	 * Initialize the menu.
	 *
	 * @since    1.0.0
	 *
	 */
	public function menu_activator_callback()
	{
		// activate admin menu
	}

	/**
	 * Initialize the view of dashboard page.
	 *
	 * @since    1.0.0
	 *
	 */
	public function awesomecoder_dashboard_callback()
	{
		ob_start();
		include_once AWESOMECODER_PATH . 'backend/views/index.php';
		$index = ob_get_contents();
		ob_end_clean();
		echo $index;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook)
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Awesomecoder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Awesomecoder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if (in_array($hook, $this->pages)) {
			wp_enqueue_style("{$this->plugin_name}", AWESOMECODER_URL . 'assets/css/app.css', array(), (filemtime(AWESOMECODER_PATH . "assets/css/app.css") ?? $this->version), 'all');
			wp_enqueue_style("{$this->plugin_name}-backend", AWESOMECODER_URL . 'backend/css/backend.css', array(), filemtime(AWESOMECODER_PATH . "backend/css/backend.css"), 'all');
		}

		// metabox css
		if (in_array($hook, $this->metabox)) {
			// wp_enqueue_style("{$this->plugin_name}-metabox", AWESOMECODER_URL . 'backend/css/metabox.css', array(), filemtime(AWESOMECODER_PATH . "backend/css/metabox.css"), 'all');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook)
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Awesomecoder_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Awesomecoder_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script("{$this->plugin_name}", AWESOMECODER_URL . 'backend/js/awesomecoder-init.js', array('jquery'), (filemtime(AWESOMECODER_PATH . "backend/js/awesomecoder-init.js") ?? $this->version), false);
		// Some local vairable to get ajax url
		$post_types = array_diff(get_post_types(), $this->post_types);
		wp_localize_script($this->plugin_name, 'awesomecoder', array(
			"plugin" => [
				"name"		=> 	"WP Plagiarism",
				"author" 	=>	"Mohammad Ibrahim",
				"email" 	=>	"awesomecoder.dev@gmail.com",
				"website" 	=>	"https://awesomecoder.dev",
			],
			"url" 			=> get_bloginfo('url'),
			"ajaxurl"		=> admin_url("admin-ajax.php?action=awesomecoder_backend"),
			"post_types"	=> $post_types,
			// "posts" 		=> get_posts([
			// 	'post_type' => $post_types,
			// 	'posts_per_page' => -1,
			// 	// 'order' => $sort_by,
			// 	'orderby' => 'title',
			// 	'post_status' => 'publish',
			// 	// 'tag' => $tags,
			// 	'ignore_sticky_posts' => 1,
			// ])
		));

		if (in_array($hook, $this->pages)) {
			wp_enqueue_script("{$this->plugin_name}-backend", AWESOMECODER_URL . 'backend/js/backend.js', array('jquery'), (filemtime(AWESOMECODER_PATH . "backend/js/backend.js") ?? $this->version), true);
		}

		// metabox css
		if (in_array($hook, $this->metabox)) {
			// wp_enqueue_script("{$this->plugin_name}-metabox", AWESOMECODER_URL . 'backend/js/metabox.js', array('jquery'), (filemtime(AWESOMECODER_PATH . "backend/js/metabox.js") ?? $this->version), true);
		}
	}
}
