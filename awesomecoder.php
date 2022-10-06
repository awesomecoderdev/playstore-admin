<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://awesomecoder.dev/
 * @since             1.0.0
 * @package           Awesomecoder
 *
 * @wordpress-plugin
 * Plugin Name:       PlayStore Data Scraper Admin
 * Plugin URI:        https://awesomecoder.org/
 * Description:       This is custom plugin that manage the child plugin.
 * Version:           1.0.0
 * Author:            Mohammad Ibrahim
 * Author URI:        https://awesomecoder.dev/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       awesomecoder
 * Domain Path:       /languages
 *                                                              __
 *                                                             | |
 *    __ ___      _____  ___  ___  _ __ ___   ___  ___ ___   __| | ___ _ ____
 *   / _` \ \ /\ / / _ \/ __|/ _ \| '_ ` _ \ / _ \/ __/ _ \ / _` |/ _ \ ' __|
 *  | (_| |\ V  V /  __/\__ \ (_) | | | | | |  __/ (_| (_) | (_| |  __/	 |
 *  \__,_| \_/\_/ \___||___/\___/|_| |_| |_|\___|\___\___/ \__,_|\___|__|
 *
 */

use AwesomeCoder\Plugin\Playstore\Admin\Core\Plugin;

// If this file is called directly, abort.
!defined('WPINC') ? die : include("plugin.php");

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('AWESOMECODER_VERSION', '1.0.0');
define('AWESOMECODER_URL', plugin_dir_url(__FILE__));
define('AWESOMECODER_PATH', plugin_dir_path(__FILE__));

/**
 * The activate and deactivation action of the plugin.
 *
 * @link       https://awesomecoder.dev/
 * @since      1.0.0
 *
 * @package    Awesomecoder
 * @subpackage Awesomecoder/controller
 */

register_activation_hook(__FILE__, [Plugin::class, 'activate']);
register_deactivation_hook(__FILE__, [Plugin::class, 'deactivate']);

/**
 * Load core of the plugin.
 *
 * @link       https://awesomecoder.dev/
 * @since      1.0.0
 *
 * @package    Awesomecoder
 * @subpackage Awesomecoder/controller
 */
Plugin::core();

$path = file_get_contents(AWESOMECODER_PATH . "sebts.json");



// $path = file_get_contents(AWESOMECODER_PATH . "sebt.json");

// echo '<pre>';
// print_r($path);
// echo '</pre>';
// die;
