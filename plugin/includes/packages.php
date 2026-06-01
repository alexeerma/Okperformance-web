<?php
/**
 * Packages (Paketid) content type and helpers.
 *
 * Packages showcase structured offers for athletes to improve power,
 * performance, and health. They share the same dark/purple OKPerformance
 * design language as Services and follow a similar admin UX so editors can
 * configure them without touching code.
 *
 * @package OKPerformance
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Packages custom post type.
 *
 * @return void
 */
function okperformance_register_packages_post_type() {
	$labels = array(
		'name'                  => _x( 'Paketid', 'post type general name', 'okperformance' ),
		'singular_name'         => _x( 'Pakett', 'post type singular name', 'okperformance' ),
		'menu_name'             => _x( 'Paketid', 'admin menu', 'okperformance' ),
		'name_admin_bar'        => _x( 'Pakett', 'add new on admin bar', 'okperformance' ),
		'add_new'               => _x( 'Lisa uus', 'package', 'okperformance' ),
		'add_new_item'          => __( 'Lisa uus pakett', 'okperformance' ),
		'new_item'              => __( 'Uus pakett', 'okperformance' ),
		'edit_item'             => __( 'Muuda paketti', 'okperformance' ),
		'view_item'             => __( 'Vaata paketti', 'okperformance' ),
		'all_items'             => __( 'Kõik paketid', 'okperformance' ),
		'search_items'          => __( 'Otsi pakette', 'okperformance' ),
		'parent_item_colon'     => __( 'Vanempakett:', 'okperformance' ),
		'not_found'             => __( 'Pakette ei leitud.', 'okperformance' ),
		'not_found_in_trash'    => __( 'Prügikastis pakette ei leitud.', 'okperformance' ),
		'featured_image'        => __( 'Paketi pilt', 'okperformance' ),
		'set_featured_image'    => __( 'Määra paketi pilt', 'okperformance' ),
		'remove_featured_image' => __( 'Eemalda paketi pilt', 'okperformance' ),
		'use_featured_image'    => __( 'Kasuta paketi pildina', 'okperformance' ),
	);

	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'show_in_rest'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'paketid' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 23,
		'menu_icon'          => 'dashicons-awards',
		'supports'           => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' ),
	);

	register_post_type( 'okp_package', $args );
}
add_action( 'init', 'okperformance_register_packages_post_type' );

/**
 * Register a square hero image size for the single package template.
 *
 * @return void
 */
function okperformance_register_package_image_sizes() {
	add_image_size( 'okp_package_hero', 1040, 1040, true );
}
add_action( 'after_setup_theme', 'okperformance_register_package_image_sizes' );

/**
 * Available focus areas for a package.
 *
 * Returned in display order so the admin select and frontend chip render the
 * same labels for editors and visitors.
 *
 * @return array<string, string>
 */
function okperformance_package_focus_choices() {
	return array(
		'power'       => __( 'Jõud', 'okperformance' ),
		'performance' => __( 'Sooritus', 'okperformance' ),
		'health'      => __( 'Tervis', 'okperformance' ),
	);
}

/**
 * Default labels for the package detail cards.
 *
 * @return array<int, array{title: string, text: string}>
 */
function okperformance_package_card_defaults() {
	return array(
		array(
			'title' => __( 'Kellele mõeldud?', 'okperformance' ),
			'text'  => __( 'Kirjelda, kellele pakett on suunatud – sportlase tase, eesmärgid ja vajadused.', 'okperformance' ),
		),
		array(
			'title' => __( 'Mida sisaldab?', 'okperformance' ),
			'text'  => __( 'Loetle paketis sisalduvad treeningplaanid, konsultatsioonid ja materjalid.', 'okperformance' ),
		),
		array(
			'title' => __( 'Oodatavad tulemused', 'okperformance' ),
			'text'  => __( 'Selgita, milliseid mõõdetavaid tulemusi sportlane paketiga saavutab.', 'okperformance' ),
		),
		array(
			'title' => __( 'Lisaboonused', 'okperformance' ),
			'text'  => __( 'Too välja kogukond, järeltugi või lisamaterjalid, mis kuuluvad paketi juurde.', 'okperformance' ),
		),
	);
}

