<?php
/**
 * Shared homepage content.
 *
 * @package OKPerformance
 */

$okp_home_opts = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();
$products      = function_exists( 'okperformance_home_get_products' ) ? okperformance_home_get_products( $okp_home_opts ) : array();
$services      = function_exists( 'okperformance_get_home_services' ) ? okperformance_get_home_services( 4 ) : array();

$hero_eyebrow             = (string) ( $okp_home_opts['hero_eyebrow'] ?? 'Science-based training & premium nutrition' );
$hero_title               = (string) ( $okp_home_opts['hero_title'] ?? 'OK Performance' );
$hero_subtitle            = (string) ( $okp_home_opts['hero_subtitle'] ?? 'Build strength, improve endurance, and recover smarter with training plans, nutrition guidance, and an exclusive community.' );
$hero_primary_cta_label   = (string) ( $okp_home_opts['hero_primary_cta_label'] ?? 'Vaata jõusaali programme' );
$hero_secondary_cta_label = (string) ( $okp_home_opts['hero_secondary_cta_label'] ?? 'Vaata pakette' );
$about_eyebrow      = (string) ( $okp_home_opts['about_eyebrow'] ?? 'What we do' );
$about_title        = (string) ( $okp_home_opts['about_title'] ?? 'Coaching systems built for measurable progress' );
$about_text         = (string) ( $okp_home_opts['about_text'] ?? 'OK Performance helps athletes train with clarity and consistency. We combine science-based programming, premium nutrition, and a supportive system so progress feels structured, motivating, and sustainable.' );
$about_link_label   = (string) ( $okp_home_opts['about_link_label'] ?? __( 'Read more', 'okperformance' ) );
$about_link_url_override = (string) ( $okp_home_opts['about_link_url'] ?? '' );
$about_panel_label  = (string) ( $okp_home_opts['about_panel_eyebrow'] ?? 'Built to convert' );
$about_panel_title  = (string) ( $okp_home_opts['about_panel_title'] ?? 'Premium coaching without generic templates' );
$about_panel_text   = (string) ( $okp_home_opts['about_panel_text'] ?? 'Every offer can be framed around outcomes, confidence, and long-term athlete development instead of one-size-fits-all plans.' );
$about_cards        = array(
	array(
		'title' => (string) ( $okp_home_opts['about_card_1_title'] ?? 'Structured plans' ),
		'text'  => (string) ( $okp_home_opts['about_card_1_text'] ?? 'Workouts designed for progressive overload, energy management, and recovery that actually fits real life.' ),
	),
	array(
		'title' => (string) ( $okp_home_opts['about_card_2_title'] ?? 'Nutrition support' ),
		'text'  => (string) ( $okp_home_opts['about_card_2_text'] ?? 'Guidance and product recommendations built around performance, body composition, and consistency goals.' ),
	),
	array(
		'title' => (string) ( $okp_home_opts['about_card_3_title'] ?? 'Exclusive community' ),
		'text'  => (string) ( $okp_home_opts['about_card_3_text'] ?? 'Accountability, education, and a premium experience that keeps athletes engaged beyond the first month.' ),
	),
	array(
		'title' => (string) ( $okp_home_opts['about_card_4_title'] ?? 'Recovery systems' ),
		'text'  => (string) ( $okp_home_opts['about_card_4_text'] ?? 'Recovery, check-ins, and sustainable pacing built into the coaching process so progress keeps compounding.' ),
	),
);

$services_title           = (string) ( $okp_home_opts['services_title'] ?? 'Services' );
$services_lede            = (string) ( $okp_home_opts['services_lede'] ?? 'Choose the support you need, from tailored coaching and performance plans to nutrition guidance and recovery-focused systems.' );
$services_link_label      = (string) ( $okp_home_opts['services_link_label'] ?? 'View all services' );
$services_card_link_label = (string) ( $okp_home_opts['services_card_link_label'] ?? 'Learn more' );
$services_fallback_text   = (string) ( $okp_home_opts['services_fallback_text'] ?? 'A tailored service designed to support your goals and long-term performance.' );
$services_empty_text      = (string) ( $okp_home_opts['services_empty_text'] ?? 'No services have been published yet. Add Services in the WordPress admin and they will appear here automatically.' );
$services_url   = get_post_type_archive_link( 'okp_service' );


