<?php

if (! defined('ABSPATH')) {
  exit;
}

/**
 * Shortcode to display special offers
 * This shortcode retrieves and displays special offers from the 'revup-special-offers' post type.
 * It shows the title, content, expiration date, and a link to view the offer.
 * The offers are sorted by expiration date, and only those that have not expired are displayed.
 * The shortcode can be used in any post or page to dynamically display the current special offers. 
 * 
 * Usage: [revup_special_offers]
 * 
 * @return string HTML output of special offers
 * 
 */

function revup_special_offers_shortcode($atts)
{
  $current_date = current_time('Y-m-d');

  $args = array(
    'post_type' => 'revup-special-offers',
    'post_status' => 'publish',
    'posts_per_page' => 99,
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

  // Start output buffering
  ob_start();

  if ($query->have_posts()) {
?>
    <div class="revup-special-offers-wrapper alignfull">
      <ul class="revup-special-offers-list">
        <?php while ($query->have_posts()) : $query->the_post();
          $title = get_post_meta(get_the_ID(), 'revup_special_offer_display_title', true);
          $expiration_date = get_post_meta(get_the_ID(), 'revup_special_offer_expiration_date', true);
          $link = get_post_meta(get_the_ID(), 'revup_special_offer_link', true);

          if (empty($title) || empty($expiration_date) || empty($link)) {
            continue;
          }
        ?>
          <li>
            <div class="revup-special-offer-info-container">
              <h3><?php echo esc_html($title); ?></h3>
              <p><?php echo wp_kses_post(get_the_content()); ?></p>
            </div>
            <div class="revup-cta-container">
              <a href="<?php echo esc_url($link); ?>" class="revup-button" target="_blank">View Offer</a>
              <!-- Localized date -->
              <span class="revup-special-offer-expiration-date">Expires: <time><?php echo esc_html(date_i18n(get_option('date_format'), strtotime($expiration_date))); ?></time></span>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
<?php
    echo get_the_posts_pagination();
  } else {
    echo __('No special offers available.', 'revup');
  }

  wp_reset_postdata();

  // Capture and return the buffered output
  $output = ob_get_clean();
  return $output;
}
add_shortcode('revup_special_offers', 'revup_special_offers_shortcode');
