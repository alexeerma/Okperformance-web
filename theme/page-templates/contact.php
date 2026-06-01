<?php
/**
 * Template Name: Contact
 * Template Post Type: page
 *
 * @package OKPerformance
 */

get_header();

$okp_home_opts = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();

$contact_details_title = (string) ( $okp_home_opts['contact_details_title'] ?? __( 'Kontaktandmed', 'okperformance' ) );
$company_details_title = (string) ( $okp_home_opts['contact_company_title'] ?? __( 'Ettevõtte andmed', 'okperformance' ) );
$form_title            = (string) ( $okp_home_opts['contact_form_title'] ?? __( 'Saada sõnum', 'okperformance' ) );
$form_shortcode        = trim( (string) ( $okp_home_opts['contact_form_shortcode'] ?? '' ) );
$form_empty_text       = (string) ( $okp_home_opts['contact_form_empty_text'] ?? __( 'Lisa Contact Form 7 shortcode Page Options > Contact vahelehel.', 'okperformance' ) );

$contact_items = array(
	array(
		'icon'  => '<path d="M12 21s7-5.2 7-11a7 7 0 0 0-14 0c0 5.8 7 11 7 11z"></path><circle cx="12" cy="10" r="2.4"></circle>',
		'label' => (string) ( $okp_home_opts['contact_location_label'] ?? __( 'Asukoht', 'okperformance' ) ),
		'text'  => (string) ( $okp_home_opts['contact_location_text'] ?? __( 'Tartu + Tallinn', 'okperformance' ) ),
	),
	array(
		'icon'  => '<path d="M4 6h16v12H4z"></path><path d="m4 7 8 6 8-6"></path>',
		'label' => (string) ( $okp_home_opts['contact_email_label'] ?? __( 'E-post', 'okperformance' ) ),
		'text'  => (string) ( $okp_home_opts['contact_email_text'] ?? 'info@rasmuskala.ee' ),
	),
	array(
		'icon'  => '<path d="M7.5 4.5 10 7l-1.7 2.2a12.3 12.3 0 0 0 6.5 6.5L17 14l2.5 2.5-1.2 3a2 2 0 0 1-2.2 1.2A15.7 15.7 0 0 1 3.3 7.9a2 2 0 0 1 1.2-2.2l3-1.2z"></path>',
		'label' => (string) ( $okp_home_opts['contact_phone_label'] ?? __( 'Telefon', 'okperformance' ) ),
		'text'  => (string) ( $okp_home_opts['contact_phone_text'] ?? '+372 569 24511' ),
	),
);

$company_items = array(
	array(
		'icon'  => '<path d="M6 21V5a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v16"></path><path d="M4 21h16"></path><path d="M9 7h1"></path><path d="M14 7h1"></path><path d="M9 11h1"></path><path d="M14 11h1"></path><path d="M9 15h6"></path>',
		'label' => (string) ( $okp_home_opts['contact_company_1_label'] ?? 'Rasmus Kala' ),
		'text'  => (string) ( $okp_home_opts['contact_company_1_text'] ?? '' ),
	),
	array(
		'icon'  => '<rect x="4" y="6" width="16" height="12" rx="2"></rect><path d="M4 10h16"></path>',
		'label' => (string) ( $okp_home_opts['contact_company_2_label'] ?? 'LHV Pank' ),
		'text'  => (string) ( $okp_home_opts['contact_company_2_text'] ?? '' ),
	),
);
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-contact-page">
	
	<section class="okp-contact-page__section" aria-label="<?php esc_attr_e( 'Contact', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-contact-page__layout">
				<div class="okp-contact-page__details">
					<div class="okp-contact-page__columns">
						<section class="okp-contact-page__group" aria-labelledby="okp-contact-details-title">
							<?php if ( '' !== $contact_details_title ) : ?>
								<h2 id="okp-contact-details-title" class="okp-contact-page__group-title"><?php echo esc_html( $contact_details_title ); ?></h2>
							<?php endif; ?>

							<div class="okp-contact-page__item-list">
								<?php foreach ( $contact_items as $item ) : ?>
									<?php if ( '' === $item['label'] && '' === $item['text'] ) : ?>
										<?php continue; ?>
									<?php endif; ?>
									<div class="okp-contact-page__item">
										<span class="okp-contact-page__item-icon" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" focusable="false">
												<?php echo $item['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</svg>
										</span>
										<span class="okp-contact-page__item-content">
											<?php if ( '' !== $item['label'] ) : ?>
												<strong><?php echo esc_html( $item['label'] ); ?></strong>
											<?php endif; ?>
											<?php if ( '' !== $item['text'] ) : ?>
												<span><?php echo nl2br( esc_html( $item['text'] ) ); ?></span>
											<?php endif; ?>
										</span>
									</div>
								<?php endforeach; ?>
							</div>
						</section>

						<section class="okp-contact-page__group" aria-labelledby="okp-company-details-title">
							<?php if ( '' !== $company_details_title ) : ?>
								<h2 id="okp-company-details-title" class="okp-contact-page__group-title"><?php echo esc_html( $company_details_title ); ?></h2>
							<?php endif; ?>

							<div class="okp-contact-page__item-list">
								<?php foreach ( $company_items as $item ) : ?>
									<?php if ( '' === $item['label'] && '' === $item['text'] ) : ?>
										<?php continue; ?>
									<?php endif; ?>
									<div class="okp-contact-page__item">
										<span class="okp-contact-page__item-icon" aria-hidden="true">
											<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" focusable="false">
												<?php echo $item['icon']; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
											</svg>
										</span>
										<span class="okp-contact-page__item-content">
											<?php if ( '' !== $item['label'] ) : ?>
												<strong><?php echo esc_html( $item['label'] ); ?></strong>
											<?php endif; ?>
											<?php if ( '' !== $item['text'] ) : ?>
												<span><?php echo nl2br( esc_html( $item['text'] ) ); ?></span>
											<?php endif; ?>
										</span>
									</div>
								<?php endforeach; ?>
							</div>
						</section>
					</div>

					
				</div>

				<section class="okp-contact-page__form-panel" aria-label="<?php esc_attr_e( 'Contact form', 'okperformance' ); ?>">
					<?php if ( '' !== $form_title ) : ?>
						<h2 class="okp-contact-page__form-title"><?php echo esc_html( $form_title ); ?></h2>
					<?php endif; ?>

					<?php if ( '' !== $form_shortcode ) : ?>
						<div class="okp-contact-page__form">
							<?php echo do_shortcode( $form_shortcode ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						</div>
					<?php elseif ( '' !== $form_empty_text ) : ?>
						<div class="okp-contact-page__form-empty">
							<p><?php echo esc_html( $form_empty_text ); ?></p>
						</div>
					<?php endif; ?>
				</section>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
