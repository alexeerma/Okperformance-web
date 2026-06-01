<?php
/**
 * OKPerformance functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package OKPerformance
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function okperformance_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on OKPerformance, use a find and replace
		* to change 'okperformance' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'okperformance', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1'         => esc_html__( 'Header Primary Menu', 'okperformance' ),
			'header-utility' => esc_html__( 'Header Secondary Menu', 'okperformance' ),
			'footer-menu'    => esc_html__( 'Footer Platform Menu', 'okperformance' ),
			'footer-meta'    => esc_html__( 'Footer Company Menu', 'okperformance' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Set up the WordPress core custom background feature.
	add_theme_support(
		'custom-background',
		apply_filters(
			'okperformance_custom_background_args',
			array(
				'default-color' => 'ffffff',
				'default-image' => '',
			)
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'okperformance_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function okperformance_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'okperformance_content_width', 640 );
}
add_action( 'after_setup_theme', 'okperformance_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function okperformance_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'okperformance' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'okperformance' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'okperformance_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function okperformance_scripts() {
	$style_path           = get_stylesheet_directory() . '/style.css';
	$navigation_js_path   = get_template_directory() . '/js/navigation.js';
	$home_js_path         = get_template_directory() . '/js/home.js';
	$style_version        = file_exists( $style_path ) ? (string) filemtime( $style_path ) : _S_VERSION;
	$navigation_version   = file_exists( $navigation_js_path ) ? (string) filemtime( $navigation_js_path ) : _S_VERSION;
	$home_version         = file_exists( $home_js_path ) ? (string) filemtime( $home_js_path ) : _S_VERSION;

	wp_enqueue_style( 'okperformance-style', get_stylesheet_uri(), array(), $style_version );
	wp_style_add_data( 'okperformance-style', 'rtl', 'replace' );

	wp_enqueue_script( 'okperformance-navigation', get_template_directory_uri() . '/js/navigation.js', array(), $navigation_version, true );

	if ( is_front_page() || is_page_template( 'home-template.php' ) ) {
		wp_enqueue_script( 'okperformance-home', get_template_directory_uri() . '/js/home.js', array(), $home_version, true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'okperformance_scripts' );

/**
 * Whether the OKPerformance core plugin APIs are available.
 *
 * @return bool
 */
function okperformance_has_core_plugin() {
	return function_exists( 'okperformance_home_get_options' ) && function_exists( 'okperformance_get_home_services' );
}

/**
 * Render the default OKPerformance logo asset, or fall back to the custom logo.
 *
 * @param string $context Optional context modifier for CSS hooks.
 * @return void
 */
function okperformance_site_logo( $context = 'header' ) {
	$logo_asset_path = get_template_directory() . '/assets/okperformance-d-barbell-monogram.svg';
	$logo_asset_url  = get_template_directory_uri() . '/assets/okperformance-d-barbell-monogram.svg';
	$context         = sanitize_html_class( (string) $context );
	$link_class      = 'site-branding__logo-link';
	$image_class     = 'site-branding__logo-image';

	if ( 'footer' === $context ) {
		$link_class  .= ' site-branding__logo-link--footer';
		$image_class .= ' site-branding__logo-image--footer';
	}

	if ( file_exists( $logo_asset_path ) ) {
		?>
		<a class="<?php echo esc_attr( $link_class ); ?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" aria-label="<?php bloginfo( 'name' ); ?>">
			<img class="<?php echo esc_attr( $image_class ); ?>" src="<?php echo esc_url( $logo_asset_url ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
		</a>
		<?php
		return;
	}

	if ( has_custom_logo() ) {
		the_custom_logo();
	}
}

/**
 * Fallback navigation for the primary header menu.
 *
 * @return void
 */
function okperformance_primary_menu_fallback() {
	echo '<ul id="primary-menu" class="menu nav-menu menu--primary">';
	wp_list_pages(
		array(
			'title_li' => '',
		)
	);
	echo '</ul>';
}

/**
 * Render the header commerce actions.
 *
 * @return void
 */
function okperformance_header_commerce() {
	$current_user = wp_get_current_user();
	$is_logged_in = is_user_logged_in();
	$account_name = '';
	$account_url  = $is_logged_in ? get_edit_profile_url( $current_user->ID ) : wp_login_url( home_url( '/' ) );

	if ( class_exists( 'WooCommerce' ) ) {
		$account_url = wc_get_page_permalink( 'myaccount' );
	}

	if ( $is_logged_in ) {
		$account_name = $current_user->display_name ? $current_user->display_name : $current_user->user_login;
		?>
		<div class="header-commerce">
			<a class="header-commerce__account" href="<?php echo esc_url( $account_url ); ?>">
				<span class="header-commerce__icon" aria-hidden="true">
					<svg viewBox="0 0 24 24" focusable="false">
						<path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z"></path>
						<path d="M4 20a8 8 0 0 1 16 0"></path>
					</svg>
				</span>
				<span class="header-commerce__label"><?php echo esc_html( $account_name ); ?></span>
			</a>

			<?php if ( class_exists( 'WooCommerce' ) && function_exists( 'okperformance_woocommerce_cart_link' ) ) : ?>
				<?php okperformance_woocommerce_cart_link(); ?>
			<?php endif; ?>
		</div>
		<?php
		return;
	}

	if ( ! okperformance_header_should_show_login() ) {
		return;
	}

	?>
	<div class="header-commerce">
		<a class="header-commerce__login" href="<?php echo esc_url( $account_url ); ?>">
			<span class="header-commerce__icon" aria-hidden="true">
				<svg viewBox="0 0 24 24" focusable="false">
					<path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Z"></path>
					<path d="M4 20a8 8 0 0 1 16 0"></path>
				</svg>
			</span>
			<span class="header-commerce__label"><?php esc_html_e( 'Log in', 'okperformance' ); ?></span>
		</a>
	</div>
	<?php
}

/**
 * Decide whether the public header should expose a "Log in" button.
 *
 * When the site has registration turned off at every level (core and
 * WooCommerce) there is no customer-facing reason to advertise the login form,
 * so we hide the button to reduce the attack surface exposed to bots.
 *
 * Use the `okperformance_header_show_login` filter to force show/hide.
 *
 * @return bool
 */
function okperformance_header_should_show_login() {
	$wp_registration_open = (bool) get_option( 'users_can_register' );

	$wc_registration_open = false;

	if ( class_exists( 'WooCommerce' ) ) {
		$wc_registration_open = 'yes' === get_option( 'woocommerce_enable_myaccount_registration' )
			|| 'yes' === get_option( 'woocommerce_enable_signup_and_login_from_checkout' );
	}

	$show = $wp_registration_open || $wc_registration_open;

	return (bool) apply_filters( 'okperformance_header_show_login', $show );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Display an admin notice when the core plugin is inactive.
 *
 * @return void
 */
function okperformance_core_plugin_notice() {
	if ( okperformance_has_core_plugin() || ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if ( $screen && 'themes' === $screen->base ) {
		$message = __( 'OKPerformance theme expects the OKPerformance Core plugin to be active for homepage settings, services, and other site logic.', 'okperformance' );
	} else {
		$message = __( 'Activate the OKPerformance Core plugin to restore homepage options, Services content, and other core OKPerformance functionality.', 'okperformance' );
	}
	?>
	<div class="notice notice-warning">
		<p><?php echo esc_html( $message ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'okperformance_core_plugin_notice' );
