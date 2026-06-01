<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OKPerformance
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'okperformance' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header__shell">
			<div class="site-branding">
				<?php if ( function_exists( 'okperformance_site_logo' ) && ( has_custom_logo() || file_exists( get_template_directory() . '/assets/okperformance-d-barbell-monogram.svg' ) ) ) : ?>
					<div class="site-branding__logo">
						<?php okperformance_site_logo( 'header' ); ?>
					</div>
				<?php else : ?>
					<a class="site-branding__mark" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
						<svg viewBox="0 0 32 32" aria-hidden="true" focusable="false">
							<rect x="4" y="10" width="4" height="12" rx="2"></rect>
							<rect x="24" y="10" width="4" height="12" rx="2"></rect>
							<rect x="8" y="14" width="16" height="4" rx="2"></rect>
							<path d="M11 8v16M21 8v16"></path>
						</svg>
					</a>
				<?php endif; ?>

			</div>

			<nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Header menu', 'okperformance' ); ?>">
				<button class="menu-toggle" aria-controls="site-navigation-panel" aria-expanded="false" aria-label="<?php esc_attr_e( 'Open menu', 'okperformance' ); ?>">
					<span class="menu-toggle__icon" aria-hidden="true">
						<span class="menu-toggle__bar"></span>
						<span class="menu-toggle__bar"></span>
						<span class="menu-toggle__bar"></span>
					</span>
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'okperformance' ); ?></span>
				</button>

					<div id="site-navigation-panel" class="main-navigation__panel">
						<div class="main-navigation__panel-bar">
							<a class="main-navigation__panel-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
								<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/okperformance-d-barbell-monogram.svg' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
							</a>
							<div class="main-navigation__panel-bar-commerce">
								<?php
								okperformance_header_commerce();
								?>
							</div>
							<button type="button" class="menu-close" aria-label="<?php esc_attr_e( 'Close menu', 'okperformance' ); ?>">
								<span class="menu-close__icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" width="18" height="18" focusable="false" aria-hidden="true">
										<path d="M6 6l12 12M18 6L6 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" fill="none"></path>
									</svg>
								</span>
								<span class="screen-reader-text"><?php esc_html_e( 'Close menu', 'okperformance' ); ?></span>
							</button>
						</div>

						<div class="main-navigation__panel-body">
							<div class="main-navigation__menu-wrap">
								<?php
								wp_nav_menu(
								array(
									'theme_location' => 'menu-1',
									'menu_id'        => 'primary-menu',
									'container'      => false,
									'menu_class'     => 'menu nav-menu menu--primary',
									'fallback_cb'    => 'okperformance_primary_menu_fallback',
									)
								);
								?>
							</div>

							<div class="main-navigation__aside">
								<?php if ( has_nav_menu( 'header-utility' ) ) : ?>
									<div class="main-navigation__utility">
										<?php
										wp_nav_menu(
											array(
												'theme_location' => 'header-utility',
												'menu_id'        => 'header-utility-menu',
												'container'      => false,
												'menu_class'     => 'menu nav-menu menu--utility',
												'fallback_cb'    => false,
											)
										);
										?>
									</div>
								<?php endif; ?>

								<div class="main-navigation__commerce main-navigation__commerce--body">
									<?php
									okperformance_header_commerce();
									?>
								</div>
							</div>
						</div>
					</div>
				</nav><!-- #site-navigation -->
			</div>
		</header><!-- #masthead -->

		<?php if ( function_exists( 'okperformance_woocommerce_render_mini_cart' ) ) : ?>
			<?php okperformance_woocommerce_render_mini_cart(); ?>
		<?php endif; ?>

		<div id="content" class="site-content">
