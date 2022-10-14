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
     * Define the metabox of the product.
     *
     * @since    1.0.0
     */
    public function product()
    {
        ob_start();
        include_once AWESOMECODER_PATH . 'backend/views/metabox/product.php';
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
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        // die;
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

        if (isset($_POST["awesomecoderLicenceProduct"])) {
            $awesomecoderLicenceProduct = $_POST["awesomecoderLicenceProduct"];
            update_post_meta($post_id, "awesomecoderLicenceProduct", $awesomecoderLicenceProduct, get_post_meta($post_id, "awesomecoderLicenceProduct", true));
            update_option("awesomecoderLicenceProductId", $post_id);
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
        add_action("save_post",  [$this, 'save_post_metadata'], 10, 3);
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
            'low'
        );

        // product
        add_meta_box(
            'awesomecoder_playstore_product_option',
            __('Licence Product', 'awesomecoder'),
            [$this, 'product'],
            ['product'],
            'side',
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
        // add_filter('woocommerce_get_order_item_totals', function ($total_rows) {
        //     global $woocommerce;
        //     $total_rows['recurr_not'] = array(
        //         'label' => __('Total HT :', 'woocommerce'),
        //         'value' => json_encode($woocommerce)
        //     );
        //     return $total_rows;
        // });

        add_filter('woocommerce_order_shipping_to_display', function ($shipping, $order) {
            global $wpdb;
            $product_lists = [];
            $order_id  = $order->get_id(); // Get the order ID
            $parent_id = $order->get_parent_id(); // Get the parent order ID (for subscriptions…)
            $db = "{$wpdb->prefix}sebt_licence";

            $user_id   = $order->get_user_id(); // Get the costumer ID
            $user      = $order->get_user(); // Get the WP_User object

            $order_status  = $order->get_status(); // Get the order status (see the conditional method has_status() below)
            $currency      = $order->get_currency(); // Get the currency used
            $payment_method = $order->get_payment_method(); // Get the payment method ID
            $payment_title = $order->get_payment_method_title(); // Get the payment method title
            $date_created  = $order->get_date_created(); // Get date created (WC_DateTime object)
            $date_modified = $order->get_date_modified(); // Get date modified (WC_DateTime object)

            $billing_country = $order->get_billing_country(); // Customer billing country
            $licance_keys = [];
            $awesomecoderLicenceProductId = get_option("awesomecoderLicenceProductId", null);

            if ($awesomecoderLicenceProductId != null) {
                foreach ($order->get_items() as $key => $item) {
                    $quantity = $item->get_quantity();
                    $item_id = $item->get_id();
                    $product_id = $item->get_product_id();
                    $awesomecoderLicenceProduct = get_post_meta($product_id, "awesomecoderLicenceProduct", true);
                    $awesomecoderLicenceProduct = $awesomecoderLicenceProduct ? $awesomecoderLicenceProduct : "false";
                    $awesomecoderLicenceProduct = $awesomecoderLicenceProduct == "true" ? "true" : "false";
                    if ($awesomecoderLicenceProductId == $product_id) {
                        if ($awesomecoderLicenceProduct == "true") {
                            foreach (range(1, $quantity) as $key => $value) {
                                $licance_keys["{$product_id}_{$value}"] = Awesomecoder_Handler::generateLicenseKey();
                            }
                        }
                    }
                }
            }

            if (get_post_meta($order_id, "awesomecoderOrderLicenceProduct", true) && $order->get_status() == "completed") {
                // update_post_meta($order_id, "awesomecoderOrderLicenceProduct", $licance_keys);
                $get_licence_keys = get_post_meta($order_id, "awesomecoderOrderLicenceProduct", true);
                // echo "adfaf a $order_id";
                // echo "<pre>" . json_encode($get_licence_keys);
                // print_r($get_licence_keys);
                // echo '</pre>';

                // foreach ($get_licence_keys as $i => $key) {
                //     // $key = self::generateLicenseKey();
                //     // $wpdb->insert(
                //     //     $db,
                //     //     ["key" => $key,]
                //     // );

                //     // $licenses = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}sebt_licence ORDER BY id DESC");
                //     // $licenses = array_chunk($licenses, 120);
                // }

                echo '<pre>';
                print_r($get_licence_keys);
                echo '</pre>';
            } else {
                update_post_meta($order_id, "awesomecoderOrderLicenceProduct", $licance_keys);
            }

            return $shipping;
        }, 10, 2);
    }
}
