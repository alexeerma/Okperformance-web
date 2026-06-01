<?php
/**
 * Shared KKK / FAQ section.
 *
 * @package OKPerformance
 */

$okp_faq_args    = isset( $args ) && is_array( $args ) ? $args : array();
$okp_faq_context = isset( $okp_faq_args['context'] ) ? (string) $okp_faq_args['context'] : 'home';
$okp_faq_opts    = isset( $okp_faq_args['options'] ) && is_array( $okp_faq_args['options'] )
	? $okp_faq_args['options']
	: ( function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array() );

$faq_pill_label = (string) ( $okp_faq_opts['faq_pill_label'] ?? __( 'KKK', 'okperformance' ) );
$faq_title      = (string) ( $okp_faq_opts['faq_title'] ?? __( 'Korduma kippuvad küsimused', 'okperformance' ) );
$faq_lede       = (string) ( $okp_faq_opts['faq_lede'] ?? '' );
$panel_title    = (string) ( $okp_faq_opts['faq_panel_title'] ?? '' );
$panel_text     = (string) ( $okp_faq_opts['faq_panel_text'] ?? '' );
$panel_button_label = (string) ( $okp_faq_opts['faq_panel_button_label'] ?? __( 'Võta ühendust', 'okperformance' ) );
$panel_button_url   = trim( (string) ( $okp_faq_opts['faq_panel_button_url'] ?? '' ) );
$empty_text     = (string) ( $okp_faq_opts['faq_empty_text'] ?? __( 'KKK küsimusi pole veel lisatud.', 'okperformance' ) );
$faq_items      = array();
$is_page        = 'page' === $okp_faq_context;

if ( '' === $panel_button_url ) {
	$contact_pages = get_pages(
		array(
			'meta_key'   => '_wp_page_template',
			'meta_value' => 'page-templates/contact.php',
			'number'     => 1,
		)
	);
	$panel_button_url = ! empty( $contact_pages ) ? get_permalink( $contact_pages[0] ) : home_url( '/contact/' );
}

for ( $faq_index = 1; $faq_index <= 8; $faq_index++ ) {
	$question = trim( (string) ( $okp_faq_opts[ 'faq_item_' . $faq_index . '_question' ] ?? '' ) );
	$answer   = trim( (string) ( $okp_faq_opts[ 'faq_item_' . $faq_index . '_answer' ] ?? '' ) );

	if ( '' === $question ) {
		continue;
	}

	$faq_items[] = array(
		'question' => $question,
		'answer'   => $answer,
	);
}

$section_classes = 'okp-section okp-faq ' . ( $is_page ? 'okp-faq--page' : 'okp-faq--home' );
$section_label   = '' !== $faq_title ? $faq_title : __( 'KKK', 'okperformance' );
?>

<section class="<?php echo esc_attr( $section_classes ); ?>" id="okp-faq" aria-label="<?php echo esc_attr( $section_label ); ?>">
	<div class="okp-home__shell">
		<div class="okp-faq__layout">
			<div class="okp-faq__intro">
				<?php if ( '' !== $faq_pill_label ) : ?>
					<div class="okp-pill"><?php echo esc_html( $faq_pill_label ); ?></div>
				<?php endif; ?>

				<?php if ( '' !== $faq_title ) : ?>
					<?php if ( $is_page ) : ?>
						<h1 class="okp-faq__title"><?php echo esc_html( $faq_title ); ?></h1>
					<?php else : ?>
						<h2 class="okp-faq__title okp-section__title"><?php echo esc_html( $faq_title ); ?></h2>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ( '' !== $faq_lede ) : ?>
					<div class="okp-faq__lede"><?php echo wpautop( wp_kses_post( $faq_lede ) ); ?></div>
				<?php endif; ?>

				<?php if ( '' !== $panel_title || '' !== $panel_text || ( '' !== $panel_button_label && '' !== $panel_button_url ) ) : ?>
					<aside class="okp-faq__panel">
						<?php if ( '' !== $panel_title ) : ?>
							<h3 class="okp-faq__panel-title"><?php echo esc_html( $panel_title ); ?></h3>
						<?php endif; ?>

						<?php if ( '' !== $panel_text ) : ?>
							<div class="okp-faq__panel-text"><?php echo wpautop( wp_kses_post( $panel_text ) ); ?></div>
						<?php endif; ?>

						<?php if ( '' !== $panel_button_label && '' !== $panel_button_url ) : ?>
							<a class="okp-faq__panel-button okp-btn okp-btn--primary" href="<?php echo esc_url( $panel_button_url ); ?>">
								<span><?php echo esc_html( $panel_button_label ); ?></span>
							</a>
						<?php endif; ?>
					</aside>
				<?php endif; ?>
			</div>

			<div class="okp-faq__list">
				<?php if ( ! empty( $faq_items ) ) : ?>
					<?php foreach ( $faq_items as $index => $faq_item ) : ?>
						<details class="okp-faq-item" <?php echo 0 === $index ? 'open' : ''; ?>>
							<summary class="okp-faq-item__summary">
								<span class="okp-faq-item__index"><?php echo esc_html( sprintf( '%02d', $index + 1 ) ); ?></span>
								<span class="okp-faq-item__question"><?php echo esc_html( $faq_item['question'] ); ?></span>
								<span class="okp-faq-item__icon" aria-hidden="true"></span>
							</summary>

							<?php if ( '' !== $faq_item['answer'] ) : ?>
								<div class="okp-faq-item__answer"><?php echo wpautop( wp_kses_post( $faq_item['answer'] ) ); ?></div>
							<?php endif; ?>
						</details>
					<?php endforeach; ?>
				<?php else : ?>
					<div class="okp-products-empty">
						<p><?php echo esc_html( $empty_text ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
