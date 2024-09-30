<?php
//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Add_Exp_Btn' ) ) {
    class Add_Exp_Btn {
        protected static ?Add_Exp_Btn $instance = null;

        public static function getInstance(): Add_Exp_Btn {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct() {
            wp_register_script('add-exp-btn-js', WOOCOMMERCE_ORDER_EXPORT_CSV_JS . 'add-exp-btn-ajax.js', ['jquery'], WOOCOMMERCE_ORDER_EXPORT_CSV_VERSION, true);
            add_action( 'woocommerce_admin_order_data_after_order_details', [$this,'add_export_button_on_single_order_page'] );
        }

         public function add_export_button_on_single_order_page($order) {
            if ($order){
                wp_enqueue_script('add-exp-btn-js');
                wp_localize_script('add-exp-btn-js', 'addExpBtnObj',['ajaxurl' => admin_url('admin-ajax.php'), 'orderId' => $order->get_id()]);
            }
        }
    }
}