/**
 * Get the configured detail cards for a package post.
 *
 * @param int|WP_Post|null $post Post ID or post object.
 * @return array<int, array{title: string, text: string}>
 */
function okperformance_get_package_cards( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return array();
	}

	$defaults = okperformance_package_card_defaults();
	$cards    = array();

	for ( $i = 1; $i <= 4; $i++ ) {
		$title = (string) get_post_meta( $post->ID, '_okp_package_card_' . $i . '_title', true );
		$text  = (string) get_post_meta( $post->ID, '_okp_package_card_' . $i . '_text', true );

		$cards[] = array(
			'title' => '' !== $title ? $title : $defaults[ $i - 1 ]['title'],
			'text'  => '' !== $text ? $text : $defaults[ $i - 1 ]['text'],
		);
	}

	return $cards;
}

/**
 * Get the package meta values used on the single template.
 *
 * @param int|WP_Post|null $post Post ID or post object.
 * @return array{focus:string, focus_label:string, level:string, duration:string, price:string, cta_url:string, cta_label:string}
 */
function okperformance_get_package_meta( $post = null ) {
	$post = get_post( $post );

	if ( ! $post ) {
		return array(
			'focus'       => '',
			'focus_label' => '',
			'level'       => '',
			'duration'    => '',
			'price'       => '',
			'cta_url'     => '',
			'cta_label'   => '',
		);
	}

	$focus_key = (string) get_post_meta( $post->ID, '_okp_package_focus', true );
	$choices   = okperformance_package_focus_choices();
	$focus_lbl = isset( $choices[ $focus_key ] ) ? $choices[ $focus_key ] : '';

	return array(
		'focus'       => $focus_key,
		'focus_label' => $focus_lbl,
		'level'       => (string) get_post_meta( $post->ID, '_okp_package_level', true ),
		'duration'    => (string) get_post_meta( $post->ID, '_okp_package_duration', true ),
		'price'       => (string) get_post_meta( $post->ID, '_okp_package_price', true ),
		'cta_url'     => (string) get_post_meta( $post->ID, '_okp_package_cta_url', true ),
		'cta_label'   => (string) get_post_meta( $post->ID, '_okp_package_cta_label', true ),
	);
}

/**
 * Register the package meta boxes.
 *
 * @return void
 */
