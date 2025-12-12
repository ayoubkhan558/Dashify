<?php
/*
Plugin Name: Dashify Admin Theme
Plugin URI: https://github.com/ayoubkhan558/dashify
Description: Enqueues the compiled `css/theme.css` into the WordPress admin area when the plugin is active.
Version: 1.0.0
Author: Ayoub Khan
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dashify
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/admin-page.php';
require_once __DIR__ . '/enqueue.php';

function dashify_admin_menu() {
    add_options_page(
        'Dashify Admin',           // Page title
        'Dashify Admin',           // Menu title
        'manage_options',          // Capability
        'dashify-admin',           // Menu slug
        'dashify_admin_settings_page' // Callback function
    );
}
add_action( 'admin_menu', 'dashify_admin_menu' );

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'dashify_admin_settings_link' );
function dashify_admin_settings_link( $links ) {
    if ( ! current_user_can( 'manage_options' ) ) return $links;
    $url = esc_url( admin_url( 'options-general.php?page=dashify-admin' ) );
    $settings_link = '<a href="' . $url . '">' . esc_html__( 'Settings', 'dashify' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}