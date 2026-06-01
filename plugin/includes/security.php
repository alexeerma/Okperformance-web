<?php
/**
 * Security hardening: disable XML-RPC, block REST user enumeration, and add a
 * silent honeypot field to the WooCommerce registration + WP login forms.
 *
 * @package OKPerformanceCore
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Disable XML-RPC entirely. Almost no modern site uses it and it is a common
 * brute-force / amplification vector.
 */
add_filter( 'xmlrpc_enabled', '__return_false' );

add_filter(
	'xmlrpc_methods',
	function () {
		return array();
	},
	99
);

/**
 * Strip the `X-Pingback` header that advertises XML-RPC.
 */
add_filter(
	'wp_headers',
	function ( $headers ) {
		if ( isset( $headers['X-Pingback'] ) ) {
			unset( $headers['X-Pingback'] );
		}

		return $headers;
	},
	99
);

/**
 * Block anonymous access to the WordPress REST user endpoint so bots can not
 * enumerate usernames via /wp-json/wp/v2/users.
 *
 * Logged-in users (e.g. admins using the block editor) keep full access.
 */
add_filter(
	'rest_endpoints',
	function ( $endpoints ) {
		if ( is_user_logged_in() ) {
			return $endpoints;
		}

		if ( isset( $endpoints['/wp/v2/users'] ) ) {
			unset( $endpoints['/wp/v2/users'] );
		}

		if ( isset( $endpoints['/wp/v2/users/(?P<id>[\\d]+)'] ) ) {
			unset( $endpoints['/wp/v2/users/(?P<id>[\\d]+)'] );
		}

		return $endpoints;
	}
);

/**
 * Name of the honeypot field. Bots autofill every visible / text-like input,
 * so a real human (via the real forms) leaves it empty.
 */
function okperformance_security_honeypot_field_name() {
	return 'okp_website_url';
}

/**
 * Inline CSS used to visually hide the honeypot field without using
 * `display:none` (which some bots ignore).
 *
 * @return string
 */
function okperformance_security_honeypot_style() {
	return 'position:absolute;left:-9999px;top:auto;width:1px;height:1px;overflow:hidden;';
}

/**
 * Render the honeypot input.
 *
 * @return void
 */
function okperformance_security_render_honeypot() {
	$name  = okperformance_security_honeypot_field_name();
	$style = okperformance_security_honeypot_style();
	?>
	<p class="okp-hp" aria-hidden="true" style="<?php echo esc_attr( $style ); ?>">
		<label for="<?php echo esc_attr( $name ); ?>">
			<?php esc_html_e( 'Leave this field empty', 'okperformance' ); ?>
		</label>
		<input
			type="text"
			id="<?php echo esc_attr( $name ); ?>"
			name="<?php echo esc_attr( $name ); ?>"
			value=""
			tabindex="-1"
			autocomplete="off"
		/>
	</p>
	<?php
}

/**
 * Check whether the current request contains a filled honeypot (i.e. a bot).
 *
 * @return bool True if the honeypot was tripped.
 */
function okperformance_security_honeypot_tripped() {
	$name = okperformance_security_honeypot_field_name();

	if ( empty( $_POST ) ) {
		return false;
	}

	if ( ! isset( $_POST[ $name ] ) ) {
		return false;
	}

	$raw = wp_unslash( $_POST[ $name ] ); // phpcs:ignore WordPress.Security.NonceVerification.Missing
	if ( is_array( $raw ) || is_object( $raw ) ) {
		return true;
	}

	$value = substr( (string) $raw, 0, 200 );

	return '' !== trim( $value );
}

// --- wp-login.php form (handles core login + lost password + registration). ---
add_action( 'login_form', 'okperformance_security_render_honeypot' );
add_action( 'register_form', 'okperformance_security_render_honeypot' );
add_action( 'lostpassword_form', 'okperformance_security_render_honeypot' );

add_filter(
	'authenticate',
	function ( $user, $username ) {
		if ( okperformance_security_honeypot_tripped() ) {
			return new WP_Error( 'okp_honeypot', __( 'Spam detected.', 'okperformance' ) );
		}

		return $user;
	},
	999,
	2
);

add_filter(
	'registration_errors',
	function ( $errors ) {
		if ( okperformance_security_honeypot_tripped() ) {
			$errors->add( 'okp_honeypot', __( 'Spam detected.', 'okperformance' ) );
		}

		return $errors;
	},
	999
);

add_action(
	'lostpassword_post',
	function ( $errors ) {
		if ( okperformance_security_honeypot_tripped() && is_wp_error( $errors ) ) {
			$errors->add( 'okp_honeypot', __( 'Spam detected.', 'okperformance' ) );
		}
	},
	999
);

// --- WooCommerce forms (My Account registration + login + lost password). ---
add_action( 'woocommerce_register_form', 'okperformance_security_render_honeypot' );
add_action( 'woocommerce_login_form', 'okperformance_security_render_honeypot' );
add_action( 'woocommerce_lostpassword_form', 'okperformance_security_render_honeypot' );

