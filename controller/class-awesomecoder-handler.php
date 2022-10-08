<?php

namespace AwesomeCoder\Plugin\Playstore\Admin\Controller;

use DOMDocument;
use WP_Query;

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
class Awesomecoder_Handler
{

	/**
	 * The array of error registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $error    The error registered with WordPress to fire when the login errors.
	 */
	public static $error = null;

	/**
	 * The array of error registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $error    The error registered with WordPress to fire when the login errors.
	 */
	public static $success = null;

	/**
	 * The array of page_id registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $page_id    The error registered with WordPress to fire when the page_id page.
	 */
	public static $page;

	/**
	 * The instacne of the woocommerce.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      bool    $instance    The instacne of the woocommerce.
	 */
	private static $instance = false;

	/**
	 * The metabox of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      array    $post_types    Skip the post types.
	 */
	private static $post_types = [
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
	 * Define the core functionality of the woocommerce.
	 *
	 * Check woocommerce activated or not.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		// do somethings
	}


	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function frontend_ajax_handler()
	{
		$request = json_decode(file_get_contents('php://input'));
		echo json_encode($_REQUEST);

		// end ajax
		wp_die();
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function backend_ajax_handler()
	{
		$path = isset($_REQUEST["path"]) ? strtolower($_REQUEST["path"]) : "err";
		global $wpdb;

		if ($path == "license") {
			$db = "{$wpdb->prefix}sebt_licence";
			$key = self::generateLicenseKey();
			$wpdb->insert(
				$db,
				["key" => $key,]
			);

			$licenses = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sebt_licence ORDER BY id DESC");
			$licenses = array_chunk($licenses, 120);

			echo json_encode([
				"success" => true,
				"key" => $key,
				"licenses" => $licenses
			]);
		} else {
			echo json_encode([
				"success" => false,
				"msg" => "Something went wrong!",
			]);
		}

		// end ajax
		wp_die();
	}


	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function generateLicenseKey($length = 50)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return str_replace("=", $characters[rand(0, $charactersLength - 1)], $randomString . base64_encode(time() . date("d M Y H:i:s'.")));
	}


	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function init()
	{
		// add_action('template_redirect', [__CLASS__, 'redirect_to']);
		// add_action('init', array(__CLASS__, 'init'));


		// backend
		add_action("wp_ajax_awesomecoder_admin_backend", [__CLASS__, 'backend_ajax_handler']);
		// add_action("wp_ajax_nopriv_awesomecoder_backend", [__CLASS__, 'backend_ajax_handler']);

		// frontend
		// add_action("wp_ajax_awesomecoder_frontend", [__CLASS__, 'frontend_ajax_handler']);
		// add_action("wp_ajax_nopriv_awesomecoder_frontend", [__CLASS__, 'frontend_ajax_handler']);
	}
}
