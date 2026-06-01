<?php
/**
 * Product archive template.
 *
 * Custom WooCommerce archive for OKPerformance gym programs. Keeps the native
 * WooCommerce product query, ordering, result count, notices, and pagination,
 * while rendering products with the theme's dark/purple card language.
 *
 * @package OKPerformance
 */

defined( 'ABSPATH' ) || exit;

get_header();

$okp_page_opts = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();
$shop_page_id = wc_get_page_id( 'shop' );
$shop_title   = woocommerce_page_title( false );
$shop_intro   = '';
$shop_pill    = trim(
	(string) (
		$okp_page_opts['shop_archive_pill_label']
		?? get_theme_mod( 'okperformance_shop_archive_pill_label', __( 'Gym programs', 'okperformance' ) )
	)
);
$shop_image_url = '';
$shop_image_id  = absint( $okp_page_opts['shop_archive_image_id'] ?? 0 );
$shop_image_alt = (string) ( $okp_page_opts['shop_archive_image_alt'] ?? '' );

if ( is_product_taxonomy() ) {
	$term = get_queried_object();

	if ( $term instanceof WP_Term ) {
		$shop_intro = trim( (string) term_description( $term->term_id, $term->taxonomy ) );
	}
} else {
	$shop_title = (string) ( $okp_page_opts['shop_archive_title'] ?? $shop_title );
	$shop_intro = trim( (string) ( $okp_page_opts['shop_archive_lede'] ?? '' ) );
}

if ( '' === $shop_intro && ! is_product_taxonomy() ) {
	$shop_intro = (string) ( $okp_page_opts['shop_archive_lede'] ?? '' );
}

if ( '' === $shop_intro ) {
	$shop_intro = '<p>' . esc_html__( 'Training programs built for structure, consistency, and measurable progress. Choose the plan that fits your current goal and start building better training habits.', 'okperformance' ) . '</p>';
}

if ( $shop_image_id > 0 ) {
	$attachment_url = wp_get_attachment_image_url( $shop_image_id, 'full' );
	$attachment_alt = get_post_meta( $shop_image_id, '_wp_attachment_image_alt', true );

	if ( is_string( $attachment_url ) && '' !== $attachment_url ) {
		$shop_image_url = $attachment_url;
	}

	if ( '' === trim( $shop_image_alt ) && is_string( $attachment_alt ) && '' !== trim( $attachment_alt ) ) {
		$shop_image_alt = $attachment_alt;
	}
}

if ( '' === $shop_image_url ) {
	$shop_image_url = trim( (string) ( $okp_page_opts['shop_archive_image_url'] ?? '' ) );
}

if ( '' === $shop_image_url && $shop_page_id && $shop_page_id > 0 && has_post_thumbnail( $shop_page_id ) ) {
	$thumbnail_url = wp_get_attachment_image_url( get_post_thumbnail_id( $shop_page_id ), 'full' );
	$thumbnail_alt = get_post_meta( get_post_thumbnail_id( $shop_page_id ), '_wp_attachment_image_alt', true );

	if ( is_string( $thumbnail_url ) && '' !== $thumbnail_url ) {
		$shop_image_url = $thumbnail_url;
	}

	if ( is_string( $thumbnail_alt ) && '' !== trim( $thumbnail_alt ) ) {
		$shop_image_alt = $thumbnail_alt;
	}
}

if ( '' === trim( $shop_image_alt ) ) {
	$shop_image_alt = __( 'Shop hero image', 'okperformance' );
}

$shop_hero_class = 'okp-shop-hero';

