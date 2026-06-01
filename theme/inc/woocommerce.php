<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package OKPerformance
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function okperformance_woocommerce_setup() {
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 420,
			'single_image_width'    => 720,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 4,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'okperformance_woocommerce_setup' );

/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function okperformance_woocommerce_scripts() {
	$mini_cart_js_path = get_template_directory() . '/js/mini-cart.js';
	$mini_cart_version = file_exists( $mini_cart_js_path ) ? (string) filemtime( $mini_cart_js_path ) : _S_VERSION;

	wp_enqueue_style( 'okperformance-woocommerce-style', get_template_directory_uri() . '/woocommerce.css', array(), _S_VERSION );
	wp_enqueue_script( 'okperformance-mini-cart', get_template_directory_uri() . '/js/mini-cart.js', array( 'jquery', 'wc-cart-fragments' ), $mini_cart_version, true );
	wp_localize_script(
		'okperformance-mini-cart',
		'okpMiniCart',
		array(
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => wp_create_nonce( 'okp-mini-cart' ),
		)
	);

	if ( is_product() ) {
		$product_quantity_js_path = get_template_directory() . '/js/product-quantity.js';
		$product_quantity_version = file_exists( $product_quantity_js_path ) ? (string) filemtime( $product_quantity_js_path ) : _S_VERSION;

		wp_enqueue_script( 'okperformance-product-quantity', get_template_directory_uri() . '/js/product-quantity.js', array(), $product_quantity_version, true );
	}

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'okperformance-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'okperformance_woocommerce_scripts' );

/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

if ( ! function_exists( 'okperformance_woocommerce_single_product_loop_thumbnail_size' ) ) {
	/**
	 * Use a sharper image source for product cards rendered below single products.
	 *
	 * @param string $size Product thumbnail image size.
	 * @return string
	 */
	function okperformance_woocommerce_single_product_loop_thumbnail_size( $size ) {
		if ( is_product() ) {
			return 'woocommerce_single';
		}

		return $size;
	}
}
add_filter( 'single_product_archive_thumbnail_size', 'okperformance_woocommerce_single_product_loop_thumbnail_size' );

if ( ! function_exists( 'okperformance_woocommerce_quantity_stepper_button' ) ) {
	/**
	 * Render a single product quantity stepper button.
	 *
	 * @param string $direction Increase or decrease direction.
	 * @return void
	 */
	function okperformance_woocommerce_quantity_stepper_button( $direction ) {
		if ( ! is_product() ) {
			return;
		}

		global $product;

		if ( $product instanceof WC_Product ) {
			$min_quantity = $product->get_min_purchase_quantity();
			$max_quantity = $product->get_max_purchase_quantity();

			if ( 0 < $max_quantity && $min_quantity === $max_quantity ) {
				return;
			}
		}

		$is_increase = 'increase' === $direction;
		$label       = $is_increase ? __( 'Suurenda kogust', 'okperformance' ) : __( 'Vähenda kogust', 'okperformance' );
		$symbol      = $is_increase ? '+' : '-';
		$delta       = $is_increase ? '1' : '-1';
		$class       = $is_increase ? 'okp-quantity-stepper--plus' : 'okp-quantity-stepper--minus';
		?>
		<button
			type="button"
			class="okp-quantity-stepper <?php echo esc_attr( $class ); ?>"
			data-okp-quantity-change="<?php echo esc_attr( $delta ); ?>"
			aria-label="<?php echo esc_attr( $label ); ?>"
		>
			<span aria-hidden="true"><?php echo esc_html( $symbol ); ?></span>
		</button>
		<?php
	}
}

if ( ! function_exists( 'okperformance_woocommerce_quantity_stepper_minus' ) ) {
	/**
	 * Render the decrease quantity button.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_quantity_stepper_minus() {
		okperformance_woocommerce_quantity_stepper_button( 'decrease' );
	}
}
add_action( 'woocommerce_before_quantity_input_field', 'okperformance_woocommerce_quantity_stepper_minus' );

if ( ! function_exists( 'okperformance_woocommerce_quantity_stepper_plus' ) ) {
	/**
	 * Render the increase quantity button.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_quantity_stepper_plus() {
		okperformance_woocommerce_quantity_stepper_button( 'increase' );
	}
}
add_action( 'woocommerce_after_quantity_input_field', 'okperformance_woocommerce_quantity_stepper_plus' );

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function okperformance_woocommerce_active_body_class( $classes ) {
	$classes[] = 'woocommerce-active';

	return $classes;
}
add_filter( 'body_class', 'okperformance_woocommerce_active_body_class' );

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function okperformance_woocommerce_related_products_args( $args ) {
	$defaults = array(
		'posts_per_page' => 3,
		'columns'        => 3,
	);

	$args = wp_parse_args( $defaults, $args );

	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'okperformance_woocommerce_related_products_args' );

/**
 * Add product-level archive price suffix controls.
 *
 * Editors can enable this per product to display prices like "150/kuu" on the
 * product archive without changing the actual WooCommerce product price.
 *
 * @return void
 */
function okperformance_woocommerce_archive_price_fields() {
	woocommerce_wp_checkbox(
		array(
			'id'          => '_okp_archive_price_suffix_enabled',
			'label'       => __( 'Archive price suffix', 'okperformance' ),
			'description' => __( 'Show a custom suffix after this product price on the product archive.', 'okperformance' ),
		)
	);

	woocommerce_wp_text_input(
		array(
			'id'          => '_okp_archive_price_suffix',
			'label'       => __( 'Archive price suffix text', 'okperformance' ),
			'description' => __( 'Example: /kuu. Used only when the suffix checkbox is enabled.', 'okperformance' ),
			'desc_tip'    => true,
			'placeholder' => '/kuu',
			'type'        => 'text',
		)
	);
}
add_action( 'woocommerce_product_options_pricing', 'okperformance_woocommerce_archive_price_fields' );

/**
 * Save product-level archive price suffix controls.
 *
 * @param WC_Product $product Product object being saved.
 * @return void
 */
function okperformance_woocommerce_save_archive_price_fields( $product ) {
	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$suffix_enabled = isset( $_POST['_okp_archive_price_suffix_enabled'] ) ? 'yes' : 'no'; // phpcs:ignore WordPress.Security.NonceVerification.Missing
	$suffix         = isset( $_POST['_okp_archive_price_suffix'] )
		? sanitize_text_field( wp_unslash( $_POST['_okp_archive_price_suffix'] ) ) // phpcs:ignore WordPress.Security.NonceVerification.Missing
		: '';

	if ( '' === trim( $suffix ) ) {
		$suffix = '/kuu';
	}

	$product->update_meta_data( '_okp_archive_price_suffix_enabled', $suffix_enabled );
	$product->update_meta_data( '_okp_archive_price_suffix', $suffix );
}
add_action( 'woocommerce_admin_process_product_object', 'okperformance_woocommerce_save_archive_price_fields' );

/**
 * Get the formatted archive price for a product.
 *
 * @param WC_Product $product Product object.
 * @return string
 */
function okperformance_woocommerce_get_archive_price_html( $product ) {
	if ( ! $product instanceof WC_Product ) {
		return '';
	}

	$price_html = $product->get_price_html();

	if ( '' === $price_html ) {
		return '';
	}

	if ( 'yes' !== $product->get_meta( '_okp_archive_price_suffix_enabled', true ) ) {
		return $price_html;
	}

	$suffix = trim( (string) $product->get_meta( '_okp_archive_price_suffix', true ) );

	if ( '' === $suffix ) {
		$suffix = '/kuu';
	}

	return $price_html . '<span class="okp-shop-card__price-suffix">' . esc_html( $suffix ) . '</span>';
}

/**
 * Redirect after a non-AJAX archive add-to-cart so refresh does not add again.
 *
 * WooCommerce archive buttons use a GET URL like `?add-to-cart=123`. If the
 * browser stays on that URL, refreshing repeats the request and adds another
 * product. After WooCommerce successfully adds the item, redirect to the same
 * URL with add-to-cart parameters removed.
 *
 * @param string $url Default redirect URL.
 * @return string
 */
function okperformance_woocommerce_clean_add_to_cart_redirect( $url ) {
	if ( wp_doing_ajax() || empty( $_REQUEST['add-to-cart'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		return $url;
	}

	$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? (string) wp_unslash( $_SERVER['REQUEST_URI'] ) : '';

	if ( '' === $request_uri ) {
		return $url;
	}

	$redirect_url = home_url( $request_uri );
	$redirect_url = remove_query_arg(
		array(
			'add-to-cart',
			'quantity',
			'variation_id',
			'product_id',
		),
		$redirect_url
	);

	return wp_validate_redirect( $redirect_url, wc_get_page_permalink( 'shop' ) );
}
add_filter( 'woocommerce_add_to_cart_redirect', 'okperformance_woocommerce_clean_add_to_cart_redirect' );

/**
 * Remove default WooCommerce wrapper.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

if ( ! function_exists( 'okperformance_woocommerce_wrapper_before' ) ) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_wrapper_before() {
		?>
			<main id="primary" class="site-main">
		<?php
	}
}
add_action( 'woocommerce_before_main_content', 'okperformance_woocommerce_wrapper_before' );

if ( ! function_exists( 'okperformance_woocommerce_wrapper_after' ) ) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_wrapper_after() {
		?>
			</main><!-- #main -->
		<?php
	}
}
add_action( 'woocommerce_after_main_content', 'okperformance_woocommerce_wrapper_after' );

/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	<?php
		if ( function_exists( 'okperformance_woocommerce_header_cart' ) ) {
			okperformance_woocommerce_header_cart();
		}
	?>
 */

if ( ! function_exists( 'okperformance_woocommerce_cart_link_fragment' ) ) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
		function okperformance_woocommerce_cart_link_fragment( $fragments ) {
			ob_start();
			okperformance_woocommerce_cart_link();
			$fragments['a.cart-contents'] = ob_get_clean();

			ob_start();
			okperformance_woocommerce_render_mini_cart_inner();
			$fragments['.okp-mini-cart__inner'] = ob_get_clean();

			return $fragments;
		}
	}
add_filter( 'woocommerce_add_to_cart_fragments', 'okperformance_woocommerce_cart_link_fragment' );

if ( ! function_exists( 'okperformance_woocommerce_get_cart_fragments_payload' ) ) {
	/**
	 * Build the fragment payload used by the off-canvas cart UI.
	 *
	 * @return array<string, mixed>
	 */
	function okperformance_woocommerce_get_cart_fragments_payload() {
		$fragments = apply_filters( 'woocommerce_add_to_cart_fragments', array() );

		return array(
			'fragments' => $fragments,
			'cart_hash' => WC()->cart ? WC()->cart->get_cart_hash() : '',
		);
	}
}

if ( ! function_exists( 'okperformance_woocommerce_ajax_update_mini_cart_quantity' ) ) {
	/**
	 * Update a mini-cart line item quantity over AJAX.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_ajax_update_mini_cart_quantity() {
		check_ajax_referer( 'okp-mini-cart', 'nonce' );

		if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
			wp_send_json_error(
				array(
					'message' => __( 'Ostukorv ei ole hetkel saadaval.', 'okperformance' ),
				),
				400
			);
		}

		$cart_item_key = isset( $_POST['cart_item_key'] ) ? wc_clean( wp_unslash( $_POST['cart_item_key'] ) ) : '';
		$quantity      = isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : null;

		if ( '' === $cart_item_key || null === $quantity ) {
			wp_send_json_error(
				array(
					'message' => __( 'Ostukorvi toote andmed puuduvad.', 'okperformance' ),
				),
				400
			);
		}

		$cart = WC()->cart->get_cart();

		if ( ! isset( $cart[ $cart_item_key ] ) ) {
			wp_send_json_error(
				array(
					'message' => __( 'Seda ostukorvi toodet ei leitud.', 'okperformance' ),
				),
				404
			);
		}

		$updated = false;

		if ( $quantity <= 0 ) {
			$updated = WC()->cart->remove_cart_item( $cart_item_key );
		} else {
			$updated = WC()->cart->set_quantity( $cart_item_key, $quantity, true );
		}

		if ( false === $updated ) {
			wp_send_json_error(
				array(
					'message' => __( 'Ostukorvi kogust ei saanud uuendada.', 'okperformance' ),
				),
				400
			);
		}

		WC()->cart->calculate_totals();
		wp_send_json_success( okperformance_woocommerce_get_cart_fragments_payload() );
	}
}
add_action( 'wp_ajax_okperformance_mini_cart_update_qty', 'okperformance_woocommerce_ajax_update_mini_cart_quantity' );
add_action( 'wp_ajax_nopriv_okperformance_mini_cart_update_qty', 'okperformance_woocommerce_ajax_update_mini_cart_quantity' );

if ( ! function_exists( 'okperformance_woocommerce_cart_link' ) ) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_cart_link() {
		$item_count = WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
		?>
		<a
			class="cart-contents okp-cart-link"
			href="<?php echo esc_url( wc_get_cart_url() ); ?>"
			title="<?php esc_attr_e( 'Ava ostukorv', 'okperformance' ); ?>"
			aria-controls="okp-mini-cart"
			aria-expanded="false"
			data-open-mini-cart
		>
			<span class="okp-cart-link__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" focusable="false">
					<path d="M3 4h2.4l2.1 9.1a1 1 0 0 0 1 .8h8.9a1 1 0 0 0 1-.8L20 7H7.1"></path>
					<circle cx="10" cy="19" r="1.6"></circle>
					<circle cx="18" cy="19" r="1.6"></circle>
				</svg>
			</span>
			<span class="okp-cart-link__count"><?php echo esc_html( (string) $item_count ); ?></span>
			<span class="screen-reader-text">
				<?php
				printf(
					/* translators: %d: cart item count. */
					esc_html( _n( 'Ostukorvis on %d toode', 'Ostukorvis on %d toodet', $item_count, 'okperformance' ) ),
					esc_html( $item_count )
				);
				?>
			</span>
		</a>
		<?php
	}
}

if ( ! function_exists( 'okperformance_woocommerce_render_mini_cart_inner' ) ) {
	/**
	 * Render the mini cart drawer contents.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_render_mini_cart_inner() {
		$item_count = WC()->cart ? (int) WC()->cart->get_cart_contents_count() : 0;
		$cart_items = WC()->cart ? WC()->cart->get_cart() : array();
		$shop_url   = wc_get_page_permalink( 'shop' );

		if ( ! $shop_url ) {
			$shop_url = home_url( '/shop/' );
		}
		?>
		<div class="okp-mini-cart__inner">
			<div class="okp-mini-cart__header">
				<div class="okp-mini-cart__heading">
					<div class="okp-mini-cart__eyebrow"><?php esc_html_e( 'Ostukorv', 'okperformance' ); ?></div>
					<h2 id="okp-mini-cart-title" class="okp-mini-cart__title"><?php esc_html_e( 'Sinu ostukorv', 'okperformance' ); ?></h2>
				</div>

				<button type="button" class="okp-mini-cart__close" data-close-mini-cart aria-label="<?php esc_attr_e( 'Sulge ostukorv', 'okperformance' ); ?>">
					<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
						<path d="M6 6l12 12M18 6L6 18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"></path>
					</svg>
				</button>
			</div>

				<div class="okp-mini-cart__meta">
					<span class="okp-mini-cart__meta-pill">
						<?php
						printf(
							/* translators: %d: cart item count. */
							esc_html( _n( '%d toode', '%d toodet', $item_count, 'okperformance' ) ),
							esc_html( $item_count )
						);
						?>
					</span>
				</div>

			<?php if ( WC()->cart && ! WC()->cart->is_empty() ) : ?>
				<div class="okp-mini-cart__items">
					<?php foreach ( $cart_items as $cart_item_key => $cart_item ) : ?>
						<?php
						$product = isset( $cart_item['data'] ) ? $cart_item['data'] : false;

						if ( ! $product instanceof WC_Product || ! $product->exists() || empty( $cart_item['quantity'] ) ) {
							continue;
						}

						$product_url   = $product->is_visible() ? $product->get_permalink( $cart_item ) : '';
						$product_name  = $product->get_name();
						$product_image = $product->get_image(
							'woocommerce_thumbnail',
							array(
								'loading' => 'lazy',
							)
						);
							$quantity      = (int) $cart_item['quantity'];
							$line_subtotal = WC()->cart->get_product_subtotal( $product, $quantity );
							$max_quantity  = (int) $product->get_max_purchase_quantity();
							$can_increase  = $max_quantity <= 0 || $quantity < $max_quantity;
							$remove_label  = sprintf(
								/* translators: %s: product name. */
								__( 'Eemalda %s ostukorvist', 'okperformance' ),
							wp_strip_all_tags( $product_name )
						);
						?>
						<article class="okp-mini-cart-item">
							<?php if ( $product_url ) : ?>
								<a class="okp-mini-cart-item__thumb" href="<?php echo esc_url( $product_url ); ?>">
									<?php echo $product_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php else : ?>
								<div class="okp-mini-cart-item__thumb">
									<?php echo $product_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</div>
							<?php endif; ?>

								<div class="okp-mini-cart-item__body">
								<div class="okp-mini-cart-item__top">
									<h3 class="okp-mini-cart-item__title">
										<?php if ( $product_url ) : ?>
											<a href="<?php echo esc_url( $product_url ); ?>"><?php echo esc_html( $product_name ); ?></a>
										<?php else : ?>
											<?php echo esc_html( $product_name ); ?>
										<?php endif; ?>
									</h3>

									<a
										class="okp-mini-cart-item__remove remove remove_from_cart_button"
										href="<?php echo esc_url( wc_get_cart_remove_url( $cart_item_key ) ); ?>"
										aria-label="<?php echo esc_attr( $remove_label ); ?>"
										data-product_id="<?php echo esc_attr( (string) $product->get_id() ); ?>"
										data-cart_item_key="<?php echo esc_attr( $cart_item_key ); ?>"
										data-product_sku="<?php echo esc_attr( (string) $product->get_sku() ); ?>"
									>
										<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
											<path d="M6 6l12 12M18 6L6 18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"></path>
										</svg>
									</a>
								</div>

									<div class="okp-mini-cart-item__meta">
										<div class="okp-mini-cart-item__qty-wrap">
											<div class="okp-mini-cart-item__qty-controls" aria-label="<?php esc_attr_e( 'Muuda kogust', 'okperformance' ); ?>">
												<button
													type="button"
													class="okp-mini-cart-item__qty-button"
													data-mini-cart-qty-change="-1"
													data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>"
													data-current-qty="<?php echo esc_attr( (string) $quantity ); ?>"
													<?php disabled( $quantity <= 1 ); ?>
													aria-label="<?php esc_attr_e( 'Vähenda kogust', 'okperformance' ); ?>"
												>
													<span aria-hidden="true">-</span>
												</button>
												<span class="okp-mini-cart-item__qty-value">
													<?php
													printf(
														/* translators: %d: cart item quantity. */
														esc_html__( '%d', 'okperformance' ),
														esc_html( $quantity )
													);
													?>
												</span>
												<button
													type="button"
													class="okp-mini-cart-item__qty-button"
													data-mini-cart-qty-change="1"
													data-cart-item-key="<?php echo esc_attr( $cart_item_key ); ?>"
													data-current-qty="<?php echo esc_attr( (string) $quantity ); ?>"
													<?php disabled( ! $can_increase ); ?>
													aria-label="<?php esc_attr_e( 'Suurenda kogust', 'okperformance' ); ?>"
												>
													<span aria-hidden="true">+</span>
												</button>
											</div>
											<span class="screen-reader-text">
												<?php
												printf(
													/* translators: %d: cart item quantity. */
													esc_html__( 'Kogus: %d', 'okperformance' ),
													esc_html( $quantity )
												);
												?>
											</span>
										</div>
										<span class="okp-mini-cart-item__price"><?php echo wp_kses_post( $line_subtotal ); ?></span>
									</div>
								</div>
						</article>
					<?php endforeach; ?>
				</div>

				<div class="okp-mini-cart__footer">
					<div class="okp-mini-cart__subtotal">
						<span><?php esc_html_e( 'Vahesumma', 'okperformance' ); ?></span>
						<strong><?php echo wp_kses_post( WC()->cart->get_cart_subtotal() ); ?></strong>
					</div>

					<div class="okp-mini-cart__actions">
						<a class="okp-mini-cart__button okp-mini-cart__button--secondary" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
							<?php esc_html_e( 'Vaata ostukorvi', 'okperformance' ); ?>
						</a>
						<a class="okp-mini-cart__button okp-mini-cart__button--primary" href="<?php echo esc_url( wc_get_checkout_url() ); ?>">
							<?php esc_html_e( 'Vormista ost', 'okperformance' ); ?>
						</a>
					</div>
				</div>
			<?php else : ?>
				<div class="okp-mini-cart__empty">
					<div class="okp-mini-cart__empty-icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" focusable="false">
							<path d="M3 4h2.4l2.1 9.1a1 1 0 0 0 1 .8h8.9a1 1 0 0 0 1-.8L20 7H7.1" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
							<circle cx="10" cy="19" r="1.6"></circle>
							<circle cx="18" cy="19" r="1.6"></circle>
						</svg>
					</div>
					<h3><?php esc_html_e( 'Ostukorv on tühi', 'okperformance' ); ?></h3>
					<p><?php esc_html_e( 'Lisa mõned tooted ja need ilmuvad siia.', 'okperformance' ); ?></p>
					<a class="okp-mini-cart__button okp-mini-cart__button--primary" href="<?php echo esc_url( $shop_url ); ?>">
						<?php esc_html_e( 'Mine poodi', 'okperformance' ); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}
}

if ( ! function_exists( 'okperformance_woocommerce_render_mini_cart' ) ) {
	/**
	 * Render the off-canvas mini cart wrapper.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_render_mini_cart() {
		?>
		<div id="okp-mini-cart" class="okp-mini-cart" aria-hidden="true">
			<button type="button" class="okp-mini-cart__overlay" data-close-mini-cart aria-label="<?php esc_attr_e( 'Sulge ostukorv', 'okperformance' ); ?>"></button>
			<aside class="okp-mini-cart__drawer" role="dialog" aria-modal="true" aria-labelledby="okp-mini-cart-title" tabindex="-1">
				<?php okperformance_woocommerce_render_mini_cart_inner(); ?>
			</aside>
		</div>
		<?php
	}
}

if ( ! function_exists( 'okperformance_woocommerce_header_cart' ) ) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function okperformance_woocommerce_header_cart() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php okperformance_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
}
