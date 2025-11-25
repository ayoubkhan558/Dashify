<?php
// Enqueue admin styles and inject CSS variables
function dashify_admin_enqueue_styles( $hook ) {
    $css_path = plugin_dir_path( __FILE__ ) . 'css/theme.css';
    $css_url  = plugin_dir_url( __FILE__ ) . 'css/theme.css';
    if ( file_exists( $css_path ) ) {
        $version = (string) filemtime( $css_path );
        wp_enqueue_style( 'dashify-admin-theme', $css_url, array(), $version );
    } else {
        wp_register_style( 'dashify-admin-theme', false );
        wp_enqueue_style( 'dashify-admin-theme' );
    }
    $primary = get_option( 'dashify_admin_primary', '' );
    $aside_width = get_option( 'dashify_admin_aside_width', '225' );
    $bg_main = get_option( 'dashify_admin_bg_main', '' );
    $aside_bg_clr = get_option( 'dashify_admin_aside_bg_clr', '' );
    $radius = get_option( 'dashify_admin_radius', '12' );
    $css_vars = ":root{";
    if ( ! empty( $primary ) ) $css_vars .= "--admin-primary: " . esc_attr( $primary ) . ";";
    if ( ! empty( $aside_width ) ) $css_vars .= "--admin-aside-width: " . intval( $aside_width ) . "px;";
    if ( ! empty( $bg_main ) ) $css_vars .= "--admin-bg-main: " . esc_attr( $bg_main ) . ";";
    if ( ! empty( $aside_bg_clr ) ) $css_vars .= "--admin-aside-bg-clr: " . esc_attr( $aside_bg_clr ) . ";";
    if ( ! empty( $radius ) ) $css_vars .= "--admin-radius: " . intval( $radius ) . "px;";
    $css_vars .= "}";
    if ( $css_vars !== ":root{}" ) {
        wp_add_inline_style( 'dashify-admin-theme', $css_vars );
    }
}
add_action( 'admin_enqueue_scripts', 'dashify_admin_enqueue_styles' );
