<?php
/*
  Plugin Name: RevUp Special Offers
  Plugin URI: https://github.com/maxharrisnet/revup-special-offers
  Description: This plugin creates a custom post type for Special Offers and a shortcodete to display them. It also includes a metabox for setting the display title, expiration date, and link for each offer.
  Version: 1.0
  Author: Max Harris for RevUp Dental
  Author URI: https://www.maxharris.net
  Text Domain: revup
*/

if (!defined('ABSPATH')) {
  exit;
}

require_once plugin_dir_path(__FILE__) . 'includes/post-type.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcode.php';
// TODO: Remove data on uninstall (with prompt)

// Frontend styles
function revup_special_offers_enqueue_styles()
{
  wp_register_style('revup-special-offers', plugin_dir_url(__FILE__) . 'public/css/revup-special-offers.css', array(), filemtime(plugin_dir_path(__FILE__) . 'public/css/revup-special-offers.css'), 'all');
  wp_enqueue_style('revup-special-offers', plugin_dir_url(__FILE__) . 'public/css/revup-special-offers.css', array(), filemtime(plugin_dir_path(__FILE__) . 'public/css/revup-special-offers.css'), 'all');
}
add_action('wp_enqueue_scripts', 'revup_special_offers_enqueue_styles');

// Admin styles
function revup_special_offers_admin_enqueue_styles($hook)
{
  $post_type = get_current_screen()->post_type;
  if ('revup-special-offers' === $post_type) {
    wp_enqueue_style(
      'revup-special-offers-admin',
      plugin_dir_url(__FILE__) . 'admin/css/revup-special-offers-admin.css',
      array(),
      filemtime(plugin_dir_path(__FILE__) . 'admin/css/revup-special-offers-admin.css'),
    );
  }
}
add_action('admin_enqueue_scripts', 'revup_special_offers_admin_enqueue_styles');
