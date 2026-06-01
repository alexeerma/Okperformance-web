<?php
/**
 * Template Name: About Us
 * Template Post Type: page
 *
 * @package OKPerformance
 */

get_header();

if ( ! function_exists( 'okperformance_about_page_icon' ) ) {
	/**
	 * Return small inline icons for the About page coach action links.
	 *
	 * @param string $icon Icon key.
	 * @return string
	 */
	function okperformance_about_page_icon( $icon ) {
		switch ( $icon ) {
			case 'instagram':
				return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><rect x="4" y="4" width="16" height="16" rx="5"></rect><circle cx="12" cy="12" r="3.2"></circle><path d="M17.2 6.9h.01"></path></svg>';
			case 'facebook':
				return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M14 8.2h2.4V4.4A15.3 15.3 0 0 0 13 4.2c-3.4 0-5.1 2-5.1 5v2.8H4.8v4.2h3.1V22h4.3v-5.8h3.5l.6-4.2h-4.1V9.6c0-1 .3-1.4 1.8-1.4Z"></path></svg>';
			case 'cv':
			default:
				return '<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7 3h7l4 4v14H7z"></path><path d="M14 3v5h5"></path><path d="M9.5 13h5"></path><path d="M9.5 16h4"></path></svg>';
		}
	}
}

$okp_home_opts = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();
$page_object   = get_queried_object();
$page_title    = $page_object instanceof WP_Post ? get_the_title( $page_object ) : '';

$hero_pill_label = (string) ( $okp_home_opts['about_page_pill_label'] ?? __( 'About OKPerformance', 'okperformance' ) );
$hero_title      = (string) ( $okp_home_opts['about_page_title'] ?? '' );
$hero_lede       = (string) ( $okp_home_opts['about_page_lede'] ?? '' );

$hero_title = '' !== $hero_title ? $hero_title : $page_title;

$contact_pages = get_pages(
	array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'page-templates/contact.php',
		'number'     => 1,
	)
);
$default_contact_url = ! empty( $contact_pages ) ? get_permalink( $contact_pages[0] ) : home_url( '/contact/' );

