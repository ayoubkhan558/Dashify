<?php
// Settings page rendering
function dashify_admin_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $primary = get_option( 'dashify_admin_primary', '' );
    $aside_width = get_option( 'dashify_admin_aside_width', '225' );
    $bg_main = get_option( 'dashify_admin_bg_main', '' );
    $aside_bg_clr = get_option( 'dashify_admin_aside_bg_clr', '' );
    $radius = get_option( 'dashify_admin_radius', '12' );
    ?>
    <div class="wrap">
        <h1><?php esc_html_e( 'Dashify Admin Settings', 'dashify' ); ?></h1>
        <?php settings_errors(); ?>
        <form method="post" action="options.php">
            <?php settings_fields( 'dashify_admin_settings_group' ); ?>
            <?php do_settings_sections( 'dashify-admin-settings' ); ?>
            <table class="form-table" role="presentation">
                <tr>
                    <th scope="row"><label for="dashify_admin_primary"><?php esc_html_e( 'Primary color', 'dashify' ); ?></label></th>
                    <td>
                        <input name="dashify_admin_primary" type="text" id="dashify_admin_primary" value="<?php echo esc_attr( $primary ); ?>" class="regular-text" placeholder="#66c04a" />
                        <p class="description"><?php esc_html_e( 'Hex color for --admin-primary. Leave blank to use compiled default.', 'dashify' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="dashify_admin_aside_width"><?php esc_html_e( 'Aside width (px)', 'dashify' ); ?></label></th>
                    <td>
                        <input name="dashify_admin_aside_width" type="number" id="dashify_admin_aside_width" value="<?php echo esc_attr( $aside_width ); ?>" class="small-text" min="0" step="1" />
                        <p class="description"><?php esc_html_e( 'Width of the admin aside in pixels (without unit).', 'dashify' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="dashify_admin_bg_main"><?php esc_html_e( 'Admin background', 'dashify' ); ?></label></th>
                    <td>
                        <input name="dashify_admin_bg_main" type="text" id="dashify_admin_bg_main" value="<?php echo esc_attr( $bg_main ); ?>" class="regular-text" placeholder="#f2f2f2" />
                        <p class="description"><?php esc_html_e( 'Hex color for --admin-bg-main. Leave blank to use compiled default.', 'dashify' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="dashify_admin_aside_bg_clr"><?php esc_html_e( 'Aside background', 'dashify' ); ?></label></th>
                    <td>
                        <input name="dashify_admin_aside_bg_clr" type="text" id="dashify_admin_aside_bg_clr" value="<?php echo esc_attr( $aside_bg_clr ); ?>" class="regular-text" placeholder="#ebebeb" />
                        <p class="description"><?php esc_html_e( 'Hex color for --admin-aside-bg-clr. Leave blank to use compiled default.', 'dashify' ); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="dashify_admin_radius"><?php esc_html_e( 'Border radius (px)', 'dashify' ); ?></label></th>
                    <td>
                        <input name="dashify_admin_radius" type="number" id="dashify_admin_radius" value="<?php echo esc_attr( $radius ); ?>" class="small-text" min="0" step="1" />
                        <p class="description"><?php esc_html_e( 'Base border radius in pixels used for UI elements.', 'dashify' ); ?></p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}
