<?php

add_shortcode('revup_special_offers', 'revup_special_offers_shortcode');
function revup_special_offers_shortcode($atts)
{
  $args = array(
    'post_type' => 'revup-special-offers',
    'posts_per_page' => 3,
    'orderby' => 'expiration_date',
    'meta_type' => 'DATE',
    'meta_key' => 'revup_special_offer_expiration_date',
    'order' => 'ASC'
  );

  $query = new WP_Query($args);

  if ($query->have_posts()) {
    $output = '<ul>';
    while ($query->have_posts()) {
      $query->the_post();
      $title = get_post_meta(get_the_ID(), 'revup_special_offer_display_title', true);
      $expiration_date = get_post_meta(get_the_ID(), 'revup_special_offer_expiration_date', true);
      $link = get_post_meta(get_the_ID(), 'revup_special_offer_link', true);
      $output .= '<li>';
      $output .= '<a href="' . $link . '">';
      $output .= $title . ' (Expires: ' . $expiration_date . ')';
      $output .= '</a>';
      $output .= '</li>';
    }
    $output .= '</ul>';
  } else {
    $output = 'No special offers available.';
  }

  wp_reset_postdata();

  return $output; // TODO: Sanatize output
}