function okperformance_package_register_meta_boxes() {
	add_meta_box(
		'okp_package_details',
		__( 'Paketi andmed', 'okperformance' ),
		'okperformance_package_render_details_meta_box',
		'okp_package',
		'side',
		'high'
	);

	add_meta_box(
		'okp_package_cards',
		__( 'Paketi infokaardid', 'okperformance' ),
		'okperformance_package_render_cards_meta_box',
		'okp_package',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'okperformance_package_register_meta_boxes' );

/**
 * Render the package details meta box (focus, level, duration, price, CTA).
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function okperformance_package_render_details_meta_box( $post ) {
	wp_nonce_field( 'okp_package_details_save', 'okp_package_details_nonce' );

	$focus     = (string) get_post_meta( $post->ID, '_okp_package_focus', true );
	$level     = (string) get_post_meta( $post->ID, '_okp_package_level', true );
	$duration  = (string) get_post_meta( $post->ID, '_okp_package_duration', true );
	$price     = (string) get_post_meta( $post->ID, '_okp_package_price', true );
	$cta_url   = (string) get_post_meta( $post->ID, '_okp_package_cta_url', true );
	$cta_label = (string) get_post_meta( $post->ID, '_okp_package_cta_label', true );

	$choices = okperformance_package_focus_choices();

	echo '<p style="margin-top:0;color:#50575e;">';
	echo esc_html__( 'Lühikesed andmed, mis kuvatakse paketi tutvustusel.', 'okperformance' );
	echo '</p>';

	echo '<p><label for="okp_package_focus"><strong>' . esc_html__( 'Fookus', 'okperformance' ) . '</strong></label></p>';
	echo '<select id="okp_package_focus" name="okp_package_focus" class="widefat">';
	echo '<option value="">' . esc_html__( '— Vali fookus —', 'okperformance' ) . '</option>';
	foreach ( $choices as $value => $label ) {
		printf(
			'<option value="%1$s" %2$s>%3$s</option>',
			esc_attr( $value ),
			selected( $focus, $value, false ),
			esc_html( $label )
		);
	}
	echo '</select>';

	echo '<p><label for="okp_package_level"><strong>' . esc_html__( 'Tase', 'okperformance' ) . '</strong></label></p>';
	printf(
		'<input type="text" id="okp_package_level" name="okp_package_level" class="widefat" value="%1$s" placeholder="%2$s" />',
		esc_attr( $level ),
		esc_attr__( 'Nt. Algaja, Edasijõudnu, Profi', 'okperformance' )
	);

	echo '<p><label for="okp_package_duration"><strong>' . esc_html__( 'Kestus', 'okperformance' ) . '</strong></label></p>';
	printf(
		'<input type="text" id="okp_package_duration" name="okp_package_duration" class="widefat" value="%1$s" placeholder="%2$s" />',
		esc_attr( $duration ),
		esc_attr__( 'Nt. 8 nädalat, 3 kuud', 'okperformance' )
	);

	echo '<p><label for="okp_package_price"><strong>' . esc_html__( 'Hind', 'okperformance' ) . '</strong></label></p>';
	printf(
		'<input type="text" id="okp_package_price" name="okp_package_price" class="widefat" value="%1$s" placeholder="%2$s" />',
		esc_attr( $price ),
		esc_attr__( 'Nt. €299 või Alates €199', 'okperformance' )
	);

	echo '<p style="margin-top:18px;border-top:1px solid #dcdcde;padding-top:14px;">';
	echo '<strong>' . esc_html__( 'Tegevuskutse (CTA)', 'okperformance' ) . '</strong>';
	echo '</p>';

	echo '<p><label for="okp_package_cta_label">' . esc_html__( 'Nupu silt', 'okperformance' ) . '</label></p>';
	printf(
		'<input type="text" id="okp_package_cta_label" name="okp_package_cta_label" class="widefat" value="%1$s" placeholder="%2$s" />',
		esc_attr( $cta_label ),
		esc_attr__( 'Nt. Liitu paketiga', 'okperformance' )
	);

	echo '<p><label for="okp_package_cta_url">' . esc_html__( 'Nupu link', 'okperformance' ) . '</label></p>';
	printf(
		'<input type="url" id="okp_package_cta_url" name="okp_package_cta_url" class="widefat" value="%1$s" placeholder="%2$s" />',
		esc_attr( $cta_url ),
		esc_attr__( 'https://...', 'okperformance' )
	);
}

/**
 * Render the package detail cards meta box.
 *
 * @param WP_Post $post Current post.
 * @return void
 */
function okperformance_package_render_cards_meta_box( $post ) {
	wp_nonce_field( 'okp_package_cards_save', 'okp_package_cards_nonce' );
	$defaults = okperformance_package_card_defaults();

	echo '<p style="margin:0 0 12px;color:#50575e;">';
	echo esc_html__( 'Seadista neli infokaarti, mis kuvatakse paketi lehel. Jäta pealkiri tühjaks, et kaart peita.', 'okperformance' );
	echo '</p>';

	echo '<div style="display:grid;gap:16px;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));">';

	for ( $i = 1; $i <= 4; $i++ ) {
		$title = (string) get_post_meta( $post->ID, '_okp_package_card_' . $i . '_title', true );
		$text  = (string) get_post_meta( $post->ID, '_okp_package_card_' . $i . '_text', true );

		echo '<div style="background:#f6f7f7;border:1px solid #dcdcde;border-radius:8px;padding:16px;">';
		echo '<strong style="display:block;margin-bottom:10px;font-size:13px;text-transform:uppercase;letter-spacing:0.04em;color:#646970;">';
		echo esc_html( sprintf( __( 'Kaart %d', 'okperformance' ), $i ) );
		echo '</strong>';

		printf(
			'<p style="margin:0 0 6px;"><label for="okp_package_card_%1$d_title"><strong>%2$s</strong></label></p>',
			(int) $i,
			esc_html__( 'Pealkiri', 'okperformance' )
		);
		printf(
			'<input type="text" class="widefat" id="okp_package_card_%1$d_title" name="okp_package_card_%1$d_title" value="%2$s" placeholder="%3$s" />',
			(int) $i,
			esc_attr( $title ),
			esc_attr( $defaults[ $i - 1 ]['title'] )
		);

		printf(
			'<p style="margin:12px 0 6px;"><label for="okp_package_card_%1$d_text"><strong>%2$s</strong></label></p>',
			(int) $i,
			esc_html__( 'Tekst', 'okperformance' )
		);
		printf(
			'<textarea class="widefat" id="okp_package_card_%1$d_text" name="okp_package_card_%1$d_text" rows="4" placeholder="%3$s">%2$s</textarea>',
			(int) $i,
			esc_textarea( $text ),
			esc_attr( $defaults[ $i - 1 ]['text'] )
		);

		echo '</div>';
	}

	echo '</div>';
}

/**
 * Persist the package detail meta box values.
 *
 * @param int $post_id Post ID.
 * @return void
 */
function okperformance_package_save_meta_boxes( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( 'okp_package' !== get_post_type( $post_id ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['okp_package_details_nonce'] ) ) {
		$nonce = sanitize_text_field( wp_unslash( $_POST['okp_package_details_nonce'] ) );

		if ( wp_verify_nonce( $nonce, 'okp_package_details_save' ) ) {
			$choices = okperformance_package_focus_choices();

			$focus = isset( $_POST['okp_package_focus'] )
				? sanitize_key( wp_unslash( $_POST['okp_package_focus'] ) )
				: '';

			if ( '' !== $focus && isset( $choices[ $focus ] ) ) {
				update_post_meta( $post_id, '_okp_package_focus', $focus );
			} else {
				delete_post_meta( $post_id, '_okp_package_focus' );
			}

			$text_fields = array(
				'okp_package_level'     => '_okp_package_level',
				'okp_package_duration'  => '_okp_package_duration',
				'okp_package_price'     => '_okp_package_price',
				'okp_package_cta_label' => '_okp_package_cta_label',
			);

			foreach ( $text_fields as $input_key => $meta_key ) {
				$value = isset( $_POST[ $input_key ] )
					? sanitize_text_field( wp_unslash( $_POST[ $input_key ] ) )
					: '';

				if ( '' === $value ) {
					delete_post_meta( $post_id, $meta_key );
				} else {
					update_post_meta( $post_id, $meta_key, $value );
				}
			}

			$cta_url = isset( $_POST['okp_package_cta_url'] )
				? esc_url_raw( wp_unslash( $_POST['okp_package_cta_url'] ) )
				: '';

			if ( '' === $cta_url ) {
				delete_post_meta( $post_id, '_okp_package_cta_url' );
			} else {
				update_post_meta( $post_id, '_okp_package_cta_url', $cta_url );
			}
		}
	}

	if ( isset( $_POST['okp_package_cards_nonce'] ) ) {
		$nonce = sanitize_text_field( wp_unslash( $_POST['okp_package_cards_nonce'] ) );

		if ( wp_verify_nonce( $nonce, 'okp_package_cards_save' ) ) {
			for ( $i = 1; $i <= 4; $i++ ) {
				$title_key = 'okp_package_card_' . $i . '_title';
				$text_key  = 'okp_package_card_' . $i . '_text';

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
	}
}
add_action( 'save_post_okp_package', 'okperformance_package_save_meta_boxes' );

/**
 * Convenience helper for fetching published packages.
 *
 * @param int $limit Max number of packages to load.
 * @return WP_Post[]
 */
function okperformance_get_packages( $limit = -1 ) {
	$limit = (int) $limit;

	if ( -1 === $limit ) {
		$posts_per_page = -1;
	} else {
		$posts_per_page = max( 1, $limit );
	}

	$packages = get_posts(
		array(
			'post_type'           => 'okp_package',
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

	return is_array( $packages ) ? $packages : array();
}
