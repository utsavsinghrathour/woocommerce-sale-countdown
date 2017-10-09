<?php
/*
Plugin Name: WooCommerce Sale Counter
Plugin URI: http://wordpress.org/plugins/sale-counter
Text Domain: sale-counter
Description: This plugin helps you add countdown timer to your sale items in WooCommerce. Show either days remaining or count-down timer to seconds
Author: codepixelzmedia
Author uri: https://codethemes.co
Version:0.1
License: GPLv2 or later
*/


add_action('woocommerce_product_meta_end', 'sale_counter_date');

function sale_counter_date() {
    global $post;
    $sales_price_to = esc_html__(get_post_meta($post->ID, '_sale_price_dates_to', true),'sale-counter');
    if (is_single() && $sales_price_to != "" && sales_price_from != "") {
        $sales_price_date_to = date("j M y", $sales_price_to);
        $finaldate=(strtotime($sales_price_date_to) - strtotime(date("j M y")))/ ( 60 * 60 * 24);
        ?>
            <p id="mydate" style="display: none;"><?php  _e (date('m/d/Y', $sales_price_to),'sale-counter'); ?></p>



<?php
        $main_name = esc_html__(get_option('main_name'),'sale-counter');
        if ($main_name == "date") { {

                _e ('<span class="sales-timer"><h3>' . esc_html__( $finaldate, 'my-text-domain' ) ."days ". esc_html__(get_option('notice_url'),'sale-counter') . '</h3>'.'</span>','sale-counter');
            }
        } else {

           _e('<span class="sales-timer"><h3 id="demorasil"></h3>'. esc_html__(get_option('notice_url'),'sale-counter').'</span>','sale-counter')  ;


        }

    }
}

function sale_counter_scripts_basic()
{
   wp_register_style( 'sale_counter_front_css', plugins_url( '/assets/css/sale-counter-front.css', __FILE__ ) );
   wp_register_script( 'sale_counter_custom_js', plugins_url( '/custom.js', __FILE__ ), array( 'jquery' ) );


    wp_enqueue_style( 'sale_counter_front_css' );
    wp_enqueue_script( 'sale_counter_custom_js' );
}
add_action( 'wp_enqueue_scripts', 'sale_counter_scripts_basic' );



function sale_counter_clean_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

include('sale-options.php');

?>