<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package OKPerformance
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<h3 class="site-logo-slider__title"><?php esc_html_e( 'Meie koostööpartnerid', 'okperformance' ); ?></h3>
		
		<?php $okp_footer_logos = function_exists( 'okperformance_get_footer_logo_items' ) ? okperformance_get_footer_logo_items() : array(); ?>

		<?php if ( ! empty( $okp_footer_logos ) ) : ?>
			<div class="site-footer__logo-marquee" aria-label="<?php esc_attr_e( 'Partners and featured brands', 'okperformance' ); ?>">
				<div class="site-footer__logo-track">
					<?php foreach ( $okp_footer_logos as $okp_footer_logo ) : ?>
						<?php
						$logo_markup = '<img src="' . esc_url( $okp_footer_logo['image_url'] ) . '" alt="' . esc_attr( $okp_footer_logo['alt'] ) . '">';
						?>
						<div class="site-footer__logo-item">
							<?php if ( ! empty( $okp_footer_logo['link_url'] ) ) : ?>
								<a href="<?php echo esc_url( $okp_footer_logo['link_url'] ); ?>">
									<?php echo $logo_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php else : ?>
								<span>
									<?php echo $logo_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>

					<?php foreach ( $okp_footer_logos as $okp_footer_logo ) : ?>
						<?php
						$logo_markup = '<img src="' . esc_url( $okp_footer_logo['image_url'] ) . '" alt="" aria-hidden="true">';
						?>
						<div class="site-footer__logo-item" aria-hidden="true">
							<?php if ( ! empty( $okp_footer_logo['link_url'] ) ) : ?>
								<a href="<?php echo esc_url( $okp_footer_logo['link_url'] ); ?>" tabindex="-1" aria-hidden="true">
									<?php echo $logo_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php else : ?>
								<span aria-hidden="true">
									<?php echo $logo_markup; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</span>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>

		<div class="site-footer__shell">
			<div class="site-footer__brand">
				<div class="site-footer__brand-head">
					<?php if ( function_exists( 'okperformance_site_logo' ) && ( has_custom_logo() || file_exists( get_template_directory() . '/assets/okperformance-d-barbell-monogram.svg' ) ) ) : ?>
						<div class="site-footer__logo">
							<?php okperformance_site_logo( 'footer' ); ?>
						</div>
					<?php else : ?>
						<a class="site-branding__mark site-branding__mark--footer" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
							<svg viewBox="0 0 32 32" aria-hidden="true" focusable="false">
								<rect x="4" y="10" width="4" height="12" rx="2"></rect>
								<rect x="24" y="10" width="4" height="12" rx="2"></rect>
								<rect x="8" y="14" width="16" height="4" rx="2"></rect>
								<path d="M11 8v16M21 8v16"></path>
							</svg>
						</a>
					<?php endif; ?>

					</div>

				<p class="site-footer__description">
					<?php
					$okperformance_description = get_bloginfo( 'description', 'display' );
					echo esc_html( $okperformance_description ? $okperformance_description : __( 'Elevating fitness through science-based training, premium nutrition, and an exclusive community.', 'okperformance' ) );
					?>
				</p>

				<div class="site-footer__social">
					<a class="site-footer__social-link" href="#" aria-label="<?php esc_attr_e( 'Instagram', 'okperformance' ); ?>">
						<svg viewBox="0 0 24 24" focusable="false">
							<rect x="3.5" y="3.5" width="17" height="17" rx="5"></rect>
							<circle cx="12" cy="12" r="4"></circle>
							<circle cx="17.5" cy="6.5" r="1"></circle>
						</svg>
					</a>
					<a class="site-footer__social-link" href="#" aria-label="<?php esc_attr_e( 'X / Twitter', 'okperformance' ); ?>">
						<svg viewBox="0 0 24 24" focusable="false">
							<path d="M18.9 4H21l-4.59 5.24L21.8 20h-4.22l-3.3-6.42L8.66 20H6.54l4.91-5.61L6.2 4h4.32l2.98 5.84Z"></path>
						</svg>
					</a>
					<a class="site-footer__social-link" href="#" aria-label="<?php esc_attr_e( 'YouTube', 'okperformance' ); ?>">
						<svg viewBox="0 0 24 24" focusable="false">
							<path d="M21.6 8.2a2.9 2.9 0 0 0-2-2c-1.8-.5-7.6-.5-7.6-.5s-5.8 0-7.6.5a2.9 2.9 0 0 0-2 2A31 31 0 0 0 2 12a31 31 0 0 0 .4 3.8 2.9 2.9 0 0 0 2 2c1.8.5 7.6.5 7.6.5s5.8 0 7.6-.5a2.9 2.9 0 0 0 2-2A31 31 0 0 0 22 12a31 31 0 0 0-.4-3.8Z"></path>
							<path d="m10 15.4 5.2-3.4L10 8.6Z"></path>
						</svg>
					</a>
				</div>
			</div>

			<div class="site-footer__menus">
				<div class="site-footer__menu-column">
					<nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer platform menu', 'okperformance' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-menu',
								'menu_id'        => 'footer-menu',
								'container'      => false,
								'menu_class'     => 'menu nav-menu menu--footer',
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>
				</div>

				<div class="site-footer__menu-column">
					<nav class="footer-meta-navigation" aria-label="<?php esc_attr_e( 'Footer company menu', 'okperformance' ); ?>">
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'footer-meta',
								'menu_id'        => 'footer-meta-menu',
								'container'      => false,
								'menu_class'     => 'menu nav-menu menu--footer-meta',
								'fallback_cb'    => false,
							)
						);
						?>
					</nav>
				</div>
			</div>

			<div class="site-footer__newsletter">
				<h2 class="site-footer__menu-title"><?php esc_html_e( 'Uudiskiri', 'okperformance' ); ?></h2>
				<p class="site-footer__newsletter-copy"><?php esc_html_e( 'Saa infot OKPerformance toimetamiste kohta.', 'okperformance' ); ?></p>
				<form class="site-footer__newsletter-form" action="#" method="post">
					<label class="screen-reader-text" for="footer-newsletter-email"><?php esc_html_e( 'Email address', 'okperformance' ); ?></label>
					<input id="footer-newsletter-email" class="site-footer__newsletter-input" type="email" name="footer_newsletter_email" placeholder="<?php esc_attr_e( 'Sisesta oma e-posti aadress', 'okperformance' ); ?>">
					<button class="site-footer__newsletter-button" type="submit"><?php esc_html_e( 'Liitu', 'okperformance' ); ?></button>
				</form>
			</div>
		</div>

		<div class="site-footer__base">
			<p class="site-footer__meta-text">
				<?php
				printf(
					/* translators: %s: current year. */
					esc_html__( '%s %s. All rights reserved.', 'okperformance' ),
					esc_html( wp_date( 'Y' ) ),
					esc_html( get_bloginfo( 'name' ) )
				);
				?>
				<span aria-hidden="true"> | </span>
				<a class="site-footer__credit-link" href="<?php echo esc_url( 'https://alexeerma.ee/' ); ?>" target="_blank" rel="noopener noreferrer">
					<?php esc_html_e( 'Web by Alexeerma', 'okperformance' ); ?>
				</a>
			</p>

			<div class="site-footer__legal">
				<?php if ( get_privacy_policy_url() ) : ?>
					<a href="<?php echo esc_url( get_privacy_policy_url() ); ?>"><?php esc_html_e( 'Privacy Policy', 'okperformance' ); ?></a>
				<?php endif; ?>
				<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>"><?php esc_html_e( 'Terms of Service', 'okperformance' ); ?></a>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
