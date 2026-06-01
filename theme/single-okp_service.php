<?php
/**
 * Template for displaying a single Service (okp_service).
 *
 * Matches the dark/purple OKPerformance design language: hero header, lede
 * description, and a grid of four editor-defined detail cards
 * (e.g. "Kellel sobib?", "Miks valida?", "Mida saad?", "Lisaväärtus").
 *
 * @package OKPerformance
 */

get_header();

while ( have_posts() ) :
	the_post();

	$service_id       = get_the_ID();
	$service_title    = get_the_title();
	$service_excerpt  = has_excerpt() ? get_the_excerpt() : '';
	$service_content  = apply_filters( 'the_content', get_the_content() );
	$service_image    = get_the_post_thumbnail(
		$service_id,
		'okp_service_hero',
		array(
			'loading'     => 'eager',
			'decoding'    => 'async',
			'alt'         => $service_title,
			'class'       => 'okp-service-single__hero-img',
			'sizes'       => '(max-width: 960px) 92vw, 520px',
			'fetchpriority' => 'high',
		)
	);

	if ( '' === $service_image ) {
		$service_image = get_the_post_thumbnail(
			$service_id,
			'large',
			array(
				'loading'       => 'eager',
				'decoding'      => 'async',
				'alt'           => $service_title,
				'class'         => 'okp-service-single__hero-img',
				'sizes'         => '(max-width: 960px) 92vw, 520px',
				'fetchpriority' => 'high',
			)
		);
	}
	$services_archive = get_post_type_archive_link( 'okp_service' );
	$shop_url         = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );

	$contact_pages = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'page-templates/contact.php',
			'number'     => 1,
		)
	);
	$contact_url = ! empty( $contact_pages ) ? get_permalink( $contact_pages[0] ) : home_url( '/contact/' );

	$cards = function_exists( 'okperformance_get_service_cards' )
		? okperformance_get_service_cards( $service_id )
		: array();

	$mid_content_raw = function_exists( 'okperformance_get_service_mid_content' )
		? okperformance_get_service_mid_content( $service_id )
		: (string) get_post_meta( $service_id, '_okp_service_mid_content', true );
	$mid_content = '' !== $mid_content_raw ? apply_filters( 'the_content', $mid_content_raw ) : '';
	?>

	<div id="okp-mouse-glow" aria-hidden="true"></div>

	<main id="primary" class="site-main okp-service-single">
		<section class="okp-service-hero" aria-label="<?php esc_attr_e( 'Teenuse ülevaade', 'okperformance' ); ?>">
			<div class="okp-home__shell okp-service-hero__shell">
				<?php if ( $services_archive ) : ?>
					<a class="okp-service-hero__back" href="<?php echo esc_url( $services_archive ); ?>">
						<span aria-hidden="true">&larr;</span>
						<?php esc_html_e( 'Kõik teenused', 'okperformance' ); ?>
					</a>
				<?php endif; ?>

				<article class="okp-service-hero__card">
					<?php if ( $service_image ) : ?>
						<div class="okp-service-hero__media">
							<?php echo $service_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php else : ?>
						<div class="okp-service-hero__media okp-service-hero__media--placeholder" aria-hidden="true">
							<span><?php echo esc_html( mb_strtoupper( mb_substr( $service_title, 0, 1 ) ) ); ?></span>
						</div>
					<?php endif; ?>

					<div class="okp-service-hero__copy">
						<h1 class="okp-service-hero__title"><?php echo esc_html( $service_title ); ?></h1>

						<?php if ( trim( wp_strip_all_tags( $service_content ) ) !== '' ) : ?>
							<div class="okp-service-hero__content">
								<?php echo $service_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</div>
						<?php elseif ( '' !== $service_excerpt ) : ?>
							<div class="okp-service-hero__content">
								<p><?php echo wp_kses_post( $service_excerpt ); ?></p>
							</div>
						<?php endif; ?>

						<?php if ( $contact_url ) : ?>
							<div class="okp-service-hero__actions">
								<a class="okp-btn okp-btn--primary" href="<?php echo esc_url( $contact_url ); ?>">
									<?php esc_html_e( 'Võta ühendust', 'okperformance' ); ?>
								</a>
							</div>
						<?php endif; ?>
					</div>
				</article>
			</div>
		</section>

		<?php if ( '' !== $mid_content ) : ?>
			<section class="okp-section okp-service-extra" aria-label="<?php esc_attr_e( 'Teenuse lisainfo', 'okperformance' ); ?>">
				<div class="okp-home__shell">
					<div class="okp-service-extra__body">
						<?php echo $mid_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<?php
		$visible_cards = array();

		if ( ! empty( $cards ) ) {
			foreach ( $cards as $card ) {
				if ( '' !== trim( (string) $card['title'] ) ) {
					$visible_cards[] = $card;
				}
			}
		}
		?>

		<?php if ( ! empty( $visible_cards ) ) : ?>
			<section class="okp-section okp-service-cards" aria-label="<?php esc_attr_e( 'Teenuse põhipunktid', 'okperformance' ); ?>">
				<div class="okp-home__shell">
					<div class="okp-section__header">
						<div>
							<h2 class="okp-section__title">
								<?php esc_html_e( 'Mis sind ees ootab', 'okperformance' ); ?>
							</h2>
							<p class="okp-section__lede okp-section__lede--small">
								<?php esc_html_e( 'Neli kiiret vastust kõige olulisematele küsimustele selle teenuse kohta.', 'okperformance' ); ?>
							</p>
						</div>
					</div>

					<div class="okp-service-cards__grid">
						<?php foreach ( $visible_cards as $index => $card ) : ?>
							<article class="okp-service-info-card">
								<div class="okp-service-info-card__index">
									<?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?>
								</div>
								<div class="okp-service-info-card__body">
									<h3 class="okp-service-info-card__title">
										<?php echo esc_html( $card['title'] ); ?>
									</h3>
									<?php if ( '' !== trim( (string) $card['text'] ) ) : ?>
										<p class="okp-service-info-card__text">
											<?php echo wp_kses_post( wpautop( $card['text'] ) ); ?>
										</p>
									<?php endif; ?>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				</div>
			</section>
		<?php endif; ?>

		<section class="okp-section okp-service-cta" aria-label="<?php esc_attr_e( 'Võta ühendust', 'okperformance' ); ?>">
			<div class="okp-home__shell">
				<div class="okp-service-cta__panel">
					<div class="okp-service-cta__copy">
						<div class="okp-service-cta__eyebrow">
							<?php esc_html_e( 'Valmis alustama?', 'okperformance' ); ?>
						</div>
						<h2 class="okp-service-cta__title">
							<?php
							printf(
								/* translators: %s: service title. */
								esc_html__( 'Teeme %s sulle sobivaks sammuks edasi.', 'okperformance' ),
								esc_html( $service_title )
							);
							?>
						</h2>
					</div>

					<div class="okp-service-cta__actions">
						<?php if ( $contact_url ) : ?>
							<a class="okp-btn okp-btn--primary" href="<?php echo esc_url( $contact_url ); ?>">
								<?php esc_html_e( 'Võta ühendust', 'okperformance' ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $services_archive ) : ?>
							<a class="okp-btn" href="<?php echo esc_url( $services_archive ); ?>">
								<?php esc_html_e( 'Vaata kõiki teenuseid', 'okperformance' ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	</main>

	<?php
endwhile;

get_footer();