$team_title            = (string) ( $okp_home_opts['team_title'] ?? __( 'The two coaches behind every OKPerformance journey', 'okperformance' ) );
$team_lede             = (string) ( $okp_home_opts['team_lede'] ?? __( 'Personal coaching from a small team. Every athlete works directly with the people building their plan.', 'okperformance' ) );
$team_cta_label        = (string) ( $okp_home_opts['team_cta_label'] ?? __( 'Read our story', 'okperformance' ) );
$team_cta_url_override = (string) ( $okp_home_opts['team_cta_url'] ?? '' );

$team_people = array(
	array(
		'name'      => (string) ( $okp_home_opts['team_person_1_name'] ?? __( 'Coach One', 'okperformance' ) ),
		'role'      => (string) ( $okp_home_opts['team_person_1_role'] ?? __( 'Performance coach', 'okperformance' ) ),
		'focus'     => (string) ( $okp_home_opts['team_person_1_focus'] ?? __( 'Training systems', 'okperformance' ) ),
		'bio'       => (string) ( $okp_home_opts['team_person_1_bio'] ?? '' ),
		'image_id'  => absint( $okp_home_opts['team_person_1_image_id'] ?? 0 ),
		'image_alt' => (string) ( $okp_home_opts['team_person_1_image_alt'] ?? __( 'Portrait of the first coach', 'okperformance' ) ),
	),
	array(
		'name'      => (string) ( $okp_home_opts['team_person_2_name'] ?? __( 'Coach Two', 'okperformance' ) ),
		'role'      => (string) ( $okp_home_opts['team_person_2_role'] ?? __( 'Nutrition & performance coach', 'okperformance' ) ),
		'focus'     => (string) ( $okp_home_opts['team_person_2_focus'] ?? __( 'Nutrition strategy', 'okperformance' ) ),
		'bio'       => (string) ( $okp_home_opts['team_person_2_bio'] ?? '' ),
		'image_id'  => absint( $okp_home_opts['team_person_2_image_id'] ?? 0 ),
		'image_alt' => (string) ( $okp_home_opts['team_person_2_image_alt'] ?? __( 'Portrait of the second coach', 'okperformance' ) ),
	),
);

$about_pages = get_pages(
	array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'page-templates/about-us.php',
		'number'     => 1,
	)
);
$about_url = ! empty( $about_pages ) ? get_permalink( $about_pages[0] ) : '';
$about_link_url = '' !== $about_link_url_override ? $about_link_url_override : $about_url;
$team_cta_url = '' !== $team_cta_url_override ? $team_cta_url_override : $about_url;

$products_title         = (string) ( $okp_home_opts['products_title'] ?? 'Popular products' );
$products_lede          = (string) ( $okp_home_opts['products_lede'] ?? 'Use your WooCommerce products here - edit product IDs and text from the admin menu.' );
$products_hint          = (string) ( $okp_home_opts['products_hint'] ?? 'Use arrow buttons or scroll' );
$products_view_label    = (string) ( $okp_home_opts['products_view_label'] ?? 'View' );
$products_cart_label    = (string) ( $okp_home_opts['products_add_to_cart_label'] ?? __( 'Lisa ostukorvi', 'okperformance' ) );
$products_empty_text    = (string) ( $okp_home_opts['products_empty_text'] ?? 'No products are available for the homepage slider yet. Publish WooCommerce products and they will appear here automatically.' );
$products_fallback_text = (string) ( $okp_home_opts['products_fallback_text'] ?? 'A premium performance product built for your training routine.' );
$products_type_default  = (string) ( $okp_home_opts['products_type_default'] ?? 'Performance plan' );
$products_type_athlete  = (string) ( $okp_home_opts['products_type_athlete'] ?? 'Athlete package' );
$products_type_gym      = (string) ( $okp_home_opts['products_type_gym'] ?? 'Gym program' );
$shop_url       = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/shop/' );

