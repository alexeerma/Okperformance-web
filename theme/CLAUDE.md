# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

### CSS
```bash
npm run compile:css    # compile SCSS from sass/ to CSS (also runs stylelint --fix)
npm run watch          # watch sass/ and recompile on change
npm run compile:rtl    # generate style-rtl.css from style.css
```

### Linting
```bash
npm run lint:scss      # lint SCSS files
npm run lint:js        # lint JS files
composer lint:wpcs     # PHP_CodeSniffer with WordPress + WPThemeReview rules
composer lint:php      # PHP parallel-lint (syntax check)
```

### i18n
```bash
composer make-pot      # regenerate languages/_s.pot
```

## Architecture

This is a custom WordPress theme named **OKPerformance**, built on the [Automattic _s (Underscores)](https://underscores.me/) starter. All PHP globals use the `okperformance_` prefix.

### Core plugin dependency

The theme depends on a companion **OKPerformance Core plugin** for homepage options, custom post type registration, and data APIs. When the plugin is inactive, all plugin-provided functions are missing and templates fall back to hardcoded defaults. Check `okperformance_has_core_plugin()` before assuming plugin APIs are available.

Plugin-provided functions used throughout the theme:
- `okperformance_home_get_options()` — homepage settings (hero copy, section text, CTA labels, URLs)
- `okperformance_home_get_products()` / `okperformance_get_home_services()` — homepage data
- `okperformance_get_service_cards()` / `okperformance_get_service_mid_content()` — single service data
- `okperformance_get_package_cards()` / `okperformance_get_package_meta()` — single package data (focus, level, duration, price, CTA)

### Custom post types

Both CPTs are registered by the Core plugin, not the theme:
- `okp_service` — coaching/training services; single template in `single-okp_service.php`, archive in `archive-okp_service.php`
- `okp_package` — subscription/coaching packages; single template in `single-okp_package.php`

### Template structure

| File/directory | Purpose |
|---|---|
| `front-page.php` / `home-template.php` | Both load `template-parts/home-page.php` |
| `template-parts/home-page.php` | Full homepage: hero, about, products slider, services grid, FAQ, CTA |
| `page-templates/services-grid.php` | Stand-alone services listing page (Template Name: Services Grid) |
| `page-templates/contact.php` / `about-us.php` | Contact and About pages |
| `inc/woocommerce.php` | WooCommerce hooks and scripts (loaded only when WooCommerce is active) |
| `inc/template-tags.php` | `okperformance_posted_on()`, `okperformance_posted_by()`, etc. |
| `inc/template-functions.php` | Body class filter, pingback header |

### Scripts and styles

- `style.css` — main theme stylesheet (compiled from `sass/`)
- `woocommerce.css` — WooCommerce-specific overrides
- `js/navigation.js` — always enqueued
- `js/home.js` — enqueued on front page / home-template only
- `js/mini-cart.js` — WooCommerce mini-cart (requires `jquery`, `wc-cart-fragments`); localized as `okpMiniCart` with `ajaxUrl` and `nonce`
- `js/product-quantity.js` — enqueued on single product pages only

Asset versions are set via `filemtime()` for cache-busting.

### Navigation menus

Four registered locations: `menu-1` (header primary), `header-utility` (header secondary), `footer-menu` (footer platform), `footer-meta` (footer company).

### WooCommerce integration

Full support: zoom, lightbox, slider. Product grid defaults to 3 rows × 4 columns. The `okperformance_header_should_show_login()` function hides the login button when both WordPress and WooCommerce registration are closed (reduces bot surface).

### Login button visibility

Controlled by `okperformance_header_should_show_login()` — returns `true` only when `users_can_register` or WooCommerce account/checkout registration options are enabled. Override with the `okperformance_header_show_login` filter.

### UI language

Translatable strings use the `okperformance` text domain. Many hardcoded UI strings are in Estonian (e.g. "Võta ühendust", "Vaata pakette").
