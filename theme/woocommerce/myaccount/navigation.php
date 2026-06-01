<?php
/**
 * My Account navigation.
 *
 * Overrides WooCommerce's myaccount/navigation.php template with the
 * OKPerformance dark/purple sidebar styling and adds a small inline icon
 * for each known account endpoint.
 *
 * @package OKPerformance
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_navigation' );

$okp_account_icons = array(
	'dashboard'       => '<path d="M3 12 12 4l9 8"></path><path d="M5 10v10h14V10"></path>',
	'orders'          => '<rect x="4" y="6" width="16" height="14" rx="2"></rect><path d="M8 6V4h8v2"></path><path d="M8 11h8"></path><path d="M8 15h5"></path>',
	'downloads'       => '<path d="M12 4v12"></path><path d="m7 11 5 5 5-5"></path><path d="M5 20h14"></path>',
	'edit-address'    => '<path d="M12 21s7-5.2 7-11a7 7 0 0 0-14 0c0 5.8 7 11 7 11z"></path><circle cx="12" cy="10" r="2.4"></circle>',
	'payment-methods' => '<rect x="3" y="6" width="18" height="12" rx="2"></rect><path d="M3 10h18"></path>',
	'edit-account'    => '<circle cx="12" cy="8" r="4"></circle><path d="M4 21a8 8 0 0 1 16 0"></path>',
	'customer-logout' => '<path d="M15 12H4"></path><path d="m9 7-5 5 5 5"></path><path d="M14 4h5a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1h-5"></path>',
);
?>

<nav class="okp-account-nav woocommerce-MyAccount-navigation" aria-label="<?php esc_attr_e( 'Konto navigatsioon', 'okperformance' ); ?>">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php
			$icon_paths = isset( $okp_account_icons[ $endpoint ] ) ? $okp_account_icons[ $endpoint ] : '<circle cx="12" cy="12" r="9"></circle>';
			$is_current = wc_is_current_account_menu_item( $endpoint );
			?>
			<li class="<?php echo esc_attr( wc_get_account_menu_item_classes( $endpoint ) ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>" <?php echo $is_current ? 'aria-current="page"' : ''; ?>>
					<span class="okp-account-nav__icon" aria-hidden="true">
						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" focusable="false">
							<?php echo $icon_paths; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</svg>
					</span>
					<span class="okp-account-nav__label"><?php echo esc_html( $label ); ?></span>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
