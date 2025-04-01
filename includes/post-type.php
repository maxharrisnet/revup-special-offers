<?php

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Custom post type for special offers
 * This code registers a custom post type called 'revup-special-offers' in WordPress.
 * It allows users to create and manage special offers with a title, content, expiration date, and a link.
 * The post type is displayed in the WordPress admin menu with a star icon.
 * The post type supports the title and editor fields, and it is publicly accessible.
 * 
 * Usage: This works in conjuction with the shortcode [revup_special_offers] to display the special offers on the front end.
 * 
 */

function revup_special_offers_meta_fields($post)
{
  wp_nonce_field('revup_special_offers_meta_box', 'revup_special_offers_meta_nonce');

  $title = get_post_meta($post->ID, 'revup_special_offer_display_title', true);
  $expiration_date = get_post_meta($post->ID, 'revup_special_offer_expiration_date', true);
  $link = get_post_meta($post->ID, 'revup_special_offer_link', true);
?><div class="revup-meta-field-container">
    <label for="revup_special_offer_display_title">Display Title:</label>
    <input type="text" id="revup_special_offer_display_title" name="revup_special_offer_display_title" value="<?php echo esc_attr($title); ?>" required />
    <br />
    <label for="revup_special_offer_expiration_date">Expiration Date:</label>
    <input type="date" id="revup_special_offer_expiration_date" name="revup_special_offer_expiration_date" value="<?php echo esc_attr($expiration_date); ?>" required />
    <br />
    <label for="revup_special_offer_link">Link:</label>
    <input type="text" id="revup_special_offer_link" name="revup_special_offer_link" value="<?php echo esc_attr($link); ?>" required />
  </div>
<?php
}

add_action('add_meta_boxes', 'revup_special_offers_add_meta_box');
function revup_special_offers_add_meta_box()
{
  add_meta_box(
    'revup_special_offers_details',
    'Special Offer Details',
    'revup_special_offers_meta_fields',
    'revup-special-offers',
    'side',
    'high'
  );
}

// Save metabox data
// TODO: Server-side validation
add_action('save_post_revup-special-offers', 'revup_special_offers_save_meta');
function revup_special_offers_save_meta($post_id)
{
  // Verify nonce
  if (
    !isset($_POST['revup_special_offers_meta_nonce']) ||
    !wp_verify_nonce($_POST['revup_special_offers_meta_nonce'], 'revup_special_offers_meta_box')
  ) {
    return;
  }

  // Save field data
  if (isset($_POST['revup_special_offer_display_title'])) {
    update_post_meta(
      $post_id,
      'revup_special_offer_display_title',
      sanitize_text_field($_POST['revup_special_offer_display_title'])
    );
  }

  if (isset($_POST['revup_special_offer_expiration_date'])) {
    update_post_meta(
      $post_id,
      'revup_special_offer_expiration_date',
      sanitize_text_field($_POST['revup_special_offer_expiration_date'])
    );
  }

  if (isset($_POST['revup_special_offer_link'])) {
    update_post_meta(
      $post_id,
      'revup_special_offer_link',
      sanitize_text_field($_POST['revup_special_offer_link'])
    );
  }
}

add_action('init', 'revup_special_offers_post_type');
function revup_special_offers_post_type()
{
  register_post_type('revup-special-offers', array(
    'labels' => array(
      'name' => __('Special Offers', revup),
      'singular_name' => 'Special Offer',
      'add_new_item' => 'Add New Special Offer',
      'edit_item' => 'Edit Special Offer'
    ),
    'description' => 'Special Offers',
    'menu_icon' => 'dashicons-star-filled',
    'public' => true,
    'has_archive' => false,
    'supports' => array('title', 'editor'),
  ));
}
