<?php
/**
 * My Account dashboard.
 *
 * Overrides WooCommerce's myaccount/dashboard.php template with a friendlier
 * OKPerformance dark/purple welcome and a small grid of quick-action cards.
 *
 * @package OKPerformance
 */

defined( 'ABSPATH' ) || exit;

$okp_dashboard_user   = isset( $current_user ) && $current_user instanceof WP_User ? $current_user : wp_get_current_user();
$okp_dashboard_name   = $okp_dashboard_user instanceof WP_User && '' !== trim( $okp_dashboard_user->display_name )
	? $okp_dashboard_user->display_name
	: __( 'sportlane', 'okperformance' );
$okp_dashboard_email  = $okp_dashboard_user instanceof WP_User ? $okp_dashboard_user->user_email : '';
$okp_dashboard_logout = function_exists( 'wc_logout_url' ) ? wc_logout_url() : wp_logout_url( home_url( '/' ) );

$okp_dashboard_cards = array(
	array(
		'label' => __( 'Minu tellimused', 'okperformance' ),
		'desc'  => __( 'Vaata oma viimaseid tellimusi ja nende staatust.', 'okperformance' ),
		'url'   => wc_get_endpoint_url( 'orders' ),
		'icon'  => '<rect x="4" y="6" width="16" height="14" rx="2"></rect><path d="M8 6V4h8v2"></path><path d="M8 11h8"></path><path d="M8 15h5"></path>',
	),
	array(
		'label' => __( 'Aadressid', 'okperformance' ),
		'desc'  => __( 'Halda oma arveldus- ja tarneandmeid.', 'okperformance' ),
		'url'   => wc_get_endpoint_url( 'edit-address' ),
		'icon'  => '<path d="M12 21s7-5.2 7-11a7 7 0 0 0-14 0c0 5.8 7 11 7 11z"></path><circle cx="12" cy="10" r="2.4"></circle>',
	),
	array(
		'label' => __( 'Konto andmed', 'okperformance' ),
		'desc'  => __( 'Uuenda e-posti, salasõna ja kontoseadeid.', 'okperformance' ),
		'url'   => wc_get_endpoint_url( 'edit-account' ),
		'icon'  => '<circle cx="12" cy="8" r="4"></circle><path d="M4 21a8 8 0 0 1 16 0"></path>',
	),
);
?>

<div class="okp-account-dashboard">
	<div class="okp-account-dashboard__header">
		<h2 class="okp-account-dashboard__title">
			<?php
			printf(
				/* translators: %s: user display name. */
				esc_html__( 'Tere tulemast tagasi, %s!', 'okperformance' ),
				esc_html( $okp_dashboard_name )
			);
			?>
		</h2>
		<?php if ( '' !== $okp_dashboard_email ) : ?>
			<p class="okp-account-dashboard__meta">
				<?php echo esc_html( $okp_dashboard_email ); ?>
				&nbsp;&middot;&nbsp;
				<a href="<?php echo esc_url( $okp_dashboard_logout ); ?>"><?php esc_html_e( 'Logi välja', 'okperformance' ); ?></a>
			</p>
		<?php endif; ?>
	</div>

	<p class="okp-account-dashboard__lede">
		<?php esc_html_e( 'Siin saad hallata oma OKPerformance kontot. Vaata tellimusi, uuenda aadresse ja muuda kontoseadeid.', 'okperformance' ); ?>
	</p>

	<div class="okp-account-dashboard__grid">
		<?php foreach ( $okp_dashboard_cards as $card ) : ?>
			<a class="okp-account-dashboard__card" href="<?php echo esc_url( $card['url'] ); ?>">
				<span class="okp-account-dashboard__card-icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" focusable="false">
						<?php echo $card['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</svg>
				</span>
				<span class="okp-account-dashboard__card-body">
					<strong><?php echo esc_html( $card['label'] ); ?></strong>
					<span><?php echo esc_html( $card['desc'] ); ?></span>
				</span>
				<span class="okp-account-dashboard__card-arrow" aria-hidden="true">&rarr;</span>
			</a>
		<?php endforeach; ?>
	</div>
</div>

<?php
do_action( 'woocommerce_account_dashboard' );
do_action( 'woocommerce_before_my_account' );
do_action( 'woocommerce_after_my_account' );
