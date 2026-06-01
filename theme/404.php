<?php
/**
 * The template for displaying 404 pages.
 *
 * @package OKPerformance
 */

get_header();

$services_url = get_post_type_archive_link( 'okp_service' );
$shop_url     = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : '';

$contact_pages = get_pages(
	array(
		'meta_key'   => '_wp_page_template',
		'meta_value' => 'page-templates/contact.php',
		'number'     => 1,
	)
);
$contact_url = ! empty( $contact_pages ) ? get_permalink( $contact_pages[0] ) : '';

$quick_links = array(
	array(
		'label' => __( 'Teenused', 'okperformance' ),
		'text'  => __( 'Leia sobiv treeningu, testimise või performance teenus.', 'okperformance' ),
		'url'   => $services_url,
	),
	array(
		'label' => __( 'Pood', 'okperformance' ),
		'text'  => __( 'Vaata treeningplaane, programme ja materjale.', 'okperformance' ),
		'url'   => $shop_url,
	),
	array(
		'label' => __( 'Kontakt', 'okperformance' ),
		'text'  => __( 'Kirjuta meile ja aitame sul õige koha leida.', 'okperformance' ),
		'url'   => $contact_url,
	),
);
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-404-page">
	<section class="okp-404-page__section" aria-label="<?php esc_attr_e( 'Page not found', 'okperformance' ); ?>">
		<div class="okp-home__shell okp-404-page__shell">
			<div class="okp-404-page__copy">
				<div class="okp-pill"><?php esc_html_e( '404', 'okperformance' ); ?></div>
				<h1 class="okp-404-page__title"><?php esc_html_e( 'Lehte ei leitud', 'okperformance' ); ?></h1>
				<p class="okp-404-page__lede">
					<?php esc_html_e( 'See aadress ei vii hetkel kuskile. Liigu tagasi avalehele, otsi midagi konkreetset või vali üks kiire suund allpool.', 'okperformance' ); ?>
				</p>

				<div class="okp-404-page__actions">
					<a class="okp-404-page__button okp-404-page__button--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<span><?php esc_html_e( 'Avalehele', 'okperformance' ); ?></span>
						<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<path d="M5 12h14"></path>
							<path d="m13 6 6 6-6 6"></path>
						</svg>
					</a>

					<?php if ( $services_url ) : ?>
						<a class="okp-404-page__button okp-404-page__button--secondary" href="<?php echo esc_url( $services_url ); ?>">
							<?php esc_html_e( 'Vaata teenuseid', 'okperformance' ); ?>
						</a>
					<?php endif; ?>
				</div>
			</div>

			<div class="okp-404-page__panel">
				<div class="okp-404-page__code" aria-hidden="true">404</div>

				<form class="okp-404-page__search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="screen-reader-text" for="okp-404-search"><?php esc_html_e( 'Search for:', 'okperformance' ); ?></label>
					<input
						id="okp-404-search"
						class="okp-404-page__search-field"
						type="search"
						name="s"
						value="<?php echo esc_attr( get_search_query() ); ?>"
						placeholder="<?php esc_attr_e( 'Otsi lehelt', 'okperformance' ); ?>"
					>
					<button class="okp-404-page__search-submit" type="submit" aria-label="<?php esc_attr_e( 'Search', 'okperformance' ); ?>">
						<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
							<circle cx="11" cy="11" r="7"></circle>
							<path d="m16.5 16.5 4 4"></path>
						</svg>
					</button>
				</form>

				<div class="okp-404-page__links" aria-label="<?php esc_attr_e( 'Helpful links', 'okperformance' ); ?>">
					<?php foreach ( $quick_links as $quick_link ) : ?>
						<?php if ( empty( $quick_link['url'] ) ) : ?>
							<?php continue; ?>
						<?php endif; ?>
						<a class="okp-404-page__link-card" href="<?php echo esc_url( $quick_link['url'] ); ?>">
							<span>
								<strong><?php echo esc_html( $quick_link['label'] ); ?></strong>
								<em><?php echo esc_html( $quick_link['text'] ); ?></em>
							</span>
							<svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
								<path d="M9 6l6 6-6 6"></path>
							</svg>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</section>
</main>

<?php
get_footer();
