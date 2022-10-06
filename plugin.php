<?php

namespace AwesomeCoder\Plugin\Plagiarism\Core;

use AwesomeCoder\Plugin\Plagiarism\Controller\Awesomecoder;
use AwesomeCoder\Plugin\Plagiarism\Controller\Awesomecoder_Activator;
use AwesomeCoder\Plugin\Plagiarism\Controller\Awesomecoder_Deactivator;
use AwesomeCoder\Plugin\Plagiarism\Controller\Awesomecoder_Handler;
use AwesomeCoder\Plugin\Plagiarism\Controller\Awesomecoder_MetaBox;
use AwesomeCoder\Plugin\Plagiarism\Controller\Awesomecoder_Shortcode;

/**
 * Load core of the plugin.
 *
 * @link       https://awesomecoder.dev/
 * @since      1.0.0
 *
 * @package    Awesomecoder
 * @subpackage Awesomecoder/controller
 */

// If this file is called directly, abort.
!defined('WPINC') ? die : include(plugin_dir_path(__FILE__) . 'controller/class-awesomecoder.php');

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

class Plugin
{

	/**
	 *
	 * The code that runs during plugin activation.
	 * This action is documented in controller/class-awesomecoder-activator.php
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		Awesomecoder_Activator::activate();
	}

	/**
	 *
	 * The code that runs during plugin deactivation.
	 * This action is documented in controller/class-awesomecoder-deactivator.php
	 *
	 * @since    1.0.0
	 */
	public static function deactivate()
	{
		Awesomecoder_Deactivator::deactivate();
	}

	/**
	 *
	 * Begins execution of the plugin.
	 *
	 * Since everything within the plugin is registered via hooks,
	 * then kicking off the plugin from this point in the file does
	 * not affect the page life cycle.
	 *
	 * @since    1.0.0
	 *
	 */
	public static function core()
	{
		$instance = new Awesomecoder();
		$instance->run();

		// load shortcodes
		Awesomecoder_Shortcode::run();

		// load metabox
		$MetaBox = new Awesomecoder_MetaBox();
		$MetaBox->run();

		// load shortcodes
		Awesomecoder_Handler::init();
	}
}
