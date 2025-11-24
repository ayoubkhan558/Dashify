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
function dashify_admin_get_defaults() {
    return array(
        'admin_primary' => '', // hex color (e.g. #66c04a). Empty = use compiled CSS default
        'admin_aside_width' => '225', // in px
        'admin_bg_main' => '', // hex color
        'admin_aside_bg_clr' => '', // hex color
        'admin_radius' => '12', // in px
    );
}

function dashify_admin_sanitize( $input ) {
    $defaults = dashify_admin_get_defaults();
    $output = $defaults;

    if ( isset( $input['admin_primary'] ) ) {
        $color = sanitize_text_field( $input['admin_primary'] );
        $hex = sanitize_hex_color( $color );
        $output['admin_primary'] = $hex ? $hex : '';
    }

    if ( isset( $input['admin_aside_width'] ) ) {
        $width = intval( $input['admin_aside_width'] );
        $output['admin_aside_width'] = $width > 0 ? (string) $width : $defaults['admin_aside_width'];
    }

    if ( isset( $input['admin_bg_main'] ) ) {
        $color = sanitize_text_field( $input['admin_bg_main'] );
        $hex = sanitize_hex_color( $color );
        $output['admin_bg_main'] = $hex ? $hex : '';
    }

    if ( isset( $input['admin_aside_bg_clr'] ) ) {
        $color = sanitize_text_field( $input['admin_aside_bg_clr'] );
        $hex = sanitize_hex_color( $color );
        $output['admin_aside_bg_clr'] = $hex ? $hex : '';
    }

    if ( isset( $input['admin_radius'] ) ) {
        $radius = intval( $input['admin_radius'] );
        $output['admin_radius'] = $radius > 0 ? (string) $radius : $defaults['admin_radius'];
    }

    return $output;
}

function dashify_admin_register_settings() {
    register_setting( 'dashify_admin_options_group', 'dashify_admin_options', 'dashify_admin_sanitize' );
}
add_action( 'admin_init', 'dashify_admin_register_settings' );

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

/*
 * Add a "Settings" link on the plugins list which points to this plugin's settings page.
 * Uses the plugin's basename in the filter so the link appears only for this plugin.
 */
add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'dashify_admin_settings_link' );

/**
 * Add the settings link to the plugin action links array.
 *
 * @param array $links Current plugin action links.
 * @return array Filtered links including a settings link.
 */
function dashify_admin_settings_link( $links ) {
    $url = esc_url( admin_url( 'admin.php?page=dashify-admin' ) );
    $settings_link = '<a href="' . $url . '">' . esc_html__( 'Settings', 'dashify-admin' ) . '</a>';
    // Add settings link to the beginning of the links array so it's visible.
    array_unshift( $links, $settings_link );
    return $links;
}

function dashify_admin_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    $options = get_option( 'dashify_admin_options', dashify_admin_get_defaults() );
    ?>
    <div class="wrap">
        <h1>Dashify Admin Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields( 'dashify_admin_options_group' ); ?>
            <?php do_settings_sections( 'dashify_admin_options_group' ); ?>

            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="dashify_admin_admin_primary">Primary color</label></th>
                    <td>
                        <input name="dashify_admin_options[admin_primary]" type="text" id="dashify_admin_admin_primary" value="<?php echo esc_attr( $options['admin_primary'] ); ?>" class="regular-text" placeholder="#66c04a" />
                        <p class="description">Hex color for <code>--admin-primary</code>. Leave blank to use compiled default.</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="dashify_admin_admin_aside_width">Aside width (px)</label></th>
                    <td>
                        <input name="dashify_admin_options[admin_aside_width]" type="number" id="dashify_admin_admin_aside_width" value="<?php echo esc_attr( $options['admin_aside_width'] ); ?>" class="small-text" />
                        <p class="description">Width of the admin aside in pixels (without unit).</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="dashify_admin_admin_bg_main">Admin background</label></th>
                    <td>
                        <input name="dashify_admin_options[admin_bg_main]" type="text" id="dashify_admin_admin_bg_main" value="<?php echo esc_attr( $options['admin_bg_main'] ); ?>" class="regular-text" placeholder="#f2f2f2" />
                        <p class="description">Hex color for <code>--admin-bg-main</code>. Leave blank to use compiled default.</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="dashify_admin_admin_aside_bg_clr">Aside background</label></th>
                    <td>
                        <input name="dashify_admin_options[admin_aside_bg_clr]" type="text" id="dashify_admin_admin_aside_bg_clr" value="<?php echo esc_attr( $options['admin_aside_bg_clr'] ); ?>" class="regular-text" placeholder="#ebebeb" />
                        <p class="description">Hex color for <code>--admin-aside-bg-clr</code>. Leave blank to use compiled default.</p>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label for="dashify_admin_admin_radius">Border radius (px)</label></th>
                    <td>
                        <input name="dashify_admin_options[admin_radius]" type="number" id="dashify_admin_admin_radius" value="<?php echo esc_attr( $options['admin_radius'] ); ?>" class="small-text" />
                        <p class="description">Base border radius in pixels used for UI elements.</p>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

/**
 * Enqueue the compiled admin stylesheet for WP admin only and inject CSS vars from settings.
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

    $options = get_option( 'dashify_admin_options', dashify_admin_get_defaults() );

    $css_vars = ":root{";
    if ( ! empty( $options['admin_primary'] ) ) {
        $css_vars .= "--admin-primary: " . esc_attr( $options['admin_primary'] ) . ";";
    }
    if ( ! empty( $options['admin_aside_width'] ) ) {
        $css_vars .= "--admin-aside-width: " . intval( $options['admin_aside_width'] ) . "px;";
    }
    if ( ! empty( $options['admin_bg_main'] ) ) {
        $css_vars .= "--admin-bg-main: " . esc_attr( $options['admin_bg_main'] ) . ";";
    }
    if ( ! empty( $options['admin_aside_bg_clr'] ) ) {
        $css_vars .= "--admin-aside-bg-clr: " . esc_attr( $options['admin_aside_bg_clr'] ) . ";";
    }
    if ( ! empty( $options['admin_radius'] ) ) {
        $css_vars .= "--admin-radius: " . intval( $options['admin_radius'] ) . "px;";
    }
    $css_vars .= "}";

    if ( $css_vars !== ":root{}" ) {
        wp_add_inline_style( 'dashify-admin-theme', $css_vars );
    }
}
add_action( 'admin_enqueue_scripts', 'dashify_admin_enqueue_styles' );
