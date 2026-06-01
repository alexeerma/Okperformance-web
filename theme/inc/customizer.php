<?php
/**
 * OKPerformance Theme Customizer
 *
 * @package OKPerformance
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function okperformance_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'okperformance_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'okperformance_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_section(
		'okperformance_footer_logos',
		array(
			'title'       => __( 'Footer Logo Slider', 'okperformance' ),
			'description' => __( 'Add monochrome partner or client logos and optional links for the looping footer marquee.', 'okperformance' ),
			'priority'    => 160,
		)
	);

	for ( $index = 1; $index <= 8; $index++ ) {
		$image_setting = 'okperformance_footer_logo_' . $index . '_image';
		$url_setting   = 'okperformance_footer_logo_' . $index . '_url';

		$wp_customize->add_setting(
			$image_setting,
			array(
				'default'           => 0,
				'sanitize_callback' => 'absint',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Media_Control(
				$wp_customize,
				$image_setting,
				array(
					'label'      => sprintf( __( 'Logo %d Image', 'okperformance' ), $index ),
					'section'    => 'okperformance_footer_logos',
					'mime_type'  => 'image',
					'priority'   => 10 + ( $index * 2 ),
				)
			)
		);

		$wp_customize->add_setting(
			$url_setting,
			array(
				'default'           => '',
				'sanitize_callback' => 'esc_url_raw',
			)
		);

		$wp_customize->add_control(
			$url_setting,
			array(
				'label'       => sprintf( __( 'Logo %d Link URL', 'okperformance' ), $index ),
				'section'     => 'okperformance_footer_logos',
				'type'        => 'url',
				'input_attrs' => array(
					'placeholder' => 'https://example.com',
				),
				'priority'    => 11 + ( $index * 2 ),
			)
		);
	}

	$wp_customize->add_section(
		'okperformance_shop_archive',
		array(
			'title'       => __( 'Shop Archive', 'okperformance' ),
			'description' => __( 'Adjust copy used on the WooCommerce product archive.', 'okperformance' ),
			'priority'    => 165,
		)
	);

	$wp_customize->add_setting(
		'okperformance_shop_archive_pill_label',
		array(
			'default'           => __( 'Gym programs', 'okperformance' ),
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'okperformance_shop_archive_pill_label',
		array(
			'label'       => __( 'Archive pill label', 'okperformance' ),
			'description' => __( 'Leave empty to hide the pill above the shop archive title.', 'okperformance' ),
			'section'     => 'okperformance_shop_archive',
			'type'        => 'text',
		)
	);
}
add_action( 'customize_register', 'okperformance_customize_register' );

/**
 * Get configured footer logo items.
 *
 * @return array<int, array<string, string>>
 */
function okperformance_get_footer_logo_items() {
	$items = array();

	for ( $index = 1; $index <= 8; $index++ ) {
		$image_id = (int) get_theme_mod( 'okperformance_footer_logo_' . $index . '_image', 0 );
		$link_url = (string) get_theme_mod( 'okperformance_footer_logo_' . $index . '_url', '' );
		$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'medium_large' ) : '';
		$alt_text  = $image_id ? get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';

		if ( ! $image_url ) {
			continue;
		}

		$items[] = array(
			'image_url' => esc_url( $image_url ),
			'link_url'  => esc_url( $link_url ),
			'alt'       => sanitize_text_field( $alt_text ? $alt_text : get_bloginfo( 'name' ) . ' logo' ),
		);
	}

	return $items;
}

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function okperformance_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function okperformance_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function okperformance_customize_preview_js() {
	wp_enqueue_script( 'okperformance-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'okperformance_customize_preview_js' );
