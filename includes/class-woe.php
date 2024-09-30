<?php
//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'Woe' ) ) {
    class Woe {
        protected static ?Woe $instance = null;
        public Add_Exp_Btn $addExpBtn;
        public Woe_Ajax $woeAjax;


        public static function getInstance(): Woe {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct() {
            add_action('plugin_loaded', array($this, 'initSetup'));
        }

        public function initSetup(){
            $this->includes();
            $this->init();
        }

        public function includes() {
            require_once WOOCOMMERCE_ORDER_EXPORT_CSV_INCLUDES . 'class-add-exp-btn.php';
            require_once WOOCOMMERCE_ORDER_EXPORT_CSV_INCLUDES . 'class-woe-ajax.php';
        }

        public function init() {
            $this->addExpBtn = Add_Exp_Btn::getInstance();
            $this->woeAjax = Woe_Ajax::getInstance();
        }
    }
}