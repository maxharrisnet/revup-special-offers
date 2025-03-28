<?php

if (!defined('ABSPATH') || !defined('WP_UNINSTALL_PLUGIN')) {
  exit;
}

global $wpdb;

// Get all posts/pages that contain the shortcode
$posts_with_shortcode = $wpdb->get_results(
  $wpdb->prepare(
    "SELECT ID, post_content 
         FROM {$wpdb->posts} 
         WHERE post_content LIKE %s 
         AND post_status = 'publish'",
    '%[revup_special_offers%'
  )
);

// Remove the shortcode from each post's content
foreach ($posts_with_shortcode as $post) {
  $new_content = preg_replace('/\[revup_special_offers.*?\]/', '', $post->post_content);

  // Update the post
  wp_update_post([
    'ID' => $post->ID,
    'post_content' => $new_content
  ]);
}

// Remove all custom post type entries
$special_offers = get_posts([
  'post_type' => 'revup-special-offers',
  'numberposts' => -1,
  'post_status' => 'any'
]);

foreach ($special_offers as $offer) {
  wp_delete_post($offer->ID, true);
}

// Clean up post meta
$wpdb->query("DELETE FROM {$wpdb->postmeta} WHERE meta_key LIKE 'revup_special_offer_%'");
