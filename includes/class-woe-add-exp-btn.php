<?php
//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WoeAddExpBtn' ) ) {
    class WoeAddExpBtn {
        protected static ?WoeAddExpBtn $instance = null;

        public static function getInstance(): WoeAddExpBtn {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct() {
            wp_register_script('woeExpOrderAjaxJs', WOE_JS . 'woe-add-exp-btn-ajax.js', ['jquery'], WOE_VERSION, true);
            add_action( 'woocommerce_admin_order_data_after_order_details', [$this,'woeAddExportBtnOnSingleOrderPage'] );
        }

         public function woeAddExportBtnOnSingleOrderPage($order) {
            if ($order){
                wp_enqueue_script('woeExpOrderAjaxJs');
                wp_localize_script('woeExpOrderAjaxJs', 'addExpBtnObj',['ajaxurl' => admin_url('admin-ajax.php'), 'orderId' => $order->get_id()]);
            }
        }
    }
}