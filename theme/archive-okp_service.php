<?php
/**
 * Archive template for the Services (okp_service) post type.
 *
 * Mirrors the homepage services section so the archive feels part of the
 * same visual system: dark/purple aesthetic, section shell, and the shared
 * .okp-service-card markup.
 *
 * @package OKPerformance
 */

get_header();

$okp_home_opts = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();

$services_title           = (string) ( $okp_home_opts['services_title'] ?? __( 'Services', 'okperformance' ) );
$services_lede            = (string) ( $okp_home_opts['services_lede'] ?? __( 'Choose the support you need, from tailored coaching and performance plans to nutrition guidance and recovery-focused systems.', 'okperformance' ) );
$services_card_link_label = (string) ( $okp_home_opts['services_card_link_label'] ?? __( 'Learn more', 'okperformance' ) );
$services_fallback_text   = (string) ( $okp_home_opts['services_fallback_text'] ?? __( 'A tailored service designed to support your goals and long-term performance.', 'okperformance' ) );
$services_empty_text      = (string) ( $okp_home_opts['services_empty_text'] ?? __( 'No services have been published yet. Add Services in the WordPress admin and they will appear here automatically.', 'okperformance' ) );
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-services-archive">
	<section class="okp-section okp-services" aria-label="<?php esc_attr_e( 'Services archive', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-section__header">
				<div>
					<div class="okp-pill"><?php esc_html_e( 'Kõik teenused', 'okperformance' ); ?></div>
					<h1 class="okp-section__title"><?php echo esc_html( $services_title ); ?></h1>
					<p class="okp-section__lede okp-section__lede--small"><?php echo esc_html( $services_lede ); ?></p>
				</div>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="okp-services-grid">
					<?php
					while ( have_posts() ) :
						the_post();

						$service_excerpt = has_excerpt() ? get_the_excerpt() : get_the_content();
						$service_excerpt = wp_trim_words( wp_strip_all_tags( (string) $service_excerpt ), 22 );
						$service_image   = get_the_post_thumbnail(
							get_the_ID(),
							'medium_large',
							array(
								'loading' => 'lazy',
								'alt'     => get_the_title(),
							)
						);
						?>
						<article <?php post_class( 'okp-service-card' ); ?>>
							<?php if ( $service_image ) : ?>
								<a class="okp-service-card__image" href="<?php the_permalink(); ?>">
									<?php echo $service_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php else : ?>
								<div class="okp-service-card__image okp-service-card__image--placeholder" aria-hidden="true">
									<span><?php echo esc_html( mb_strtoupper( mb_substr( get_the_title(), 0, 1 ) ) ); ?></span>
								</div>
							<?php endif; ?>

							<div class="okp-service-card__content">
								<h2 class="okp-service-card__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
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

								<a class="okp-service-card__link" href="<?php the_permalink(); ?>">
									<?php echo esc_html( $services_card_link_label ); ?>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<?php
				$pagination_links = paginate_links(
					array(
						'type'      => 'array',
						'prev_text' => __( 'Previous', 'okperformance' ),
						'next_text' => __( 'Next', 'okperformance' ),
					)
				);

				if ( ! empty( $pagination_links ) ) :
					?>
					<nav class="okp-archive-pagination" aria-label="<?php esc_attr_e( 'Services pagination', 'okperformance' ); ?>">
						<?php foreach ( $pagination_links as $link ) : ?>
							<span class="okp-archive-pagination__item"><?php echo wp_kses_post( $link ); ?></span>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>
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
