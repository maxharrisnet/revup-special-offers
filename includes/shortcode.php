<?php

if (! defined('ABSPATH')) {
  exit;
}

add_shortcode('revup_special_offers', 'revup_special_offers_shortcode');
function revup_special_offers_shortcode($atts)
{

  $current_date = current_time('Y-m-d');

  $args = array(
    'post_type' => 'revup-special-offers',
    'post_status' => 'publish',
    'posts_per_page' => 12,
    'meta_key' => 'revup_special_offer_expiration_date',
    'orderby' => 'meta_value',
    'meta_type' => 'DATE',
    'order' => 'ASC',
    'meta_query' => array(
      array(
        'key' => 'revup_special_offer_expiration_date',
        'value' => $current_date,
        'compare' => '>=',
        'type' => 'DATE'
      )
    )
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    $output = '<div class="revup-special-offers-wrapper alignfull">';
    $output .= '<ul class="revup-special-offers-list">';
    while ($query->have_posts()) {
      $query->the_post();
      $title = get_post_meta(get_the_ID(), 'revup_special_offer_display_title', true);
      $expiration_date = get_post_meta(get_the_ID(), 'revup_special_offer_expiration_date', true);
      $link = get_post_meta(get_the_ID(), 'revup_special_offer_link', true);

      if (empty($title) || empty($expiration_date) || empty($link)) {
        continue;
      }

      // Item output 
      $output .= '<li>';
      $output .= '<div class="revup-special-offer-info-container">';
      $output .= '<h3>' . $title . '</h3>';
      $output .= '<p>' . get_the_content() . '</p>';
      $output .= '</div>';
      $output .= '<div class="revup-cta-container">';
      $output .= '<a href="' . $link . '" class="revup-button" target="_blank">View Offer</a>';
      $output .= '<span class="revup-special-offer-expiration-date">Expires: <time>' . $expiration_date . '</time></span>';
      $output .= '</li>';
    }
    $output .= '</ul>';
    $output .= '</div>';
    $output .= get_the_posts_pagination();
  } else {
    $output = 'No special offers available.';
  }

  wp_reset_postdata();

  return wp_kses_post($output);
}
