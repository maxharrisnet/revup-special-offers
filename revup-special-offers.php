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
