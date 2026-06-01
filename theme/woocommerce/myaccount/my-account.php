<?php
/**
 * My Account page wrapper.
 *
 * Overrides WooCommerce's myaccount/my-account.php template with the
 * OKPerformance dark/purple design language: hero header, sidebar
 * navigation, and a card-style content panel.
 *
 * @package OKPerformance
 */

defined( 'ABSPATH' ) || exit;

$okp_account_user = wp_get_current_user();
$okp_account_name = $okp_account_user instanceof WP_User && '' !== trim( $okp_account_user->display_name )
	? $okp_account_user->display_name
	: __( 'sportlane', 'okperformance' );
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<section class="okp-account-page" aria-label="<?php esc_attr_e( 'Minu konto', 'okperformance' ); ?>">
	<div class="okp-home__shell">
		<header class="okp-account-page__hero">
			<div class="okp-pill okp-account-page__pill"><?php esc_html_e( 'Minu konto', 'okperformance' ); ?></div>
			<h1 class="okp-account-page__title">
				<?php
				printf(
					/* translators: %s: user display name. */
					esc_html__( 'Tere, %s', 'okperformance' ),
					esc_html( $okp_account_name )
				);
				?>
			</h1>
			<p class="okp-account-page__lede">
				<?php esc_html_e( 'Halda oma tellimusi, aadresse ja kontoseadeid ühest kohast.', 'okperformance' ); ?>
			</p>
		</header>

		<div class="okp-account-page__layout">
			<aside class="okp-account-page__sidebar">
				<?php do_action( 'woocommerce_account_navigation' ); ?>
			</aside>

			<div class="okp-account-page__content woocommerce-MyAccount-content">
				<?php do_action( 'woocommerce_account_content' ); ?>
			</div>
		</div>
	</div>
</section>
