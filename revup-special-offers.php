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

add_action('init', 'revup_special_offers_post_type');
function revup_special_offers_post_type()
{
  register_post_type('revup-special-offers', array(
    'labels' => array(
      'name' => 'Special Offers',
      'singular_name' => 'Special Offer',
      'add_new_item' => 'Add New Special Offer',
      'edit_item' => 'Edit Special Offer'
    ),
    'description' => 'Special Offers',
    'public' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_icon' => 'dashicons-star-filled',
  ));
}
