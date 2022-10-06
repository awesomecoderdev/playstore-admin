<?php

namespace AwesomeCoder\Plugin\Plagiarism\Controller;

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

class Awesomecoder_Shortcode
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
	 * The array of page_id registered with WordPress.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $page_id    The error registered with WordPress to fire when the page_id page.
	 */
	public static $page;

	/**
	 * Define the core functionality of the woocommerce.
	 *
	 * Check woocommerce activated or not.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		// do something
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function awesomecoder_shortcode_callback($atts = array(), $content = null, $tag = '')
	{
		$layouts = [
			"an1",
			"apkdone",
			"apkmodule",
			"kingmodapk",
			"techbigs",
		];
		$awesomecoder = shortcode_atts(array(
			"posts_per_page" => 12,
			"paginate" => true,
			"category" => null,
			"layout" => null,
		), $atts);

		ob_start();
		if ($awesomecoder["layout"] != null && in_array($awesomecoder["layout"], $layouts)) {
			include_once AWESOMECODER_PATH . 'frontend/views/shortcode/' . strtolower($awesomecoder["layout"]) . '.php';
		} else {
			include_once AWESOMECODER_PATH . 'frontend/views/shortcode/apps.php';
		}
		$apps = ob_get_contents();
		ob_end_clean();
		return $apps;
	}


	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function awesomecoder_single_shortcode_callback($atts = array(), $content = null, $tag = '')
	{

		$awesomecoder = shortcode_atts(array(
			"layout" => null,
		), $atts);

		ob_start();
		include_once AWESOMECODER_PATH . 'frontend/views/single/apps.php';
		$apps = ob_get_contents();
		ob_end_clean();
		return $apps;
	}

	/**
	 *  It is the shortcode functions of the template
	 *
	 * It will reutn the search box on a page
	 *
	 */
	public static function run()
	{
		add_shortcode('ac_playstore_apps', [__CLASS__, 'awesomecoder_shortcode_callback']);
		add_shortcode('ac_playstore_single_apps', [__CLASS__, 'awesomecoder_single_shortcode_callback']);
	}
}
