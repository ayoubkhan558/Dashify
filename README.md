# Dashify – Custom WordPress Admin Panel Theme

Dashify is a lightweight, custom-styled WordPress admin panel theme inspired by Shopify’s clean, modern dashboard UI.  
It replaces the default WordPress admin styles with a sleek, minimal, and scalable SCSS architecture.

## ✨ Features
- Shopify-inspired dashboard layout  
- Custom SCSS architecture for easy scaling  
- Clean typography and spacing system  
- Updated UI elements (buttons, tables, cards, forms)  
- Responsive and lightweight  
- Built for plugin/theme developers who want a custom WordPress backend look

## 📁 Folder Structure
dashify/
├── assets/
│ ├── css/
│ │ └── admin.css
│ └── scss/
│ ├── theme.scss
│ ├── _variables.scss
│ ├── _mixins.scss
│ ├── _base.scss
│ ├── _layout.scss
│ ├── _navigation.scss
│ ├── _cards.scss
│ ├── _tables.scss
│ ├── _forms.scss
│ ├── _buttons.scss
│ └── _utilities.scss
├── dashify-admin.php
├── functions.php
└── README.md


## 🔧 Installation
1. Copy the folder into `wp-content/plugins/`.
2. Activate the **Dashify Admin Theme** plugin from the WordPress dashboard.
3. Clear cache if needed.

## 🎨 Customization
Update color palette, spacing, and brand feel inside:

/assets/scss/_variables.scss

Then recompile SCSS into CSS.

## 📦 Compile SCSS
Use your preferred compiler:

```bash
npm install -g sass
sass assets/scss/theme.scss assets/css/admin.css --style=compressed
