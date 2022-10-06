<?php

namespace AwesomeCoder\Plugin\Playstore\Admin\Controller;

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
class Awesomecoder_Activator
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate()
	{
		global $wpdb;

		if (!$wpdb->query("SHOW TABLES LIKE '%{$wpdb->prefix}sebt_licence%'")) {

			$create_licance = "CREATE TABLE `{$wpdb->prefix}sebt_licence` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`key` text NOT NULL,
				`websites` text NOT NULL DEFAULT '[]',
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
			dbDelta($create_licance);
		}

		if (!$wpdb->query("SHOW TABLES LIKE '%{$wpdb->prefix}sebt_users%'")) {

			$create_users = "CREATE TABLE `{$wpdb->prefix}sebt_users` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`email` varchar(255) NOT NULL,
				`websites` text NOT NULL DEFAULT '[]',
				PRIMARY KEY (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";

			dbDelta($create_users);
		}


		$wpdb->insert(
			`{$wpdb->prefix}sebt_users`,

		)
		$path = file_get_contents(AWESOMECODER_PATH . "sebt.json");
		echo '<pre>';
		print_r($path);
		echo '</pre>';
		die;
	}
}
