<?php
/**
 * Services content type and homepage helpers.
 *
 * @package OKPerformance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Services custom post type.
 *
 * @return void
 */
function okperformance_register_services_post_type() {
	$labels = array(
		'name'                  => _x( 'Services', 'post type general name', 'okperformance' ),
		'singular_name'         => _x( 'Service', 'post type singular name', 'okperformance' ),
		'menu_name'             => _x( 'Services', 'admin menu', 'okperformance' ),
		'name_admin_bar'        => _x( 'Service', 'add new on admin bar', 'okperformance' ),
		'add_new'               => _x( 'Add New', 'service', 'okperformance' ),
		'add_new_item'          => __( 'Add New Service', 'okperformance' ),
		'new_item'              => __( 'New Service', 'okperformance' ),
		'edit_item'             => __( 'Edit Service', 'okperformance' ),
		'view_item'             => __( 'View Service', 'okperformance' ),
		'all_items'             => __( 'All Services', 'okperformance' ),
		'search_items'          => __( 'Search Services', 'okperformance' ),
		'parent_item_colon'     => __( 'Parent Services:', 'okperformance' ),
		'not_found'             => __( 'No services found.', 'okperformance' ),
		'not_found_in_trash'    => __( 'No services found in Trash.', 'okperformance' ),
		'featured_image'        => __( 'Service image', 'okperformance' ),
		'set_featured_image'    => __( 'Set service image', 'okperformance' ),
		'remove_featured_image' => __( 'Remove service image', 'okperformance' ),
		'use_featured_image'    => __( 'Use as service image', 'okperformance' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'services' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 22,
		'menu_icon'          => 'dashicons-superhero',
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
	);

	register_post_type( 'okp_service', $args );
}
add_action( 'init', 'okperformance_register_services_post_type' );

/**
 * Register a square hero image size for the single service template.
 *
 * A crisp 2x square crop keeps the service hero image sharp on retina
 * displays and ensures consistent framing regardless of the uploaded ratio.
 *
 * @return void
 */
function okperformance_register_service_image_sizes() {
	add_image_size( 'okp_service_hero', 1040, 1040, true );
}
add_action( 'after_setup_theme', 'okperformance_register_service_image_sizes' );

/**
 * Default labels for the service detail cards.
 *
 * These mirror the Estonian copy used on the frontend so editors always have a
 * sensible starting point for each of the four cards.
 *
 * @return array<int, array{title: string, text: string}>
 */
function okperformance_service_card_defaults() {
	return array(
		array(
			'title' => __( 'Kellel sobib?', 'okperformance' ),
			'text'  => __( 'Kirjelda, kellele teenus on mõeldud – sihtrühm, tase, vajadused.', 'okperformance' ),
		),
		array(
			'title' => __( 'Miks valida?', 'okperformance' ),
			'text'  => __( 'Too välja peamised põhjused, miks see teenus annab parima tulemuse.', 'okperformance' ),
		),
		array(
			'title' => __( 'Mida saad?', 'okperformance' ),
			'text'  => __( 'Loetle konkreetsed väärtused, materjalid ja tugi, mille klient saab.', 'okperformance' ),
		),
		array(
			'title' => __( 'Lisaväärtus', 'okperformance' ),
			'text'  => __( 'Too esile boonused, kogukond või järeltugi, mis teeb teenuse eriliseks.', 'okperformance' ),
		),
	);
}

/**
 * Register editable service metadata used by homepage service panels.
 *
 * @return void
 */
function okperformance_register_service_home_meta() {
	register_post_meta(
		'okp_service',
		'_okp_service_home_panel_text',
		array(
			'auth_callback'     => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => 'sanitize_text_field',
			'show_in_rest'      => true,
			'single'            => true,
			'type'              => 'string',
		)
	);

	register_post_meta(
		'okp_service',
		'_okp_service_home_feature_text',
		array(
			'auth_callback'     => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => 'sanitize_textarea_field',
			'show_in_rest'      => true,
			'single'            => true,
			'type'              => 'string',
		)
	);

	register_post_meta(
		'okp_service',
		'_okp_service_mid_content',
		array(
			'auth_callback'     => function() {
				return current_user_can( 'edit_posts' );
			},
			'sanitize_callback' => 'wp_kses_post',
			'show_in_rest'      => true,
			'single'            => true,
			'type'              => 'string',
		)
	);
}
add_action( 'init', 'okperformance_register_service_home_meta' );

/**
 * Get the mid-content WYSIWYG block shown between the service hero and the
 * detail cards on the single service template.
 *
 * @param int|WP_Post|null $post Post ID or post object.
 * @return string
 */
function okperformance_get_service_mid_content( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return '';
	}

	return (string) get_post_meta( $post->ID, '_okp_service_mid_content', true );
}

