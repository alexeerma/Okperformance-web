<?php
/**
 * Template for displaying a single Package (okp_package / Paketid).
 *
 * Mirrors the OKPerformance dark/purple design language: a hero with
 * focus + level + duration + price meta, a full description, four
 * editor-configured highlight cards, and a closing call-to-action.
 *
 * @package OKPerformance
 */

get_header();

while ( have_posts() ) :
	the_post();

	$package_id      = get_the_ID();
	$package_title   = get_the_title();
	$package_excerpt = has_excerpt() ? get_the_excerpt() : '';
	$package_content = apply_filters( 'the_content', get_the_content() );

	$package_image = get_the_post_thumbnail(
		$package_id,
		'okp_package_hero',
		array(
			'loading'       => 'eager',
			'decoding'      => 'async',
			'alt'           => $package_title,
			'class'         => 'okp-service-single__hero-img',
			'sizes'         => '(max-width: 960px) 92vw, 520px',
			'fetchpriority' => 'high',
		)
	);

	if ( '' === $package_image ) {
		$package_image = get_the_post_thumbnail(
			$package_id,
			'large',
			array(
				'loading'       => 'eager',
				'decoding'      => 'async',
				'alt'           => $package_title,
				'class'         => 'okp-service-single__hero-img',
				'sizes'         => '(max-width: 960px) 92vw, 520px',
				'fetchpriority' => 'high',
			)
		);
	}

	$packages_archive = get_post_type_archive_link( 'okp_package' );
	$shop_url         = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );

	$cards = function_exists( 'okperformance_get_package_cards' )
		? okperformance_get_package_cards( $package_id )
		: array();

	$meta = function_exists( 'okperformance_get_package_meta' )
		? okperformance_get_package_meta( $package_id )
		: array(
			'focus'       => '',
			'focus_label' => '',
			'level'       => '',
			'duration'    => '',
			'price'       => '',
			'cta_url'     => '',
			'cta_label'   => '',
		);

	$primary_cta_url   = '' !== $meta['cta_url'] ? $meta['cta_url'] : $shop_url;
	$primary_cta_label = '' !== $meta['cta_label'] ? $meta['cta_label'] : __( 'Liitu paketiga', 'okperformance' );

	$has_hero_meta = '' !== $meta['level'] || '' !== $meta['duration'] || '' !== $meta['price'];
	?>

	<div id="okp-mouse-glow" aria-hidden="true"></div>

	<main id="primary" class="site-main okp-service-single okp-package-single">
		<section class="okp-service-hero okp-package-hero" aria-label="<?php esc_attr_e( 'Paketi ülevaade', 'okperformance' ); ?>">
			<div class="okp-hero__ambient" aria-hidden="true"></div>
			<div class="okp-hero__noise" aria-hidden="true"></div>

			<div class="okp-home__shell okp-service-hero__shell">
				<div class="okp-service-hero__copy">
					<div class="okp-package-hero__tags">
						<div class="okp-pill okp-service-hero__pill">
							<?php esc_html_e( 'Pakett', 'okperformance' ); ?>
						</div>

						<?php if ( '' !== $meta['focus_label'] ) : ?>
							<div class="okp-package-hero__focus okp-package-hero__focus--<?php echo esc_attr( $meta['focus'] ); ?>">
								<?php echo esc_html( $meta['focus_label'] ); ?>
							</div>
						<?php endif; ?>
					</div>

					<h1 class="okp-service-hero__title"><?php echo esc_html( $package_title ); ?></h1>

					<?php if ( '' !== $package_excerpt ) : ?>
						<p class="okp-service-hero__lede">
							<?php echo wp_kses_post( $package_excerpt ); ?>
						</p>
					<?php endif; ?>

					<?php if ( $has_hero_meta ) : ?>
						<dl class="okp-package-hero__meta">
							<?php if ( '' !== $meta['price'] ) : ?>
								<div class="okp-package-hero__meta-item okp-package-hero__meta-item--price">
									<dt><?php esc_html_e( 'Hind', 'okperformance' ); ?></dt>
									<dd><?php echo esc_html( $meta['price'] ); ?></dd>
								</div>
							<?php endif; ?>

							<?php if ( '' !== $meta['duration'] ) : ?>
								<div class="okp-package-hero__meta-item">
									<dt><?php esc_html_e( 'Kestus', 'okperformance' ); ?></dt>
									<dd><?php echo esc_html( $meta['duration'] ); ?></dd>
								</div>
							<?php endif; ?>

							<?php if ( '' !== $meta['level'] ) : ?>
								<div class="okp-package-hero__meta-item">
									<dt><?php esc_html_e( 'Tase', 'okperformance' ); ?></dt>
									<dd><?php echo esc_html( $meta['level'] ); ?></dd>
								</div>
							<?php endif; ?>
						</dl>
					<?php endif; ?>

					<div class="okp-service-hero__actions">
						<?php if ( $primary_cta_url ) : ?>
							<a class="okp-btn okp-btn--primary" href="<?php echo esc_url( $primary_cta_url ); ?>">
								<?php echo esc_html( $primary_cta_label ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $packages_archive ) : ?>
							<a class="okp-btn" href="<?php echo esc_url( $packages_archive ); ?>">
								<?php esc_html_e( 'Kõik paketid', 'okperformance' ); ?>
							</a>
						<?php endif; ?>
					</div>
				</div>

				<?php if ( $package_image ) : ?>
					<div class="okp-service-hero__media" aria-hidden="true">
						<div class="okp-service-hero__media-frame">
							<?php echo $package_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					</div>
				<?php else : ?>
					<div class="okp-service-hero__media okp-service-hero__media--placeholder" aria-hidden="true">
						<div class="okp-service-hero__media-frame">
							<span><?php echo esc_html( mb_strtoupper( mb_substr( $package_title, 0, 1 ) ) ); ?></span>
						</div>
					</div>
				<?php endif; ?>
			</div>
		</section>

		<?php if ( trim( wp_strip_all_tags( $package_content ) ) !== '' ) : ?>
			<section class="okp-section okp-service-description" aria-label="<?php esc_attr_e( 'Paketi kirjeldus', 'okperformance' ); ?>">
				<div class="okp-home__shell">
					<div class="okp-service-description__layout">
						<div class="okp-service-description__eyebrow">
							<?php esc_html_e( 'Paketist lähemalt', 'okperformance' ); ?>
						</div>
						<div class="okp-service-description__body">
							<?php echo $package_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
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
			<section class="okp-section okp-service-cards" aria-label="<?php esc_attr_e( 'Paketi sisu', 'okperformance' ); ?>">
				<div class="okp-home__shell">
					<div class="okp-section__header">
						<div>
							<h2 class="okp-section__title">
								<?php esc_html_e( 'Mis paketis sisaldub', 'okperformance' ); ?>
							</h2>
							<p class="okp-section__lede okp-section__lede--small">
								<?php esc_html_e( 'Lühike ülevaade sellest, mida sportlane paketiga saab ja milliseid tulemusi oodata.', 'okperformance' ); ?>
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

		<section class="okp-section okp-service-cta" aria-label="<?php esc_attr_e( 'Liitu paketiga', 'okperformance' ); ?>">
			<div class="okp-home__shell">
				<div class="okp-service-cta__panel">
					<div class="okp-service-cta__copy">
						<div class="okp-service-cta__eyebrow">
							<?php esc_html_e( 'Valmis alustama?', 'okperformance' ); ?>
						</div>
						<h2 class="okp-service-cta__title">
							<?php
							printf(
								/* translators: %s: package title. */
								esc_html__( '%s ootab sind – tee järgmine samm juba täna.', 'okperformance' ),
								esc_html( $package_title )
							);
							?>
						</h2>
					</div>

					<div class="okp-service-cta__actions">
						<?php if ( $primary_cta_url ) : ?>
							<a class="okp-btn okp-btn--primary" href="<?php echo esc_url( $primary_cta_url ); ?>">
								<?php echo esc_html( $primary_cta_label ); ?>
							</a>
						<?php endif; ?>

						<?php if ( $packages_archive ) : ?>
							<a class="okp-btn" href="<?php echo esc_url( $packages_archive ); ?>">
								<?php esc_html_e( 'Vaata kõiki pakette', 'okperformance' ); ?>
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
