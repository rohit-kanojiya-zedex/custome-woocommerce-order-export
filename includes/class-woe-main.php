<?php
//exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'WoeMain' ) ) {
    class WoeMain {
        protected static ?WoeMain $instance = null;
        public WoeAddExpBtn $woeAddExpBtn;
        public WoeAjax $woeAjax;


        public static function getInstance(): WoeMain {
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
            require_once WOE_INCLUDES . 'class-woe-add-exp-btn.php';
            require_once WOE_INCLUDES . 'class-woe-ajax.php';
        }

        public function init() {
            $this->woeAddExpBtn = WoeAddExpBtn::getInstance();
            $this->woeAjax = WoeAjax::getInstance();
        }
    }
}