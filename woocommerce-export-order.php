<?php
/**
 * Plugin Name: export csv
 * Description: export this csv
 * Version: 1.0.0
 * Author: testwp
 * License: GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: woocommerce-order-export
 **/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define the plugin directory.
if ( ! defined( 'WOOCOMMERCE_ORDER_EXPORT_CSV_CUSTOM_DIR' ) ) {
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_VERSION', '1.0.0' );
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_INCLUDES', WOOCOMMERCE_ORDER_EXPORT_CSV_PLUGIN_DIR . '/includes/' );
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_ASSETS', WOOCOMMERCE_ORDER_EXPORT_CSV_PLUGIN_URL . '/assets/' );
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_CSS', WOOCOMMERCE_ORDER_EXPORT_CSV_ASSETS . 'css/' );
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_JS', WOOCOMMERCE_ORDER_EXPORT_CSV_ASSETS . 'js/' );
    define( 'WOOCOMMERCE_ORDER_EXPORT_CSV_TEMPLATES', WOOCOMMERCE_ORDER_EXPORT_CSV_PLUGIN_DIR . '/templates/' );
}

if ( ! class_exists('Vjc')){
    include_once WOOCOMMERCE_ORDER_EXPORT_CSV_INCLUDES . 'class-woe.php';
}

function WOE(): Woe {
    return Woe::getInstance();
}

$GLOBALS['Woe'] = WOE();