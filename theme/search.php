<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package OKPerformance
 */

get_header();

global $wp_query;
?>

	<main id="primary" class="site-main okp-search-page">
		<section class="okp-section okp-search-results" aria-label="<?php esc_attr_e( 'Search results', 'okperformance' ); ?>">
			<div class="okp-home__shell">
				<header class="okp-section__header okp-search-results__header">
					<div>
						<div class="okp-pill"><?php esc_html_e( 'Otsing', 'okperformance' ); ?></div>
						<h1 class="okp-section__title"><?php esc_html_e( 'Otsingu tulemused', 'okperformance' ); ?></h1>
						<p class="okp-section__lede okp-section__lede--small">
							<?php
							printf(
								/* translators: 1: search query, 2: number of search results. */
								esc_html( _n( 'Leidsime päringule "%1$s" %2$s tulemuse.', 'Leidsime päringule "%1$s" %2$s tulemust.', (int) $wp_query->found_posts, 'okperformance' ) ),
								esc_html( get_search_query() ),
								esc_html( number_format_i18n( (int) $wp_query->found_posts ) )
							);
							?>
						</p>
					</div>
				</header>

				<form class="okp-search-results__form" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="screen-reader-text" for="okp-search-results-field"><?php esc_html_e( 'Search for:', 'okperformance' ); ?></label>
					<input
						id="okp-search-results-field"
						class="okp-search-results__field"
						type="search"
						name="s"
						value="<?php echo esc_attr( get_search_query() ); ?>"
						placeholder="<?php esc_attr_e( 'Otsi lehelt...', 'okperformance' ); ?>"
					>
					<button class="okp-search-results__submit" type="submit">
						<?php esc_html_e( 'Otsi', 'okperformance' ); ?>
					</button>
				</form>

				<?php if ( have_posts() ) : ?>
					<div class="okp-search-results__list">
					<?php
					while ( have_posts() ) :
						the_post();

						get_template_part( 'template-parts/content', 'search' );

					endwhile;
					?>
					</div>

					<?php
					$pagination_links = paginate_links(
						array(
							'type'      => 'array',
							'prev_text' => __( 'Eelmine', 'okperformance' ),
							'next_text' => __( 'Järgmine', 'okperformance' ),
						)
					);

					if ( ! empty( $pagination_links ) ) :
						?>
						<nav class="okp-archive-pagination" aria-label="<?php esc_attr_e( 'Search results pagination', 'okperformance' ); ?>">
							<?php foreach ( $pagination_links as $link ) : ?>
								<span class="okp-archive-pagination__item"><?php echo wp_kses_post( $link ); ?></span>
							<?php endforeach; ?>
						</nav>
					<?php endif; ?>
				<?php else : ?>
					<div class="okp-search-results__empty">
						<h2><?php esc_html_e( 'Tulemusi ei leitud', 'okperformance' ); ?></h2>
						<p><?php esc_html_e( 'Proovi teist märksõna või lühemat otsingut.', 'okperformance' ); ?></p>
					</div>
				<?php endif; ?>
			</div>
		</section>
	</main>

<?php
get_footer();
