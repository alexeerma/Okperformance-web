<?php
/**
 * Login form.
 *
 * Overrides WooCommerce's myaccount/form-login.php template with the
 * OKPerformance dark/purple card layout. Renders the login form (and the
 * optional registration form, when enabled in WooCommerce settings) inside
 * matching cards.
 *
 * @package OKPerformance
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_customer_login_form' );

$okp_registration_open = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' );
?>

<div class="okp-account-auth <?php echo $okp_registration_open ? 'okp-account-auth--two-up' : ''; ?>">

	<section class="okp-account-auth__panel" id="customer_login">
		<header class="okp-account-auth__head">
			<h2 class="okp-account-auth__title"><?php esc_html_e( 'Logi sisse', 'okperformance' ); ?></h2>
			<p class="okp-account-auth__lede"><?php esc_html_e( 'Sisene oma kontosse, et näha tellimusi ja kontoseadeid.', 'okperformance' ); ?></p>
		</header>

		<form class="okp-account-auth__form woocommerce-form woocommerce-form-login login" method="post" novalidate>

			<?php do_action( 'woocommerce_login_form_start' ); ?>

			<p class="form-row form-row-wide woocommerce-form-row woocommerce-form-row--wide">
				<label for="username">
					<?php esc_html_e( 'Kasutajanimi või e-post', 'okperformance' ); ?>
					<span class="required" aria-hidden="true">*</span>
					<span class="screen-reader-text"><?php esc_html_e( 'Kohustuslik', 'okperformance' ); ?></span>
				</label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // phpcs:ignore WordPress.Security.NonceVerification.Missing ?>
			</p>

			<p class="form-row form-row-wide woocommerce-form-row woocommerce-form-row--wide">
				<label for="password">
					<?php esc_html_e( 'Salasõna', 'okperformance' ); ?>
					<span class="required" aria-hidden="true">*</span>
					<span class="screen-reader-text"><?php esc_html_e( 'Kohustuslik', 'okperformance' ); ?></span>
				</label>
				<input class="woocommerce-Input woocommerce-Input--text input-text" type="password" name="password" id="password" autocomplete="current-password" required aria-required="true" />
			</p>

			<?php do_action( 'woocommerce_login_form' ); ?>

			<div class="okp-account-auth__row">
				<label class="okp-account-auth__remember woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" />
					<span><?php esc_html_e( 'Jäta mind meelde', 'okperformance' ); ?></span>
				</label>
				<a class="okp-account-auth__lost woocommerce-LostPassword" href="<?php echo esc_url( wp_lostpassword_url() ); ?>">
					<?php esc_html_e( 'Unustasid salasõna?', 'okperformance' ); ?>
				</a>
			</div>

			<p class="okp-account-auth__submit">
				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
				<button type="submit" class="okp-btn okp-btn--primary woocommerce-button woocommerce-form-login__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="login" value="<?php esc_attr_e( 'Logi sisse', 'okperformance' ); ?>"><?php esc_html_e( 'Logi sisse', 'okperformance' ); ?></button>
			</p>

			<?php do_action( 'woocommerce_login_form_end' ); ?>

		</form>
	</section>

	<?php if ( $okp_registration_open ) : ?>
		<section class="okp-account-auth__panel">
			<header class="okp-account-auth__head">
				<h2 class="okp-account-auth__title"><?php esc_html_e( 'Loo konto', 'okperformance' ); ?></h2>
				<p class="okp-account-auth__lede"><?php esc_html_e( 'Liitu OKPerformance kogukonnaga ja alusta oma teekonda.', 'okperformance' ); ?></p>
			</header>

			<form method="post" class="okp-account-auth__form woocommerce-form woocommerce-form-register register" <?php do_action( 'woocommerce_register_form_tag' ); ?>>

				<?php do_action( 'woocommerce_register_form_start' ); ?>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
					<p class="form-row form-row-wide woocommerce-form-row woocommerce-form-row--wide">
						<label for="reg_username">
							<?php esc_html_e( 'Kasutajanimi', 'okperformance' ); ?>
							<span class="required" aria-hidden="true">*</span>
							<span class="screen-reader-text"><?php esc_html_e( 'Kohustuslik', 'okperformance' ); ?></span>
						</label>
						<input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" autocomplete="username" value="<?php echo ( ! empty( $_POST['username'] ) && is_string( $_POST['username'] ) ) ? esc_attr( wp_unslash( $_POST['username'] ) ) : ''; ?>" required aria-required="true" /><?php // phpcs:ignore WordPress.Security.NonceVerification.Missing ?>
					</p>
				<?php endif; ?>

				<p class="form-row form-row-wide woocommerce-form-row woocommerce-form-row--wide">
					<label for="reg_email">
						<?php esc_html_e( 'E-posti aadress', 'okperformance' ); ?>
						<span class="required" aria-hidden="true">*</span>
						<span class="screen-reader-text"><?php esc_html_e( 'Kohustuslik', 'okperformance' ); ?></span>
					</label>
					<input type="email" class="woocommerce-Input woocommerce-Input--text input-text" name="email" id="reg_email" autocomplete="email" value="<?php echo ( ! empty( $_POST['email'] ) && is_string( $_POST['email'] ) ) ? esc_attr( wp_unslash( $_POST['email'] ) ) : ''; ?>" required aria-required="true" /><?php // phpcs:ignore WordPress.Security.NonceVerification.Missing ?>
				</p>

				<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
					<p class="form-row form-row-wide woocommerce-form-row woocommerce-form-row--wide">
						<label for="reg_password">
							<?php esc_html_e( 'Salasõna', 'okperformance' ); ?>
							<span class="required" aria-hidden="true">*</span>
							<span class="screen-reader-text"><?php esc_html_e( 'Kohustuslik', 'okperformance' ); ?></span>
						</label>
						<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password" id="reg_password" autocomplete="new-password" required aria-required="true" />
					</p>
				<?php else : ?>
					<p><?php esc_html_e( 'Saadame uue salasõna määramise lingi sinu e-postile.', 'okperformance' ); ?></p>
				<?php endif; ?>

				<?php do_action( 'woocommerce_register_form' ); ?>

				<p class="okp-account-auth__submit">
					<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
					<button type="submit" class="okp-btn okp-btn--primary woocommerce-Button woocommerce-button woocommerce-form-register__submit<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" name="register" value="<?php esc_attr_e( 'Loo konto', 'okperformance' ); ?>"><?php esc_html_e( 'Loo konto', 'okperformance' ); ?></button>
				</p>

				<?php do_action( 'woocommerce_register_form_end' ); ?>

			</form>
		</section>
	<?php endif; ?>
</div>

<?php do_action( 'woocommerce_after_customer_login_form' ); ?>
