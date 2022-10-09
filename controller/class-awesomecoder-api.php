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
		$headers = getallheaders();
		if (isset($headers["Host"], $_REQUEST["key"]) && $headers["Host"] != null && $headers["Host"] != "") {
			$host = $headers["Host"];
			$key = $_REQUEST["key"];
			$host = (strpos($host, "http://") !== false || strpos($host, "https://")  !== false) ? parse_url($host, PHP_URL_HOST) : $host;
			$data = [
				"success" => false,
				"host" => $host,
			];
			$db = "{$wpdb->prefix}sebt_licence";
			if (filter_var($key, FILTER_VALIDATE_EMAIL)) {
				// for sebt email
				$data["access"] = "email";
				$db = "{$wpdb->prefix}sebt_users";
				$results = $wpdb->get_results("SELECT * FROM $db WHERE `email`='$key'");
				if ($wpdb->num_rows > 0 && $wpdb->num_rows == 1) {
					$licance = current($results);
					$websites = json_decode($licance->websites, true);
					$websites = is_array($websites) || is_object($websites) ? $websites : [];
					if (count($websites) <= 2) { // can go for check
						if (isset($websites[$host])) { // exist website
							$website = $websites[$host];
							$expired = isset($website["expired"]) ? $website["expired"] : date("Y-m-d", strtotime("-1 year"));
							$expired = date("Y-m-d", strtotime($expired));
							$today = date("Y-m-d");
							if ($today > $expired) {
								$data["success"] = false;
							} else {
								$data["success"] = true;
							}
							$data["expired"] = $expired;
						} else {
							if (count($websites) < 2) { //can add website
								$websites[$host] = [
									"websites" => $host,
									"expired" => date('Y-m-d H:i:s', strtotime('+1 year')),
								];
								try {
									$update = $wpdb->update(
										$db,
										["websites" => json_encode($websites)],
										["email" => $key]
									);
									if ($update) {
										$data["success"] = true;
									}
								} catch (Exception $e) {
									// continue
									$data["success"] = false;
								}
							} else { // can not add website
								$data["success"] = false;
							}
						}
					} else { // can't add website
						$data["success"] = false;
					}
					// $data["websites"] = $websites;
				} else {
					// multiple licance or don't have licance
					$data["success"] = false;
				}
			} else { // for licance key -> done
				$data["access"] = "licance";
				$query = "SELECT * FROM $db WHERE `key`='$key'";
				$res = $wpdb->get_results($query);
				// $data["res"] = $res;
				// $data["num_rows"] = $wpdb->num_rows;
				// $data["query"] = $query;
				// $data["expired"] =  date('Y-m-d H:i:s', strtotime('+1 year'));
				if ($wpdb->num_rows > 0 && $wpdb->num_rows == 1) {
					$licance = current($res);
					$expired = date("Y-m-d", strtotime($licance->expired));
					$data["expired"] = $expired;
					if (empty($licance->websites) || $licance->websites == null) {
						try {
							$update = $wpdb->update(
								$db,
								[
									"websites" => $host,
									"expired" => date('Y-m-d H:i:s', strtotime('+1 year')),
								],
								["key" => $key]
							);
							if ($update) {
								$data["success"] = true;
							}
						} catch (Exception $e) {
							// continue
							$data["success"] = false;
						}
					} else { // process if website exist
						if (isset($licance->websites) && $licance->websites == $host) {
							$today = date("Y-m-d");
							if ($today > $expired) {
								$data["success"] = false;
							} else {
								$data["success"] = true;
							}
						}
					}
					// $data["websites"] = $licance;
				} else {
					// multiple licance or don't have licance
					$data["success"] = false;
					$data["isValid"] = "that can not process";
				}
			}
		} else { // don't have host return false;
			$data["success"] = false;
			$data["msg"] = "Unauthorize access!";
		}
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