/**
 * Get the small custom text shown above a service in the homepage selector.
 *
 * @param int|WP_Post|null $post Post ID or post object.
 * @return string
 */
function okperformance_get_service_home_panel_text( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return '';
	}

	$text = (string) get_post_meta( $post->ID, '_okp_service_home_panel_text', true );

	if ( '' === $text ) {
		return '';
	}

	return (string) apply_filters(
		'wpml_translate_single_string',
		$text,
		'okperformance',
		'Service homepage panel text - ' . $post->ID
	);
}

/**
 * Get the custom text shown below a service title in the homepage feature panel.
 *
 * @param int|WP_Post|null $post Post ID or post object.
 * @return string
 */
function okperformance_get_service_home_feature_text( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return '';
	}

	$text = (string) get_post_meta( $post->ID, '_okp_service_home_feature_text', true );

	if ( '' === $text ) {
		return '';
	}

	return (string) apply_filters(
		'wpml_translate_single_string',
		$text,
		'okperformance',
		'Service homepage featured text - ' . $post->ID
	);
}

/**
 * Get the configured card data for a service post.
 *
 * @param int|WP_Post|null $post Post ID or post object.
 * @return array<int, array{title: string, text: string}>
 */
function okperformance_get_service_cards( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return array();
	}

	$defaults = okperformance_service_card_defaults();
	$cards    = array();

	for ( $i = 1; $i <= 4; $i++ ) {
		$title = (string) get_post_meta( $post->ID, '_okp_service_card_' . $i . '_title', true );
		$text  = (string) get_post_meta( $post->ID, '_okp_service_card_' . $i . '_text', true );

		$cards[] = array(
			'title' => '' !== $title ? $title : $defaults[ $i - 1 ]['title'],
			'text'  => '' !== $text ? $text : $defaults[ $i - 1 ]['text'],
		);
	}

	return $cards;
}

/**
 * Register the service detail cards meta box.
 *
 * @return void
 */
