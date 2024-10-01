<?php
//exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('WoeAjax')) {
    class WoeAjax
    {
        protected static ?WoeAjax $instance = null;

        public static function getInstance(): WoeAjax
        {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct()
        {
            add_action('wp_ajax_woeExpoOrderToCsv', array($this, 'woeExpoOrderToCsv'));
            add_action('wp_ajax_nopriv_woeExpoOrderToCsv', array($this, 'woeExpoOrderToCsv'));
        }

        public function woeExpoOrderToCsv(){
            if ( isset( $_POST['orderId'] ) ) {
                $orderId = intval( $_POST['orderId'] );
                $order = wc_get_order( $orderId );

                if ( $order ) {
                    $filename = 'exportOrder';
                    $fp = fopen($filename, 'w');
                    fputcsv($fp, array('Sr No.', 'Product Name', 'Quantity'));
                    $srNo = 1;
                    foreach ( $order->get_items() as $itemId => $item ) {
                        $productName = $item->get_name();
                        $quantity = $item->get_quantity();
                        fputcsv($fp, array($srNo, $productName, $quantity));
                        $srNo++;
                    }
                    fclose($fp);

                    $csvData = file_get_contents($filename);
                    $csvDataUri = 'data:text/csv;charset=utf-8,' . $csvData;

                    $response['csvDataUri'] = $csvDataUri;
                    wp_send_json_success($response);
                }

            }

        }

    }
}