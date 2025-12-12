<?php
// Settings registration and sanitization

function dashify_admin_sanitize_color( $input ) {
    if ( empty( $input ) ) return '';
    $input = sanitize_text_field( $input );
    if ( strpos( $input, '#' ) !== 0 ) $input = '#' . $input;
    if ( preg_match( '/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/', $input ) ) return $input;
    return '';
}
function dashify_admin_sanitize_number( $input ) {
    if ( $input === '' || $input === null ) return '';
    $value = intval( $input );
    if ( $value >= 0 ) return (string) $value;
    return '';
}
function dashify_admin_register_settings() {
    register_setting( 'dashify_admin_settings_group', 'dashify_admin_primary', [
        'type' => 'color', 'sanitize_callback' => 'dashify_admin_sanitize_color', 'default' => '',
    ] );
    register_setting( 'dashify_admin_settings_group', 'dashify_admin_aside_width', [
        'type' => 'string', 'sanitize_callback' => 'dashify_admin_sanitize_number', 'default' => '225',
    ] );
    register_setting( 'dashify_admin_settings_group', 'dashify_admin_bg_main', [
        'type' => 'string', 'sanitize_callback' => 'dashify_admin_sanitize_color', 'default' => '',
    ] );
    register_setting( 'dashify_admin_settings_group', 'dashify_admin_aside_bg_clr', [
        'type' => 'string', 'sanitize_callback' => 'dashify_admin_sanitize_color', 'default' => '',
    ] );
    register_setting( 'dashify_admin_settings_group', 'dashify_admin_radius', [
        'type' => 'string', 'sanitize_callback' => 'dashify_admin_sanitize_number', 'default' => '12',
    ] );
    add_settings_section(
        'dashify_admin_section',
        __( 'Customization Options', 'dashify' ),
        '__return_false',
        'dashify-admin-settings'
    );
}
add_action( 'admin_init', 'dashify_admin_register_settings' );