$people = array(
	array(
		'name'          => (string) ( $okp_home_opts['about_page_person_1_name'] ?? __( 'Coach One', 'okperformance' ) ),
		'role'          => (string) ( $okp_home_opts['about_page_person_1_role'] ?? __( 'Performance coach', 'okperformance' ) ),
		'focus'         => (string) ( $okp_home_opts['about_page_person_1_focus'] ?? __( 'Training systems', 'okperformance' ) ),
		'bio'           => (string) ( $okp_home_opts['about_page_person_1_bio'] ?? '' ),
		'quote'         => (string) ( $okp_home_opts['about_page_person_1_quote'] ?? '' ),
		'image_id'      => absint( $okp_home_opts['about_page_person_1_image_id'] ?? 0 ),
		'image_alt'     => (string) ( $okp_home_opts['about_page_person_1_image_alt'] ?? __( 'Portrait of the first coach', 'okperformance' ) ),
		'cv_label'      => (string) ( $okp_home_opts['about_page_person_1_cv_label'] ?? __( 'CV', 'okperformance' ) ),
		'cv_url'        => (string) ( $okp_home_opts['about_page_person_1_cv_url'] ?? '' ),
		'contact_label' => (string) ( $okp_home_opts['about_page_person_1_contact_label'] ?? __( 'Contact', 'okperformance' ) ),
		'contact_url'   => (string) ( $okp_home_opts['about_page_person_1_contact_url'] ?? '' ),
		'instagram_url' => (string) ( $okp_home_opts['about_page_person_1_instagram_url'] ?? '' ),
		'facebook_url'  => (string) ( $okp_home_opts['about_page_person_1_facebook_url'] ?? '' ),
	),
	array(
		'name'          => (string) ( $okp_home_opts['about_page_person_2_name'] ?? __( 'Coach Two', 'okperformance' ) ),
		'role'          => (string) ( $okp_home_opts['about_page_person_2_role'] ?? __( 'Nutrition & performance coach', 'okperformance' ) ),
		'focus'         => (string) ( $okp_home_opts['about_page_person_2_focus'] ?? __( 'Nutrition strategy', 'okperformance' ) ),
		'bio'           => (string) ( $okp_home_opts['about_page_person_2_bio'] ?? '' ),
		'quote'         => (string) ( $okp_home_opts['about_page_person_2_quote'] ?? '' ),
		'image_id'      => absint( $okp_home_opts['about_page_person_2_image_id'] ?? 0 ),
		'image_alt'     => (string) ( $okp_home_opts['about_page_person_2_image_alt'] ?? __( 'Portrait of the second coach', 'okperformance' ) ),
		'cv_label'      => (string) ( $okp_home_opts['about_page_person_2_cv_label'] ?? __( 'CV', 'okperformance' ) ),
		'cv_url'        => (string) ( $okp_home_opts['about_page_person_2_cv_url'] ?? '' ),
		'contact_label' => (string) ( $okp_home_opts['about_page_person_2_contact_label'] ?? __( 'Contact', 'okperformance' ) ),
		'contact_url'   => (string) ( $okp_home_opts['about_page_person_2_contact_url'] ?? '' ),
		'instagram_url' => (string) ( $okp_home_opts['about_page_person_2_instagram_url'] ?? '' ),
		'facebook_url'  => (string) ( $okp_home_opts['about_page_person_2_facebook_url'] ?? '' ),
	),
);
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-about-page">
	<section class="okp-about-page__people-hero" aria-label="<?php esc_attr_e( 'About us', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-about-page__intro">
				<?php if ( '' !== $hero_pill_label ) : ?>
					<div class="okp-pill"><?php echo esc_html( $hero_pill_label ); ?></div>
				<?php endif; ?>

				<?php if ( '' !== $hero_title ) : ?>
					<h1 class="okp-about-page__hero-title"><?php echo esc_html( $hero_title ); ?></h1>
				<?php endif; ?>

				<?php if ( '' !== $hero_lede ) : ?>
					<div class="okp-about-page__hero-lede"><?php echo wpautop( wp_kses_post( $hero_lede ) ); ?></div>
				<?php endif; ?>
			</div>

			<div class="okp-about-page__team-grid">
				<?php foreach ( $people as $person ) : ?>
					<?php
					$person_image = $person['image_id']
						? wp_get_attachment_image(
							$person['image_id'],
							'large',
							false,
							array(
								'loading' => 'lazy',
								'alt'     => $person['image_alt'],
								'class'   => 'okp-about-page__person-photo',
							)
						)
						: '';
					$initial      = '' !== $person['name'] ? $person['name'] : '?';
					$initial      = function_exists( 'mb_substr' ) ? mb_substr( $initial, 0, 1 ) : substr( $initial, 0, 1 );
					$initial      = function_exists( 'mb_strtoupper' ) ? mb_strtoupper( $initial ) : strtoupper( $initial );
					$contact_url  = '' !== $person['contact_url'] ? $person['contact_url'] : $default_contact_url;
					$cv_label     = '' !== $person['cv_label'] ? $person['cv_label'] : __( 'CV', 'okperformance' );
					?>
					<article class="okp-about-page__person-card">
						<div class="okp-about-page__person-media">
							<?php if ( $person_image ) : ?>
								<?php echo $person_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							<?php else : ?>
								<div class="okp-about-page__person-placeholder" aria-hidden="true">
									<span><?php echo esc_html( $initial ); ?></span>
								</div>
							<?php endif; ?>
						</div>

						<div class="okp-about-page__person-content">
							<?php if ( '' !== $person['focus'] ) : ?>
								<div class="okp-about-page__person-focus"><?php echo esc_html( $person['focus'] ); ?></div>
							<?php endif; ?>

							<h3 class="okp-about-page__person-name"><?php echo esc_html( $person['name'] ); ?></h3>

							<?php if ( '' !== $person['role'] ) : ?>
								<p class="okp-about-page__person-role"><?php echo esc_html( $person['role'] ); ?></p>
							<?php endif; ?>

							<?php if ( '' !== $person['bio'] ) : ?>
								<div class="okp-about-page__person-bio"><?php echo wpautop( wp_kses_post( $person['bio'] ) ); ?></div>
							<?php endif; ?>

							<?php if ( '' !== $person['quote'] ) : ?>
								<blockquote class="okp-about-page__person-quote"><?php echo esc_html( $person['quote'] ); ?></blockquote>
							<?php endif; ?>

							<div class="okp-about-page__person-actions">
								<div class="okp-about-page__person-icon-links" aria-label="<?php esc_attr_e( 'Coach links', 'okperformance' ); ?>">
									<?php if ( '' !== $cv_label ) : ?>
										<?php if ( '' !== $person['cv_url'] ) : ?>
											<a class="okp-about-page__person-icon-link" href="<?php echo esc_url( $person['cv_url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( '%1$s: %2$s', $person['name'], $cv_label ) ); ?>">
												<?php echo okperformance_about_page_icon( 'cv' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</a>
										<?php else : ?>
											<span class="okp-about-page__person-icon-link is-disabled" aria-label="<?php echo esc_attr( sprintf( '%1$s: %2$s', $person['name'], $cv_label ) ); ?>" aria-disabled="true">
												<?php echo okperformance_about_page_icon( 'cv' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</span>
										<?php endif; ?>
									<?php endif; ?>

									<?php if ( '' !== $person['instagram_url'] ) : ?>
										<a class="okp-about-page__person-icon-link" href="<?php echo esc_url( $person['instagram_url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( '%s Instagramis', 'okperformance' ), $person['name'] ) ); ?>">
											<?php echo okperformance_about_page_icon( 'instagram' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</a>
									<?php endif; ?>

									<?php if ( '' !== $person['facebook_url'] ) : ?>
										<a class="okp-about-page__person-icon-link" href="<?php echo esc_url( $person['facebook_url'] ); ?>" aria-label="<?php echo esc_attr( sprintf( __( '%s Facebookis', 'okperformance' ), $person['name'] ) ); ?>">
											<?php echo okperformance_about_page_icon( 'facebook' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										</a>
									<?php endif; ?>
								</div>

								<?php if ( '' !== $person['contact_label'] && '' !== $contact_url ) : ?>
									<a class="okp-about-page__person-button okp-about-page__person-button--primary" href="<?php echo esc_url( $contact_url ); ?>">
										<span><?php echo esc_html( $person['contact_label'] ); ?></span>
										<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
											<path d="M5 12h14"></path>
											<path d="m13 6 6 6-6 6"></path>
										</svg>
									</a>
								<?php endif; ?>
							</div>
						</div>
					</article>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
