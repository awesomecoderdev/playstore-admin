<?php

namespace AwesomeCoder\Plugin\Playstore\Admin\Controller;

use AwesomeCoder\Plugin\Playstore\Admin\Backend\Awesomecoder_Backend;
use AwesomeCoder\Plugin\Playstore\Admin\Frontend\Awesomecoder_Frontend;
use Exception;
use WP_REST_Controller;
use WP_REST_Server;

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
class Awesomecoder_API
{

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
		$this->namespace = 'awesomecoder/v1';
		$this->rest_base = 'verify';
	}

	/**
	 * Registers the routes for the objects of the controller.
	 *
	 * @return void
	 */
	public function register_routes()
	{
		register_rest_route(
			$this->namespace,
			'/' . $this->rest_base,
			[
				[
					'methods'             => WP_REST_Server::READABLE,
					'callback'            => [$this, 'verify_licance_key'],
					'permission_callback' => [$this, 'get_items_permissions_check'],
				],
			]
		);
	}

	/**
	 * Checks if a given request has access to read contacts.
	 *
	 * @param  \WP_REST_Request $request
	 *
	 * @return boolean
	 */
	public function get_items_permissions_check($request)
	{
		return true;
	}

	/**
	 * Retrieves a list of address items.
	 *
	 * @param  \WP_Rest_Request $request
	 *
	 * @return \WP_Rest_Response|WP_Error
	 */
	public function verify_licance_key()
	{
		global $wpdb;
		$request = $_REQUEST;
		$headers = getallheaders();
		$key = "iusamadurrani@gmail.com";
		$key = "sufyan.khalid41@gmail.com";
		$valid = false;
		if (isset($headers["Host"]) && $headers["Host"] != null && $headers["Host"] != "") {
			$host = $headers["Host"];
			$host = "google.com";
			// $host = "facebook.com";

			$db = "{$wpdb->prefix}sebt_licence";
			if (filter_var($key, FILTER_VALIDATE_EMAIL)) {
				$db = "{$wpdb->prefix}sebt_users";
				$results = $wpdb->get_results("SELECT * FROM $db WHERE `email`='$key'");
				if ($wpdb->num_rows == 1) {
					$response = current($results);
					$websites = [];

					if (!is_array($response->websites) && strpos($response->websites, "[") !== false) {
						$sites = str_replace(["[", "]", "\""], "", $response->websites);
						if (strpos($sites, ",") !== false) {
							$sites = explode(",", $sites);
							foreach ($sites as $i => $site) {
								if (strpos($site, "http://") !== false || strpos($site, "https://")  !== false) {
									$websites[] = parse_url($site, PHP_URL_HOST);
								} else {
									$websites[] = $site;
								}
							}
						} else {
							$websites[] = $sites;
						}
					} else {
						$websites = $response->websites;
					};


					if (count($websites) <= 2) {
						if (in_array($host, $websites)) {
							$valid = true;
						} else {
							if (count($websites) < 2) {
								$websites[] = $host;
							}
							$sql = "";
							foreach ($websites as $k => $web) {
								echo '<pre>';
								var_dump($web);
								echo '</pre>';
								if (!empty($web)) {
									echo "sdfadsf";
								}
							}
							$sql = (isset($websites[0]) && !empty($websites[0])) ? "\"$websites[0]\"" : false;
							if ($sql) {
								$sql .= isset($websites[1]) ? ",\"$websites[1]\"" : "";
							}
							echo '<pre>';
							print_r($websites);
							echo '</pre>';
							echo "sql $sql";
							die;

							try {
								$wpdb->update(
									$db,
									["websites" => "[$sql]"],
									["email" => $key]
								);
							} catch (Exception $e) {
								// continue
							}
							$valid = true;
						}
					} else {
						$valid = false;
					}
				}
			} else {
				echo "sql sdfasdfasdf";
				die;
				$results = [];
			}

			// echo '<pre>';
			// print_r($websites);
			// echo '</pre>';
			// die;

			$data = [
				"success" => $valid,
				"msg" => $request,
				"db" => $db,
				"query" => $results,
				"host" => $host
			];
		}


		// if (isset($request["key"]) && $request["key"] != null) {
		// 	// $key = $request["key"];
		// 	$key = "iusamadurrani@gmail.com";
		// 	$valid = false;
		// 	$db = "{$wpdb->prefix}sebt_licence";
		// 	if (filter_var($key, FILTER_VALIDATE_EMAIL)) {
		// 		$db = "{$wpdb->prefix}sebt_users";
		// 		$results = $wpdb->get_results("SELECT * FROM $db WHERE 'email'=$key");
		// 		echo '<pre>';
		// 		print_r($results);
		// 		echo '</pre>';
		// 		die;
		// 	} else {
		// 		$results = [];
		// 	}

		// 	$data = [
		// 		"success" => $valid,
		// 		"msg" => $request,
		// 		"db" => $db,
		// 		"query" => $results,
		// 	];
		// } else {
		// 	$data = [
		// 		"success" => false,
		// 		"msg" => "Unauthorize Access!"
		// 	];
		// }

		return wp_send_json($data, 200);
	}

	/**
	 * Retrieves the contact schema, conforming to JSON Schema.
	 *
	 * @return array
	 */
	public function start()
	{
		add_action('rest_api_init', [$this, 'register_routes']);
	}
}
