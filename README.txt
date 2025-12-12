=== Dashify Admin Theme ===
Contributors: ayoubkhan558
Tags: admin-theme, dashboard, customization
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A custom WordPress admin panel theme inspired by modern design principles with Shopify-inspired dashboard UI.

== Description ==

Dashify is a lightweight, custom-styled WordPress admin panel theme that replaces the default WordPress admin styles with a sleek, minimal, and scalable design. It includes a comprehensive SCSS architecture for easy customization.

== Features ==

- Modern dashboard layout inspired by contemporary design practices
- Custom SCSS architecture for easy scaling
- Clean typography and spacing system
- Updated UI elements (buttons, tables, cards, forms)
- Responsive and lightweight
- Built for plugin/theme developers who want a custom WordPress backend look
- Full customization options for colors and dimensions

== Installation ==

1. Copy the folder into `wp-content/plugins/`.
2. Activate the **Dashify Admin Theme** plugin from the WordPress dashboard.
3. Go to Settings > Dashify Admin to customize colors and layout.
4. Clear cache if needed.

== Customization ==

The plugin comes with a built-in settings page where you can customize:

- Primary color
- Aside width
- Admin background color
- Aside background color
- Border radius

These settings are automatically saved as CSS variables and applied to the admin interface.

To further customize the design, update the SCSS files located in the `scss/` directory and recompile using:

```
npm install -g sass
sass scss/theme.scss css/theme.css --style=compressed
```

== Changelog ==

= 1.0.0 =
* Initial release

== Frequently Asked Questions ==

= How do I customize the colors? =

Go to Settings > Dashify Admin in your WordPress dashboard to change colors and other design options.

= Can I modify the SCSS files? =

Yes, you can modify the SCSS files in the `scss/` directory and recompile them to CSS.

= Is this compatible with all WordPress themes? =

This plugin modifies the WordPress admin panel and is compatible with all WordPress themes and versions 5.0+.

== Screenshots ==

1. Settings page for customization
2. Admin dashboard with custom styling

== Support ==

For support and issues, please visit the GitHub repository at https://github.com/ayoubkhan558/dashify