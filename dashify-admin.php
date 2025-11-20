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
    exit; // Exit if accessed directly
}

/**
 * Enqueue the compiled admin stylesheet for WP admin only.
 * Uses file modification time as version to bust caches during development.
 *
 * @param string $hook The current admin page.
 */
function dashify_admin_enqueue_styles( $hook ) {
    $css_path = plugin_dir_path( __FILE__ ) . 'css/theme.css';
    $css_url  = plugin_dir_url( __FILE__ ) . 'css/theme.css';

    if ( file_exists( $css_path ) ) {
        $version = (string) filemtime( $css_path );
    } else {
        $version = false;
    }

    wp_enqueue_style( 'dashify-admin-theme', $css_url, array(), $version );
}
add_action( 'admin_enqueue_scripts', 'dashify_admin_enqueue_styles' );
