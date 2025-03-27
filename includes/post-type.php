<?php

function revup_special_offers_meta_fields($post)
{
  $title = get_post_meta($post->ID, 'revup_special_offer_display_title', true);
  $expiration_date = get_post_meta($post->ID, 'revup_special_offer_expiration_date', true);
  $link = get_post_meta($post->ID, 'revup_special_offer_link', true);
?>
  <label for="revup_special_offer_display_title">Display Title:</label>
  <input type="text" id="revup_special_offer_display_title" name="revup_special_offer_display_title" value="<?php echo $title; ?>" />
  <br />
  <label for="revup_special_offer_expiration_date">Expiration Date:</label>
  <input type="text" id="revup_special_offer_expiration_date" name="revup_special_offer_expiration_date" value="<?php echo $expiration_date; ?>" />
  <br />
  <label for="revup_special_offer_link">Link:</label>
  <input type="text" id="revup_special_offer_link" name="revup_special_offer_link" value="<?php echo $link; ?>" />
<?php
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
    'menu_icon' => 'dashicons-star-filled',
    'public' => true,
    'has_archive' => true,
    'supports' => array('title', 'editor', 'custom-fields'),
    'meta_box_cb' => 'revup_special_offers_meta_fields',
  ));
}