if ( ! $shop_url ) {
	$shop_url = '#okp-products';
}
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-home">
	<section class="okp-hero" aria-label="<?php esc_attr_e( 'Hero', 'okperformance' ); ?>">
		<div class="okp-hero__ambient" aria-hidden="true"></div>
		<div class="okp-hero__noise" aria-hidden="true"></div>
		<div class="okp-hero__wrap">
			<div class="okp-hero__layout">
				<div class="okp-hero__copy">
					<?php if ( '' !== $hero_eyebrow ) : ?>
						<div class="okp-pill"><?php echo esc_html( $hero_eyebrow ); ?></div>
					<?php endif; ?>

					<h1 class="okp-hero__title"><?php echo esc_html( $hero_title ); ?></h1>

					<?php if ( '' !== $hero_subtitle ) : ?>
						<p class="okp-hero__subtitle"><?php echo wp_kses_post( $hero_subtitle ); ?></p>
					<?php endif; ?>

					<div class="okp-hero__actions">
						<a class="okp-btn okp-btn--primary" href="<?php echo esc_url( $shop_url ); ?>">
							<?php echo esc_html( $hero_primary_cta_label ); ?>
						</a>
						<a class="okp-btn" href="#okp-products">
							<?php echo esc_html( $hero_secondary_cta_label ); ?>
						</a>
					</div>
				</div>

				<div class="okp-hero__showcase" aria-label="<?php esc_attr_e( 'Hero preview animation', 'okperformance' ); ?>">
					<div class="okp-hero__media">
						<iframe
							class="okp-hero__window-embed"
							src="<?php echo esc_url( get_template_directory_uri() . '/assets/hero-orbit-white.html' ); ?>"
							title="<?php esc_attr_e( 'Orbiting hero animation', 'okperformance' ); ?>"
							loading="lazy"
							scrolling="no"
						></iframe>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="okp-section okp-about" aria-label="<?php esc_attr_e( 'About', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-about__ghost" aria-hidden="true"><?php echo esc_html( $about_eyebrow ); ?></div>
			<div class="okp-about__layout">
				<div class="okp-about__content">
					<?php if ( '' !== $about_eyebrow ) : ?>
						<div class="okp-about__eyebrow"><?php echo esc_html( $about_eyebrow ); ?></div>
					<?php endif; ?>

					<h2 class="okp-section__title"><?php echo esc_html( $about_title ); ?></h2>
					<p class="okp-section__lede"><?php echo wp_kses_post( $about_text ); ?></p>

					<?php if ( $about_link_url && '' !== $about_link_label ) : ?>
						<a class="okp-text-arrow-link" href="<?php echo esc_url( $about_link_url ); ?>">
							<span><?php echo esc_html( $about_link_label ); ?></span>
							<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
								<path d="M5 12h14"></path>
								<path d="m13 6 6 6-6 6"></path>
							</svg>
						</a>
					<?php endif; ?>

					<div class="okp-about__chips" aria-label="<?php esc_attr_e( 'Key focus areas', 'okperformance' ); ?>">
						<?php foreach ( $about_cards as $index => $about_card ) : ?>
							<div class="okp-about__chip">
								<span class="okp-about__chip-index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
								<span><?php echo esc_html( $about_card['title'] ); ?></span>
							</div>
						<?php endforeach; ?>
					</div>

					<div class="okp-about-slider" data-okp-about-slider>
						<div class="okp-about-slider__controls">
							<div class="okp-products-slider__actions">
								<button class="okp-products-slider__nav okp-about-slider__nav--prev" type="button" aria-label="<?php esc_attr_e( 'Previous about card', 'okperformance' ); ?>">
									<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</button>

								<button class="okp-products-slider__nav okp-about-slider__nav--next" type="button" aria-label="<?php esc_attr_e( 'Next about card', 'okperformance' ); ?>">
									<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
										<path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</button>
							</div>
						</div>

						<div class="okp-about-slider__viewport" tabindex="0" aria-label="<?php esc_attr_e( 'About cards slider', 'okperformance' ); ?>">
							<div class="okp-about-slider__track">
								<?php foreach ( $about_cards as $index => $about_card ) : ?>
									<article class="okp-about-card-mobile">
										<div class="okp-about-card-mobile__number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></div>
										<div class="okp-about-card-mobile__body">
											<h3 class="okp-about-card-mobile__title"><?php echo esc_html( $about_card['title'] ); ?></h3>
											<p class="okp-about-card-mobile__text"><?php echo wp_kses_post( $about_card['text'] ); ?></p>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="okp-about__visual" aria-label="<?php esc_attr_e( 'Company benefits', 'okperformance' ); ?>">
					<div class="okp-about__visual-grid" aria-hidden="true"></div>
					<div class="okp-about__visual-orb" aria-hidden="true"></div>
					<div class="okp-about__beam" aria-hidden="true"></div>
					<div class="okp-about__beam okp-about__beam--small" aria-hidden="true"></div>

					<article class="okp-about__anchor">
						<?php if ( '' !== $about_panel_label ) : ?>
							<div class="okp-about__anchor-label"><?php echo esc_html( $about_panel_label ); ?></div>
						<?php endif; ?>

						<h3 class="okp-about__anchor-title"><?php echo esc_html( $about_panel_title ); ?></h3>
						<p class="okp-about__anchor-text"><?php echo wp_kses_post( $about_panel_text ); ?></p>
					</article>

					<?php foreach ( $about_cards as $index => $about_card ) : ?>
						<article class="okp-about-card-orbit okp-about-card-orbit--<?php echo esc_attr( (string) ( $index + 1 ) ); ?>">
							<div class="okp-about-card-orbit__number"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></div>
							<div class="okp-about-card-orbit__body">
								<h3 class="okp-about-card-orbit__title"><?php echo esc_html( $about_card['title'] ); ?></h3>
								<p class="okp-about-card-orbit__text"><?php echo wp_kses_post( $about_card['text'] ); ?></p>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>

	<section class="okp-section okp-services" aria-label="<?php esc_attr_e( 'Services', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-section__header">
				<div>
					<h2 class="okp-section__title"><?php echo esc_html( $services_title ); ?></h2>
					<p class="okp-section__lede okp-section__lede--small"><?php echo esc_html( $services_lede ); ?></p>
				</div>

				<?php if ( $services_url && '' !== $services_link_label ) : ?>
					<a class="okp-text-arrow-link okp-text-arrow-link--header" href="<?php echo esc_url( $services_url ); ?>">
						<span><?php echo esc_html( $services_link_label ); ?></span>
						<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M5 12h14"></path>
							<path d="m13 6 6 6-6 6"></path>
						</svg>
					</a>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $services ) ) : ?>
				<?php
				$service_items = array();
				$service_icon_paths = array(
					'<path d="M4 13.5h3l2-5 3 9 2.5-6H20"></path><path d="M4 19h16"></path>',
					'<path d="M7 8v8"></path><path d="M17 8v8"></path><path d="M4 10v4"></path><path d="M20 10v4"></path><path d="M7 12h10"></path>',
					'<path d="M13 3 5 14h6l-1 7 8-11h-6l1-7z"></path>',
					'<circle cx="12" cy="12" r="7"></circle><path d="m14.5 9.5-1.5 4-4 1.5 1.5-4 4-1.5z"></path>',
				);

				foreach ( $services as $service ) {
					$service_title        = get_the_title( $service );
					$service_excerpt      = has_excerpt( $service ) ? $service->post_excerpt : $service->post_content;
					$service_excerpt      = wp_trim_words( wp_strip_all_tags( (string) $service_excerpt ), 28 );
					$service_panel_text   = function_exists( 'okperformance_get_service_home_panel_text' )
						? okperformance_get_service_home_panel_text( $service )
						: (string) get_post_meta( $service->ID, '_okp_service_home_panel_text', true );
					$service_feature_text = function_exists( 'okperformance_get_service_home_feature_text' )
						? okperformance_get_service_home_feature_text( $service )
						: (string) get_post_meta( $service->ID, '_okp_service_home_feature_text', true );

					if ( '' === $service_feature_text ) {
						$service_feature_text = $service_excerpt;
					}

					if ( '' === $service_feature_text ) {
						$service_feature_text = $services_fallback_text;
					}

					$service_items[] = array(
						'id'           => (int) $service->ID,
						'title'        => $service_title,
						'feature_text' => $service_feature_text,
						'panel_text'   => $service_panel_text,
						'permalink'    => get_permalink( $service ),
						'image'        => get_the_post_thumbnail(
							$service,
							'large',
							array(
								'loading' => 'lazy',
								'alt'     => $service_title,
							)
						),
					);
				}
				?>

				<div class="okp-services-showcase" data-okp-services-switcher>
					<div class="okp-services-showcase__stage">
						<?php foreach ( $service_items as $index => $service_item ) : ?>
							<?php
							$service_panel_id = 'okp-service-panel-' . $service_item['id'];
							$service_tab_id   = 'okp-service-tab-' . $service_item['id'];
							$service_number   = sprintf( '%02d', $index + 1 );
							?>
							<article
								class="okp-service-feature<?php echo 0 === $index ? ' is-active' : ''; ?>"
								id="<?php echo esc_attr( $service_panel_id ); ?>"
								role="tabpanel"
								aria-labelledby="<?php echo esc_attr( $service_tab_id ); ?>"
								aria-hidden="<?php echo esc_attr( 0 === $index ? 'false' : 'true' ); ?>"
								data-okp-service-panel="<?php echo esc_attr( (string) $index ); ?>"
							>
								<div class="okp-service-feature__media">
									<?php if ( $service_item['image'] ) : ?>
										<?php echo $service_item['image']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									<?php else : ?>
										<div class="okp-service-feature__placeholder" aria-hidden="true">
											<span><?php echo esc_html( $service_number ); ?></span>
										</div>
									<?php endif; ?>
								</div>

								<div class="okp-service-feature__body">
									<h3 class="okp-service-feature__title"><?php echo esc_html( $service_item['title'] ); ?></h3>
									<p class="okp-service-feature__text"><?php echo nl2br( esc_html( $service_item['feature_text'] ) ); ?></p>

									<a class="okp-service-card__link okp-service-feature__link" href="<?php echo esc_url( $service_item['permalink'] ); ?>">
										<?php echo esc_html( $services_card_link_label ); ?>
									</a>
								</div>
							</article>
						<?php endforeach; ?>
					</div>

					<div class="okp-services-menu" role="tablist" aria-label="<?php esc_attr_e( 'Choose a service', 'okperformance' ); ?>">
						<?php foreach ( $service_items as $index => $service_item ) : ?>
							<?php
							$service_panel_id = 'okp-service-panel-' . $service_item['id'];
							$service_tab_id   = 'okp-service-tab-' . $service_item['id'];
							$service_icon     = $service_icon_paths[ $index % count( $service_icon_paths ) ];
							?>
							<button
								class="okp-services-menu__item<?php echo 0 === $index ? ' is-active' : ''; ?>"
								id="<?php echo esc_attr( $service_tab_id ); ?>"
								type="button"
								role="tab"
								aria-selected="<?php echo esc_attr( 0 === $index ? 'true' : 'false' ); ?>"
								aria-controls="<?php echo esc_attr( $service_panel_id ); ?>"
								tabindex="<?php echo esc_attr( 0 === $index ? '0' : '-1' ); ?>"
								data-okp-service-tab="<?php echo esc_attr( (string) $index ); ?>"
							>
								<span class="okp-services-menu__icon" aria-hidden="true">
									<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" focusable="false">
										<?php echo $service_icon; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</svg>
								</span>

								<span class="okp-services-menu__content">
									<?php if ( '' !== $service_item['panel_text'] ) : ?>
										<span class="okp-services-menu__eyebrow"><?php echo esc_html( $service_item['panel_text'] ); ?></span>
									<?php endif; ?>
									<span class="okp-services-menu__title"><?php echo esc_html( $service_item['title'] ); ?></span>
								</span>

								<span class="okp-services-menu__arrow" aria-hidden="true">
									<svg viewBox="0 0 24 24" focusable="false">
										<path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.1" stroke-linecap="round" stroke-linejoin="round"/>
									</svg>
								</span>
							</button>
						<?php endforeach; ?>
					</div>
				</div>
			<?php else : ?>
				<div class="okp-products-empty">
					<p><?php echo esc_html( $services_empty_text ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="okp-section okp-products" id="okp-products" aria-label="<?php esc_attr_e( 'Products', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-section__header">
				<div>
					<h2 class="okp-section__title"><?php echo esc_html( $products_title ); ?></h2>
					<p class="okp-section__lede okp-section__lede--small"><?php echo wp_kses_post( $products_lede ); ?></p>
				</div>

				<?php if ( ! empty( $products ) ) : ?>
					<div class="okp-products-slider__controls">
						<div class="okp-products-slider__hint" aria-hidden="true">
							<?php echo esc_html( $products_hint ); ?>
						</div>

						<div class="okp-products-slider__actions">
							<button class="okp-products-slider__nav okp-products-slider__nav--prev" type="button" aria-label="<?php esc_attr_e( 'Previous products', 'okperformance' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path d="M15 18l-6-6 6-6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>

							<button class="okp-products-slider__nav okp-products-slider__nav--next" type="button" aria-label="<?php esc_attr_e( 'Next products', 'okperformance' ); ?>">
								<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path d="M9 6l6 6-6 6" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/>
								</svg>
							</button>
						</div>
					</div>
				<?php endif; ?>
			</div>

			<?php if ( ! empty( $products ) ) : ?>
				<div class="okp-products-slider" data-okp-products-slider>
					<div class="okp-products-slider__viewport" tabindex="0" aria-label="<?php esc_attr_e( 'Product slider', 'okperformance' ); ?>">
						<div class="okp-products-slider__track">
							<?php foreach ( $products as $product ) : ?>
								<?php
								$image_html = $product->get_image(
									'medium',
									array(
										'alt'     => $product->get_name(),
										'loading' => 'lazy',
									)
								);

								$short_desc = (string) $product->get_short_description();

								if ( '' === $short_desc ) {
									$short_desc = (string) $product->get_description();
								}

								$short_desc = wp_trim_words( wp_strip_all_tags( $short_desc ), 18 );

								if ( '' === $short_desc ) {
									$short_desc = $products_fallback_text;
								}

								$product_context = strtolower( $product->get_name() . ' ' . $short_desc );
								$product_type    = $products_type_default;

								if ( false !== strpos( $product_context, 'athlete' ) || false !== strpos( $product_context, 'package' ) || false !== strpos( $product_context, 'nutrition' ) || false !== strpos( $product_context, 'measure' ) ) {
									$product_type = $products_type_athlete;
								} elseif ( false !== strpos( $product_context, 'gym' ) || false !== strpos( $product_context, 'program' ) || false !== strpos( $product_context, 'workout' ) || false !== strpos( $product_context, 'training' ) ) {
									$product_type = $products_type_gym;
								}

								$cart_classes = array(
									'okp-product-card__link',
									'okp-product-card__cart',
									sanitize_html_class( 'product_type_' . $product->get_type() ),
								);

								if ( $product->is_purchasable() && $product->is_in_stock() ) {
									$cart_classes[] = 'add_to_cart_button';

									if ( $product->supports( 'ajax_add_to_cart' ) ) {
										$cart_classes[] = 'ajax_add_to_cart';
									}
								}
								?>
								<article class="okp-product-card" aria-label="<?php echo esc_attr( $product->get_name() ); ?>">
									<?php if ( ! empty( $image_html ) ) : ?>
										<div class="okp-product-card__image"><?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
									<?php else : ?>
										<div class="okp-product-card__image okp-product-card__image--placeholder" aria-hidden="true">
											<div class="okp-product-card__placeholder-badge"><?php echo esc_html( $product_type ); ?></div>
											<svg viewBox="0 0 160 110" focusable="false">
												<rect x="24" y="24" width="112" height="62" rx="18"></rect>
												<path d="M45 59h70"></path>
												<path d="M56 47v24"></path>
												<path d="M104 47v24"></path>
											</svg>
										</div>
									<?php endif; ?>

									<div class="okp-product-card__eyebrow-row">
										<div class="okp-product-card__eyebrow"><?php echo esc_html( $product_type ); ?></div>
										<div class="okp-product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
									</div>

									<h3 class="okp-product-card__title"><?php echo esc_html( $product->get_name() ); ?></h3>
									<p class="okp-product-card__desc"><?php echo esc_html( $short_desc ); ?></p>

									<div class="okp-product-card__meta">
										<a class="okp-product-card__link" href="<?php echo esc_url( $product->get_permalink() ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View product: %s', 'okperformance' ), $product->get_name() ) ); ?>"><?php echo esc_html( $products_view_label ); ?></a>

										<?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
											<a
												class="<?php echo esc_attr( implode( ' ', array_filter( $cart_classes ) ) ); ?>"
												href="<?php echo esc_url( $product->add_to_cart_url() ); ?>"
												data-quantity="1"
												data-product_id="<?php echo esc_attr( (string) $product->get_id() ); ?>"
												data-product_sku="<?php echo esc_attr( (string) $product->get_sku() ); ?>"
												aria-label="<?php echo esc_attr( sprintf( __( 'Add to cart: %s', 'okperformance' ), $product->get_name() ) ); ?>"
												rel="nofollow"
											>
												<?php echo esc_html( $products_cart_label ); ?>
											</a>
										<?php endif; ?>
									</div>
								</article>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			<?php else : ?>
				<div class="okp-products-empty">
					<p><?php echo esc_html( $products_empty_text ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<section class="okp-section okp-about-team" aria-label="<?php esc_attr_e( 'About us', 'okperformance' ); ?>">
			<div class="okp-home__shell">
				<div class="okp-section__header">
					<div>
						<h2 class="okp-section__title"><?php echo esc_html( $team_title ); ?></h2>
						<?php if ( '' !== $team_lede ) : ?>
							<p class="okp-section__lede okp-section__lede--small"><?php echo esc_html( $team_lede ); ?></p>
						<?php endif; ?>
					</div>

					<?php if ( $team_cta_url && '' !== $team_cta_label ) : ?>
						<a class="okp-text-arrow-link okp-text-arrow-link--header" href="<?php echo esc_url( $team_cta_url ); ?>">
							<span><?php echo esc_html( $team_cta_label ); ?></span>
							<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
								<path d="M5 12h14"></path>
								<path d="m13 6 6 6-6 6"></path>
							</svg>
						</a>
					<?php endif; ?>
				</div>

				<div class="okp-about-page__team-grid okp-about-team__grid">
					<?php foreach ( $team_people as $person ) : ?>
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
						$person_bio = wp_trim_words( wp_strip_all_tags( (string) $person['bio'] ), 32 );
						?>
						<article class="okp-about-page__person-card">
							<div class="okp-about-page__person-content">
								<div class="okp-about-page__person-head">
									<div class="okp-about-page__person-media">
										<?php if ( $person_image ) : ?>
											<?php echo $person_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
										<?php else : ?>
											<div class="okp-about-page__person-placeholder" aria-hidden="true">
												<span><?php echo esc_html( mb_strtoupper( mb_substr( $person['name'], 0, 1 ) ) ); ?></span>
											</div>
										<?php endif; ?>
									</div>

									<div class="okp-about-page__person-intro">
										<?php if ( '' !== $person['focus'] ) : ?>
											<div class="okp-about-page__person-focus"><?php echo esc_html( $person['focus'] ); ?></div>
										<?php endif; ?>

										<h3 class="okp-about-page__person-name"><?php echo esc_html( $person['name'] ); ?></h3>

										<?php if ( '' !== $person['role'] ) : ?>
											<p class="okp-about-page__person-role"><?php echo esc_html( $person['role'] ); ?></p>
										<?php endif; ?>
									</div>
								</div>

								<?php if ( '' !== $person_bio ) : ?>
									<p class="okp-about-page__person-bio"><?php echo esc_html( $person_bio ); ?></p>
								<?php endif; ?>
							</div>
						</article>
					<?php endforeach; ?>
				</div>
			</div>
		</section>

		<?php
		get_template_part(
			'template-parts/faq-section',
			null,
			array(
				'context' => 'home',
				'options' => $okp_home_opts,
			)
		);
		?>
	</main>
