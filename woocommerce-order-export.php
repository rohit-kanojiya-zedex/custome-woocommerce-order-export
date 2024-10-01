<?php
/**
 * Plugin Name: Export csv
 * Description: Export your woocoomerce order to csv
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
if ( ! defined( 'WOE_CUSTOM_DIR' ) ) {
    define( 'WOE_PLUGIN_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
    define( 'WOE_PLUGIN_URL', untrailingslashit( plugin_dir_url( __FILE__ ) ) );
    define( 'WOE_VERSION', '1.0.0' );
    define( 'WOE_INCLUDES', WOE_PLUGIN_DIR . '/includes/' );
    define( 'WOE_ASSETS', WOE_PLUGIN_URL . '/assets/' );
    define( 'WOE_JS', WOE_ASSETS . 'js/' );
}

if ( ! class_exists('WoeMain')){
    include_once WOE_INCLUDES . 'class-woe-main.php';
}

function WOE(): WoeMain {
    return WoeMain::getInstance();
}

$GLOBALS['Woe'] = WOE();