<?php
/**
 * Single product template.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package OKPerformance
 * @version 1.6.4
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main id="primary" class="site-main okp-single-product okp-single-product--classic">
	<?php
	while ( have_posts() ) :
		the_post();

		global $product;

		$product = wc_get_product( get_the_ID() );

		if ( ! $product instanceof WC_Product ) {
			continue;
		}

		$product_id    = $product->get_id();
		$product_terms = wp_get_post_terms( $product_id, 'product_cat', array( 'fields' => 'names' ) );
		$product_type  = ! is_wp_error( $product_terms ) && ! empty( $product_terms )
			? (string) $product_terms[0]
			: __( 'Product', 'okperformance' );
		?>

		<div class="okp-home__shell okp-single-product__notices">
			<?php do_action( 'woocommerce_before_single_product' ); ?>
		</div>

		<?php if ( post_password_required() ) : ?>
			<div class="okp-home__shell">
				<?php echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
			</div>
			<?php continue; ?>
		<?php endif; ?>

		<article <?php wc_product_class( 'okp-single-product__product', $product_id ); ?>>
			<section class="okp-single-product__classic-section" aria-label="<?php esc_attr_e( 'Product details', 'okperformance' ); ?>">
				<div class="okp-home__shell">
					<div class="okp-single-product__classic-grid">
						<div class="okp-single-product__classic-gallery">
							<?php
							/**
							 * Hook: woocommerce_before_single_product_summary.
							 *
							 * @hooked woocommerce_show_product_sale_flash - 10
							 * @hooked woocommerce_show_product_images - 20
							 */
							do_action( 'woocommerce_before_single_product_summary' );
							?>
						</div>

						<div class="okp-single-product__classic-summary summary entry-summary">
							<span class="okp-single-product__category"><?php echo esc_html( $product_type ); ?></span>

							<?php
							/**
							 * Hook: woocommerce_single_product_summary.
							 *
							 * @hooked woocommerce_template_single_title - 5
							 * @hooked woocommerce_template_single_rating - 10
							 * @hooked woocommerce_template_single_price - 10
							 * @hooked woocommerce_template_single_excerpt - 20
							 * @hooked woocommerce_template_single_add_to_cart - 30
							 * @hooked woocommerce_template_single_meta - 40
							 * @hooked woocommerce_template_single_sharing - 50
							 * @hooked WC_Structured_Data::generate_product_data() - 60
							 */
							do_action( 'woocommerce_single_product_summary' );
							?>
						</div>
					</div>
				</div>
			</section>

			<section class="okp-single-product__tabs-wrap" aria-label="<?php esc_attr_e( 'Product information', 'okperformance' ); ?>">
				<div class="okp-home__shell">
					<?php woocommerce_output_product_data_tabs(); ?>
				</div>
			</section>

			<section class="okp-single-product__below" aria-label="<?php esc_attr_e( 'More products', 'okperformance' ); ?>">
				<div class="okp-home__shell">
					<?php
					woocommerce_upsell_display();
					woocommerce_output_related_products();
					?>
				</div>
			</section>
		</article>

		<?php do_action( 'woocommerce_after_single_product' ); ?>
	<?php endwhile; ?>
</main>

<?php
get_footer();
