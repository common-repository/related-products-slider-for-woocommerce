<?php
/*
 * Plugin Name:  	 Related Products Slider for WooCommerce Basic
 * Description:  	 Display related products with Slider on every single product .
 * Version:      	 1.0
 * Author:       	 WooTeam
 * Author URI:   	 http://woo-team.com
 */
 if (!defined('ABSPATH')) exit;

 if (!defined('RP_SLUG')) {
     define('RP_SLUG', 'rp-related-products');
     define('RP_VERSION', '1.0');
     define('RP_FILE', __FILE__);
     define('RP_PATH', plugin_dir_path(__FILE__));
     define('RP_URL', plugin_dir_url(__FILE__));
     define('RP_PLUGIN_SLUG', plugin_basename(__FILE__));
 }



 //
require_once(RP_PATH . '/includes/rp-defaults.php');
require_once(RP_PATH . '/includes/rp-admin.php');
require_once(RP_PATH . '/includes/rp-shortcode.php');
