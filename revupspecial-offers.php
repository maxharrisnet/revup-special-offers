<?php
/*
  Plugin Name: RevUp Special Offers
  Plugin URI: (TODO: Add Github)
  Description: This plugin creates a custom post type for Special Offers.
  Version: 1.0
  Author: Max Harris for RevUp Dental
  Author URI: https://www.maxharris.net
  Text Domain: revup
*/

if (!defined('ABSPATH')) {
  exit;
}

require plugin_dir_path(__FILE__) . 'includes/post-type.php';
require plugin_dir_path(__FILE__) . 'includes/shortcode.php';

// enque styles
add_action('wp_enqueue_scripts', 'revup_special_offers_enqueue_styles');
function revup_special_offers_enqueue_styles()
{
  // Register Styles
  wp_register_style('revup-special-offers', plugin_dir_url(__FILE__) . 'public/css/revup-special-offers.css', array(), '1.0', 'all');
  wp_register_style('revup-special-offers-admin', plugin_dir_url(__FILE__) . 'admin/css/revup-special-offers-admin.css', array(), '1.0', 'all');

  // Enqueue Styles
  wp_enqueue_style('revup-special-offers', plugin_dir_url(__FILE__) . 'public/css/revup-special-offers.css', array(), '1.0', 'all');
  wp_enqueue_style('revup-special-offers-admin', plugin_dir_url(__FILE__) . 'admin/css/revup-special-offers-admin.css', array(), '1.0', 'all');
}

// TODO: Remove data on uninstall (with prompt)