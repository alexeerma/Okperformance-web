<?php
/**
 * Template Name: Services Grid
 * Template Post Type: page
 *
 * Renders a full Services listing inside a regular WordPress Page using the
 * same card markup as the homepage and the Services archive. The Page's own
 * title and editor content are used for the header, with sensible fallbacks
 * to the homepage options.
 *
 * @package OKPerformance
 */

get_header();

$okp_home_opts = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();

$queried_page = get_queried_object();
$page_title   = $queried_page instanceof WP_Post ? get_the_title( $queried_page ) : '';
$page_lede    = '';

if ( $queried_page instanceof WP_Post ) {
	$page_lede = wp_strip_all_tags( (string) $queried_page->post_content );
	$page_lede = trim( preg_replace( '/\s+/', ' ', $page_lede ) );
}

$services_title           = '' !== $page_title ? $page_title : (string) ( $okp_home_opts['services_title'] ?? __( 'Services', 'okperformance' ) );
$services_lede            = '' !== $page_lede ? $page_lede : (string) ( $okp_home_opts['services_lede'] ?? __( 'Choose the support you need, from tailored coaching and performance plans to nutrition guidance and recovery-focused systems.', 'okperformance' ) );
$services_card_link_label = (string) ( $okp_home_opts['services_card_link_label'] ?? __( 'Learn more', 'okperformance' ) );
$services_fallback_text   = (string) ( $okp_home_opts['services_fallback_text'] ?? __( 'A tailored service designed to support your goals and long-term performance.', 'okperformance' ) );
$services_empty_text      = (string) ( $okp_home_opts['services_empty_text'] ?? __( 'No services have been published yet. Add Services in the WordPress admin and they will appear here automatically.', 'okperformance' ) );

$services = function_exists( 'okperformance_get_home_services' ) ? okperformance_get_home_services( -1 ) : array();
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-services-archive">
	<section class="okp-section okp-services" aria-label="<?php esc_attr_e( 'Services', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-section__header">
				<div>
					<div class="okp-pill"><?php esc_html_e( 'Kõik teenused', 'okperformance' ); ?></div>
					<h1 class="okp-section__title"><?php echo esc_html( $services_title ); ?></h1>
					<?php if ( '' !== $services_lede ) : ?>
						<p class="okp-section__lede okp-section__lede--small"><?php echo esc_html( $services_lede ); ?></p>
					<?php endif; ?>
				</div>
			</div>

			<?php if ( ! empty( $services ) ) : ?>
				<div class="okp-services-grid">
					<?php foreach ( $services as $service ) : ?>
						<?php
						$service_excerpt = has_excerpt( $service ) ? $service->post_excerpt : $service->post_content;
						$service_excerpt = wp_trim_words( wp_strip_all_tags( (string) $service_excerpt ), 22 );
						$service_image   = get_the_post_thumbnail(
							$service,
							'medium_large',
							array(
								'loading' => 'lazy',
								'alt'     => get_the_title( $service ),
							)
						);
						?>
						<article class="okp-service-card">
							<?php if ( $service_image ) : ?>
								<a class="okp-service-card__image" href="<?php echo esc_url( get_permalink( $service ) ); ?>">
									<?php echo $service_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php else : ?>
								<div class="okp-service-card__image okp-service-card__image--placeholder" aria-hidden="true">
									<span><?php echo esc_html( mb_strtoupper( mb_substr( get_the_title( $service ), 0, 1 ) ) ); ?></span>
								</div>
							<?php endif; ?>

							<div class="okp-service-card__content">
								<h2 class="okp-service-card__title">
									<a href="<?php echo esc_url( get_permalink( $service ) ); ?>"><?php echo esc_html( get_the_title( $service ) ); ?></a>
								</h2>

								<p class="okp-service-card__text">
									<?php
									echo esc_html(
										'' !== $service_excerpt
											? $service_excerpt
											: $services_fallback_text
									);
									?>
								</p>

								<a class="okp-service-card__link" href="<?php echo esc_url( get_permalink( $service ) ); ?>">
									<?php echo esc_html( $services_card_link_label ); ?>
								</a>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="okp-products-empty">
					<p><?php echo esc_html( $services_empty_text ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