if ( '' !== $shop_image_url ) {
	$shop_hero_class .= ' okp-shop-hero--has-media';
}
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-shop-archive">
		<section class="<?php echo esc_attr( $shop_hero_class ); ?>" aria-label="<?php esc_attr_e( 'Shop introduction', 'okperformance' ); ?>">
			<div class="okp-home__shell">
				<div class="okp-shop-hero__layout">
					<div class="okp-shop-hero__content">
						<?php if ( '' !== $shop_pill ) : ?>
							<div class="okp-pill"><?php echo esc_html( $shop_pill ); ?></div>
						<?php endif; ?>
						<h1 class="okp-shop-hero__title"><?php echo esc_html( $shop_title ); ?></h1>
						<div class="okp-shop-hero__lede"><?php echo wp_kses_post( $shop_intro ); ?></div>
					</div>

					<?php if ( '' !== $shop_image_url ) : ?>
						<div class="okp-shop-hero__media">
							<div class="okp-shop-hero__media-frame">
								<img class="okp-shop-hero__image" src="<?php echo esc_url( $shop_image_url ); ?>" alt="<?php echo esc_attr( $shop_image_alt ); ?>" loading="eager" decoding="async" />
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</section>

	<section class="okp-section okp-shop-products" aria-label="<?php esc_attr_e( 'Available products', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<?php
			if ( function_exists( 'wc_print_notices' ) ) {
				wc_print_notices();
			}
			?>

			<?php if ( woocommerce_product_loop() ) : ?>
				<div class="okp-shop-toolbar">
					<div class="okp-shop-toolbar__count">
						<?php woocommerce_result_count(); ?>
					</div>

					<div class="okp-shop-toolbar__ordering">
						<?php woocommerce_catalog_ordering(); ?>
					</div>
				</div>

				<div class="okp-shop-grid">
					<?php
					while ( have_posts() ) :
						the_post();

						$product = wc_get_product( get_the_ID() );

						if ( ! $product ) {
							continue;
						}

						$product_name = $product->get_name();
						$product_url  = get_permalink( $product->get_id() );
						$image_html   = $product->get_image(
							'medium_large',
							array(
								'alt'     => $product_name,
								'loading' => 'lazy',
							)
						);

						$short_desc = (string) $product->get_short_description();

						if ( '' === $short_desc ) {
							$short_desc = (string) $product->get_description();
						}

						$short_desc = wp_trim_words( wp_strip_all_tags( $short_desc ), 22 );

						if ( '' === $short_desc ) {
							$short_desc = __( 'A structured gym program designed to help you train with clarity, progression, and confidence.', 'okperformance' );
						}

						$product_terms = wp_get_post_terms( $product->get_id(), 'product_cat', array( 'fields' => 'names' ) );
						$product_type  = ! is_wp_error( $product_terms ) && ! empty( $product_terms )
							? (string) $product_terms[0]
							: __( 'Training program', 'okperformance' );
						?>

						<article <?php wc_product_class( 'okp-shop-card', $product ); ?>>
							<a class="okp-shop-card__image" href="<?php echo esc_url( $product_url ); ?>" aria-label="<?php echo esc_attr( sprintf( __( 'View product: %s', 'okperformance' ), $product_name ) ); ?>">
								<?php if ( $image_html ) : ?>
									<?php echo $image_html; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php else : ?>
									<span class="okp-shop-card__placeholder" aria-hidden="true">
										<span><?php echo esc_html( mb_strtoupper( mb_substr( $product_name, 0, 1 ) ) ); ?></span>
									</span>
								<?php endif; ?>
							</a>

							<div class="okp-shop-card__content">
								<div class="okp-shop-card__meta-row">
									<span class="okp-shop-card__type"><?php echo esc_html( $product_type ); ?></span>
									<span class="okp-shop-card__price">
										<?php
										echo wp_kses_post(
											function_exists( 'okperformance_woocommerce_get_archive_price_html' )
												? okperformance_woocommerce_get_archive_price_html( $product )
												: $product->get_price_html()
										);
										?>
									</span>
								</div>

								<h2 class="okp-shop-card__title">
									<a href="<?php echo esc_url( $product_url ); ?>"><?php echo esc_html( $product_name ); ?></a>
								</h2>

								<p class="okp-shop-card__text"><?php echo esc_html( $short_desc ); ?></p>

								<div class="okp-shop-card__actions">
									<a class="okp-shop-card__link" href="<?php echo esc_url( $product_url ); ?>">
										<?php esc_html_e( 'View program', 'okperformance' ); ?>
									</a>

									<?php if ( $product->is_purchasable() && $product->is_in_stock() ) : ?>
										<?php
										woocommerce_template_loop_add_to_cart(
											array(
												'class' => 'okp-shop-card__cart',
											)
										);
										?>
									<?php endif; ?>
								</div>
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
					<nav class="okp-archive-pagination" aria-label="<?php esc_attr_e( 'Products pagination', 'okperformance' ); ?>">
						<?php foreach ( $pagination_links as $pagination_link ) : ?>
							<span class="okp-archive-pagination__item"><?php echo wp_kses_post( $pagination_link ); ?></span>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>
			<?php else : ?>
				<div class="okp-products-empty">
					<p><?php esc_html_e( 'No programs are available yet. Check back soon for new training plans.', 'okperformance' ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