function okperformance_service_register_cards_meta_box() {
	add_meta_box(
		'okp_service_home_display',
		__( 'Avalehe kuvamine', 'okperformance' ),
		'okperformance_service_render_home_display_meta_box',
		'okp_service',
		'normal',
		'high'
	);

	add_meta_box(
		'okp_service_mid_content',
		__( 'Lisainfo (kuvatakse heroe all)', 'okperformance' ),
		'okperformance_service_render_mid_content_meta_box',
		'okp_service',
		'normal',
		'high'
	);

	add_meta_box(
		'okp_service_cards',
		__( 'Teenuse infokaardid', 'okperformance' ),
		'okperformance_service_render_cards_meta_box',
		'okp_service',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'okperformance_service_register_cards_meta_box' );

/**
 * Render the homepage display meta box.
 *
 * Lets editors set per-service copy for the homepage services switcher:
 * a small eyebrow label shown above the title in the right-side menu and
 * a short description shown under the title in the large left panel.
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function okperformance_service_render_home_display_meta_box( $post ) {
	wp_nonce_field( 'okp_service_home_display_save', 'okp_service_home_display_nonce' );

	$panel_text   = (string) get_post_meta( $post->ID, '_okp_service_home_panel_text', true );
	$feature_text = (string) get_post_meta( $post->ID, '_okp_service_home_feature_text', true );

	echo '<p style="margin:0 0 14px;color:#50575e;">';
	echo esc_html__( 'Need väärtused on iga teenuse jaoks eraldi seadistatavad ja mõjutavad avalehe teenuste sektsiooni kuvamist.', 'okperformance' );
	echo '</p>';

	echo '<p style="margin:0 0 6px;"><label for="okp_service_home_panel_text"><strong>';
	echo esc_html__( 'Avalehe sildi tekst', 'okperformance' );
	echo '</strong></label></p>';
	printf(
		'<input type="text" class="widefat" id="okp_service_home_panel_text" name="okp_service_home_panel_text" value="%1$s" placeholder="%2$s" />',
		esc_attr( $panel_text ),
		esc_attr__( 'Näide: Personaalne treening', 'okperformance' )
	);
	echo '<p style="margin:8px 0 0;color:#646970;">';
	echo esc_html__( 'Lühike silt, mis kuvatakse avalehe teenuste menüüs selle teenuse pealkirja kohal. Jäta tühjaks, et silt ära peita.', 'okperformance' );
	echo '</p>';

	echo '<p style="margin:18px 0 6px;"><label for="okp_service_home_feature_text"><strong>';
	echo esc_html__( 'Avalehe paneeli kirjeldus', 'okperformance' );
	echo '</strong></label></p>';
	printf(
		'<textarea class="widefat" id="okp_service_home_feature_text" name="okp_service_home_feature_text" rows="3" placeholder="%2$s">%1$s</textarea>',
		esc_textarea( $feature_text ),
		esc_attr__( 'Lühike kirjeldus, mis kuvatakse selle teenuse all avalehe suure paneeli sektsioonis.', 'okperformance' )
	);
	echo '<p style="margin:8px 0 0;color:#646970;">';
	echo esc_html__( 'Kuvatakse teenuse pealkirja all avalehe suures paneelis. Jäta tühjaks, et kasutada teenuse sissejuhatust või vaikeväärtust.', 'okperformance' );
	echo '</p>';
}

/**
 * Render the mid-content WYSIWYG meta box.
 *
 * Used to add a per-service editable section that appears between the hero
 * and the four detail cards.
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function okperformance_service_render_mid_content_meta_box( $post ) {
	wp_nonce_field( 'okp_service_mid_content_save', 'okp_service_mid_content_nonce' );

	$mid_content = (string) get_post_meta( $post->ID, '_okp_service_mid_content', true );

	echo '<p style="margin:0 0 10px;color:#50575e;">';
	echo esc_html__( 'Lisa siia teenusepõhine sisu, mis kuvatakse heroe ja infokaartide vahel. Iga teenus võib siia lisada erineva info.', 'okperformance' );
	echo '</p>';

	wp_editor(
		$mid_content,
		'okp_service_mid_content',
		array(
			'textarea_name' => 'okp_service_mid_content',
			'textarea_rows' => 10,
			'media_buttons' => true,
			'teeny'         => false,
		)
	);
}

/**
 * Render the service detail cards meta box.
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function okperformance_service_render_cards_meta_box( $post ) {
	wp_nonce_field( 'okp_service_cards_save', 'okp_service_cards_nonce' );
	$defaults = okperformance_service_card_defaults();

	echo '<p style="margin:0 0 12px;color:#50575e;">';
	echo esc_html__( 'Seadista neli infokaarti, mis kuvatakse teenuse lehel (nt "Kellel sobib?", "Miks valida?"). Jäta pealkiri tühjaks, et see kaart peita.', 'okperformance' );
	echo '</p>';

	echo '<div style="display:grid;gap:16px;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));">';

	for ( $i = 1; $i <= 4; $i++ ) {
		$title = (string) get_post_meta( $post->ID, '_okp_service_card_' . $i . '_title', true );
		$text  = (string) get_post_meta( $post->ID, '_okp_service_card_' . $i . '_text', true );

		echo '<div style="background:#f6f7f7;border:1px solid #dcdcde;border-radius:8px;padding:16px;">';
		echo '<strong style="display:block;margin-bottom:10px;font-size:13px;text-transform:uppercase;letter-spacing:0.04em;color:#646970;">';
		echo esc_html( sprintf( __( 'Kaart %d', 'okperformance' ), $i ) );
		echo '</strong>';

		printf(
			'<p style="margin:0 0 6px;"><label for="okp_service_card_%1$d_title"><strong>%2$s</strong></label></p>',
			(int) $i,
			esc_html__( 'Pealkiri', 'okperformance' )
		);
		printf(
			'<input type="text" class="widefat" id="okp_service_card_%1$d_title" name="okp_service_card_%1$d_title" value="%2$s" placeholder="%3$s" />',
			(int) $i,
			esc_attr( $title ),
			esc_attr( $defaults[ $i - 1 ]['title'] )
		);

		printf(
			'<p style="margin:12px 0 6px;"><label for="okp_service_card_%1$d_text"><strong>%2$s</strong></label></p>',
			(int) $i,
			esc_html__( 'Tekst', 'okperformance' )
		);
		printf(
			'<textarea class="widefat" id="okp_service_card_%1$d_text" name="okp_service_card_%1$d_text" rows="4" placeholder="%3$s">%2$s</textarea>',
			(int) $i,
			esc_textarea( $text ),
			esc_attr( $defaults[ $i - 1 ]['text'] )
		);

		echo '</div>';
	}

	echo '</div>';
}

/**
 * Persist the service cards meta box values.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function okperformance_service_save_cards_meta_box( $post_id ) {
	if ( ! isset( $_POST['okp_service_cards_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['okp_service_cards_nonce'] ) );

	if ( ! wp_verify_nonce( $nonce, 'okp_service_cards_save' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( 'okp_service' !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	for ( $i = 1; $i <= 4; $i++ ) {
		$title_key = 'okp_service_card_' . $i . '_title';
		$text_key  = 'okp_service_card_' . $i . '_text';

		$title_value = isset( $_POST[ $title_key ] )
			? sanitize_text_field( wp_unslash( $_POST[ $title_key ] ) )
			: '';
		$text_value  = isset( $_POST[ $text_key ] )
			? sanitize_textarea_field( wp_unslash( $_POST[ $text_key ] ) )
			: '';

		if ( '' === $title_value ) {
			delete_post_meta( $post_id, '_' . $title_key );
		} else {
			update_post_meta( $post_id, '_' . $title_key, $title_value );
		}

		if ( '' === $text_value ) {
			delete_post_meta( $post_id, '_' . $text_key );
		} else {
			update_post_meta( $post_id, '_' . $text_key, $text_value );
		}
	}
}
add_action( 'save_post_okp_service', 'okperformance_service_save_cards_meta_box' );

/**
 * Persist the per-service mid-content WYSIWYG block.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function okperformance_service_save_mid_content_meta_box( $post_id ) {
	if ( ! isset( $_POST['okp_service_mid_content_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['okp_service_mid_content_nonce'] ) );

	if ( ! wp_verify_nonce( $nonce, 'okp_service_mid_content_save' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( 'okp_service' !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$raw_value = isset( $_POST['okp_service_mid_content'] ) ? wp_unslash( $_POST['okp_service_mid_content'] ) : '';
	$value     = wp_kses_post( $raw_value );

	if ( '' === trim( wp_strip_all_tags( $value ) ) ) {
		delete_post_meta( $post_id, '_okp_service_mid_content' );
	} else {
		update_post_meta( $post_id, '_okp_service_mid_content', $value );
	}
}
add_action( 'save_post_okp_service', 'okperformance_service_save_mid_content_meta_box' );

/**
 * Persist the homepage display meta box values.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function okperformance_service_save_home_display_meta_box( $post_id ) {
	if ( ! isset( $_POST['okp_service_home_display_nonce'] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST['okp_service_home_display_nonce'] ) );

	if ( ! wp_verify_nonce( $nonce, 'okp_service_home_display_save' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( 'okp_service' !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$panel_text = isset( $_POST['okp_service_home_panel_text'] )
		? sanitize_text_field( wp_unslash( $_POST['okp_service_home_panel_text'] ) )
		: '';

	if ( '' === $panel_text ) {
		delete_post_meta( $post_id, '_okp_service_home_panel_text' );
	} else {
		update_post_meta( $post_id, '_okp_service_home_panel_text', $panel_text );

		do_action(
			'wpml_register_single_string',
			'okperformance',
			'Service homepage panel text - ' . $post_id,
			$panel_text
		);
	}

	$feature_text = isset( $_POST['okp_service_home_feature_text'] )
		? sanitize_textarea_field( wp_unslash( $_POST['okp_service_home_feature_text'] ) )
		: '';

	if ( '' === $feature_text ) {
		delete_post_meta( $post_id, '_okp_service_home_feature_text' );
	} else {
		update_post_meta( $post_id, '_okp_service_home_feature_text', $feature_text );

		do_action(
			'wpml_register_single_string',
			'okperformance',
			'Service homepage featured text - ' . $post_id,
			$feature_text
		);
	}
}
add_action( 'save_post_okp_service', 'okperformance_service_save_home_display_meta_box' );

/**
 * Get services for the homepage cards.
 *
 * @param int $limit Max number of services to load.
 * @return WP_Post[]
 */
function okperformance_get_home_services( $limit = 3 ) {
	$limit = (int) $limit;

	if ( -1 === $limit ) {
		$posts_per_page = -1;
	} else {
		$posts_per_page = max( 1, $limit );
	}

	$services = get_posts(
		array(
			'post_type'           => 'okp_service',
			'post_status'         => 'publish',
			'orderby'             => array(
				'menu_order' => 'ASC',
				'date'       => 'DESC',
			),
			'posts_per_page'      => $posts_per_page,
			'no_found_rows'       => true,
			'ignore_sticky_posts' => true,
		)
	);

	return is_array( $services ) ? $services : array();
}
