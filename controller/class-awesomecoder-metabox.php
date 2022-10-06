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
class Awesomecoder_MetaBox
{
    /**
     * The instacne of the metabox.
     *
     * @since    1.0.0
     * @access   private
     * @var      bool    $instance    The instacne of the metabox.
     */
    private $instance = false;

    /**
     * Define the core functionality of the metabox.
     *
     * Check metabox activated or not.
     *
     * @since    1.0.0
     */
    public function __construct()
    {
        // do something
    }

    /**
     * Define the metabox of the product.
     *
     * @since    1.0.0
     */
    public function post()
    {
        ob_start();
        include_once AWESOMECODER_PATH . 'backend/views/metabox/post.php';
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

    /**
     * Define the metabox of the page.
     *
     * @since    1.0.0
     */
    public function save_post_metadata($post_id, $post, $update)
    {
        $fields = [
            // "awesomecoder_app_icon",
            "awesomecoder_app_downloads",
            "awesomecoder_app_stars",
            "awesomecoder_app_ratings",
            "awesomecoder_app_devName",
            "awesomecoder_app_devLink",
            "awesomecoder_app_compatible_with",
            "awesomecoder_app_size",
            "awesomecoder_app_last_version",
            "awesomecoder_app_link",
            "awesomecoder_app_price",
        ];

        foreach ($fields as $key => $option) {
            if (isset($_POST[$option])) {
                $value = $_POST[$option] ?? "";
                update_post_meta($post_id, $option, $value);
            }
        }

        if (isset($_POST["awesomecoder_app_icon"])) {
            $icon = $_POST["awesomecoder_app_icon"] ?? "";
            if (strpos($icon, site_url("/")) === false) {
                $response = wp_remote_get($icon);
                if (!is_wp_error($response)) {
                    $icon = md5($icon . date("Y_m_d") . time());
                    $upload = wp_upload_bits("$icon.png", null, file_get_contents($_POST["awesomecoder_app_icon"]));
                    $icon = $upload["url"] ?? $icon;
                }
            }
            update_post_meta($post_id, "awesomecoder_app_icon", $icon);
        }
    }

    /**
     * Define the action of the metabox.
     *
     * @since    1.0.0
     */
    public function action()
    {
        // save pages fields
        add_action("save_post_post",  [$this, 'save_post_metadata'], 10, 3);
        // add metabox
        add_action('add_meta_boxes', [$this, 'metabox'], 10, 2);
    }

    /**
     * Define the metabox of the worker manager.
     *
     * @since    1.0.0
     */
    public function metabox($post_type, $post)
    {
        // add post.
        add_meta_box(
            'awesomecoder_playstore',
            __('PlayStore Data Scraper', 'awesomecoder'),
            [$this, 'post'],
            ['post'],
            'normal',
            'high'
        );
    }

    /**
     * Run the loader to execute all of the hooks with woocommerce.
     *
     * @since    1.0.0
     */
    public function run()
    {
        // load all action
        $this->action();
    }
}
