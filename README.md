# OKPerformance Web

Source code for the OKPerformance website — a WordPress-based platform for science-based training, nutrition guidance, and coaching services.

## Repository structure

```
okperformance-web/
  theme/    — OKPerformance WordPress theme (based on _s / Underscores)
  plugin/   — OKPerformance Core plugin (custom post types, homepage options, service & package data)
```

## Requirements

- WordPress 4.5+
- PHP 5.6+
- WooCommerce (for shop, cart, and account features)

## Installation

1. Copy `theme/` to `wp-content/themes/okperformance` and activate it in WordPress.
2. Copy `plugin/` to `wp-content/plugins/okperformance-core` and activate the plugin.

## Theme development

Dependencies are managed via npm. From the `theme/` directory:

```bash
npm install
npm run watch        # compile SCSS and watch for changes
npm run compile:css  # one-off CSS compile
npm run lint:js      # lint JavaScript
npm run lint:scss    # lint SCSS
```