add_filter(
	'woocommerce_process_registration_errors',
	function ( $errors ) {
		if ( okperformance_security_honeypot_tripped() && is_wp_error( $errors ) ) {
			$errors->add( 'okp_honeypot', __( 'Spam detected.', 'okperformance' ) );
		}

		return $errors;
	},
	999
);

add_filter(
	'woocommerce_process_login_errors',
	function ( $validation_error ) {
		if ( okperformance_security_honeypot_tripped() ) {
			return new WP_Error( 'okp_honeypot', __( 'Spam detected.', 'okperformance' ) );
		}

		return $validation_error;
	},
	999
);

// ---------------------------------------------------------------------------
// Block ?author=N username enumeration.
//
// WordPress resolves `?author=1` to the author's slug (which is usually equal
// to their login). Bots scrape this to build a username list, then feed it to
// brute-force tools. Logged-in admin requests (author archives in the editor,
// etc.) keep working.
// ---------------------------------------------------------------------------
add_action(
	'template_redirect',
	function () {
		if ( is_user_logged_in() || is_admin() ) {
			return;
		}

		if ( isset( $_GET['author'] ) && '' !== trim( (string) $_GET['author'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification.Recommended
			wp_safe_redirect( home_url( '/' ), 301 );
			exit;
		}
	}
);

// ---------------------------------------------------------------------------
// Remove WordPress version / generator disclosure.
// Reduces the cheap "scanner picks known-vuln WP version" case. This does NOT
// patch anything — it just lowers signal for opportunistic scanners.
// ---------------------------------------------------------------------------
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );

// Drop `?ver=X.X.X` that matches the current WP version from enqueued assets.
add_filter(
	'style_loader_src',
	'okperformance_security_strip_core_version',
	10,
	2
);
add_filter(
	'script_loader_src',
	'okperformance_security_strip_core_version',
	10,
	2
);

/**
 * Remove the version query arg from a core asset URL when it equals the
 * current WP version. Theme/plugin asset versions (filemtime, _S_VERSION) are
 * preserved so cache busting keeps working.
 *
 * @param string $src    Asset URL.
 * @param string $handle Handle (unused).
 * @return string
 */
function okperformance_security_strip_core_version( $src, $handle = '' ) {
	unset( $handle );

	if ( empty( $src ) || ! is_string( $src ) ) {
		return $src;
	}

	$wp_version = get_bloginfo( 'version' );

	if ( '' === $wp_version ) {
		return $src;
	}

	if ( false !== strpos( $src, 'ver=' . $wp_version ) ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

// ---------------------------------------------------------------------------
// Disable pingbacks & trackbacks (DDoS amplification + comment spam vector).
// We do not publish outgoing pings either.
// ---------------------------------------------------------------------------
add_filter(
	'xmlrpc_methods',
	function ( $methods ) {
		unset( $methods['pingback.ping'] );
		unset( $methods['pingback.extensions.getPingbacks'] );

		return $methods;
	}
);

add_action(
	'pre_ping',
	function ( &$links ) {
		$links = array();
	}
);

// ---------------------------------------------------------------------------
// Generic login error message.
//
// Default WP messages distinguish "unknown username" from "wrong password",
// which lets bots confirm valid usernames. Replace them with a single generic
// string. We keep the original flow for password-reset / expired-cookie
// notices.
// ---------------------------------------------------------------------------
add_filter(
	'login_errors',
	function ( $error ) {
		global $errors;

		if ( ! is_wp_error( $errors ) ) {
			return $error;
		}

		$codes = $errors->get_error_codes();

		if ( empty( $codes ) ) {
			return $error;
		}

		$auth_codes = array(
			'invalid_username',
			'invalid_email',
			'incorrect_password',
			'invalidcombo',
			'authentication_failed',
		);

		foreach ( $codes as $code ) {
			if ( in_array( $code, $auth_codes, true ) ) {
				return __( 'Login failed. Please check your credentials and try again.', 'okperformance' );
			}
		}

		return $error;
	}
);

// ---------------------------------------------------------------------------
// Baseline security response headers.
//
// - X-Content-Type-Options: blocks MIME-sniffing.
// - Referrer-Policy: don't leak full URLs to third parties.
// - X-Frame-Options: clickjacking guard for the front-end. Admin iframes
//   (Customizer, block editor previews) set their own SAMEORIGIN via core.
// - Permissions-Policy: disable features we don't use to shrink attack
//   surface (camera/mic/geolocation/etc.).
// - Strict-Transport-Security: only when the request is already HTTPS so we
//   don't break a plain-HTTP dev environment.
//
// Headers are NOT sent in wp-admin to avoid conflicting with core / plugins.
// ---------------------------------------------------------------------------
add_action(
	'send_headers',
	function () {
		if ( is_admin() || ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
			return;
		}

		if ( ! headers_sent() ) {
			header( 'X-Content-Type-Options: nosniff' );
			header( 'Referrer-Policy: strict-origin-when-cross-origin' );
			header( 'X-Frame-Options: SAMEORIGIN' );
			header( 'Permissions-Policy: camera=(), microphone=(), geolocation=(), payment=(self), usb=(), fullscreen=(self)' );

			if ( is_ssl() ) {
				header( 'Strict-Transport-Security: max-age=15552000; includeSubDomains' );
			}
		}
	},
	1
);
