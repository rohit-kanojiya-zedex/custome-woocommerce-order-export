<?php
//exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Woe_Ajax')) {
    class Woe_Ajax
    {
        protected static ?Woe_Ajax $instance = null;

        public static function getInstance(): Woe_Ajax
        {
            if (is_null(self::$instance)) {
                self::$instance = new self();
            }
            return self::$instance;
        }

        public function __construct()
        {
            add_action('wp_ajax_export_order_to_csv', array($this, 'export_order_to_csv'));
            add_action('wp_ajax_nopriv_export_order_to_csv', array($this, 'export_order_to_csv'));
        }

        public function export_order_to_csv(){
            if ( isset( $_POST['order_id'] ) ) {
                $order_id = intval( $_POST['order_id'] );
                $order = wc_get_order( $order_id );

                if ( $order ) {

                    $filename = 'export_order';
                    $fp = fopen($filename, 'w');
                    fputcsv($fp, array('Sr No.', 'Product Name', 'Quantity'));
                    $sr_no = 1;
                    foreach ( $order->get_items() as $item_id => $item ) {
                        $product_name = $item->get_name();
                        $quantity = $item->get_quantity();
                        fputcsv($fp, array($sr_no, $product_name, $quantity));
                        $sr_no++;
                    }
                    fclose($fp);

                    $csv_data = file_get_contents($filename);
                    $csv_data_uri = 'data:text/csv;charset=utf-8,' . $csv_data;

                    $response['csv_data_uri'] = $csv_data_uri;
                    wp_send_json_success($response);
                }

            }

        }

    }
}