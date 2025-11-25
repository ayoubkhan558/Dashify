<?php
/*
Plugin Name: Dashify Admin Theme
Plugin URI: https://github.com/ayoubkhan558/dashify
Description: Enqueues the compiled `css/theme.css` into the WordPress admin area when the plugin is active.
Version: 1.0.0
Author: Ayoub Khan
Text Domain: dashify-admin
*/


if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

require_once __DIR__ . '/settings.php';
require_once __DIR__ . '/admin-page.php';
require_once __DIR__ . '/enqueue.php';

function dashify_admin_menu() {
    add_menu_page(
        'Dashify Admin',
        'Dashify Admin',
        'manage_options',
        'dashify-admin',
        'dashify_admin_settings_page',
        'dashicons-admin-appearance',
        61
    );
}
add_action( 'admin_menu', 'dashify_admin_menu' );

add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'dashify_admin_settings_link' );
function dashify_admin_settings_link( $links ) {
    if ( ! current_user_can( 'manage_options' ) ) return $links;
    $url = esc_url( admin_url( 'admin.php?page=dashify-admin' ) );
    $settings_link = '<a href="' . $url . '">' . esc_html__( 'Settings', 'dashify-admin' ) . '</a>';
    array_unshift( $links, $settings_link );
    return $links;
}