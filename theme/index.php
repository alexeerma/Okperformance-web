<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OKPerformance
 */

get_header();

$okp_home_opts        = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();
$default_blog_title   = (string) ( $okp_home_opts['blog_title'] ?? __( 'Blog', 'okperformance' ) );
$default_blog_lede    = (string) ( $okp_home_opts['blog_lede'] ?? __( 'Articles, updates, and practical guidance to help you train smarter and stay consistent.', 'okperformance' ) );
$blog_card_link_label = (string) ( $okp_home_opts['blog_card_link_label'] ?? __( 'Read article', 'okperformance' ) );
$blog_fallback_text   = (string) ( $okp_home_opts['blog_fallback_text'] ?? __( 'A practical article with clear guidance to support your next step.', 'okperformance' ) );
$blog_empty_text      = (string) ( $okp_home_opts['blog_empty_text'] ?? __( 'No blog posts have been published yet.', 'okperformance' ) );
$posts_page_id        = (int) get_option( 'page_for_posts' );
$blog_archive_title   = $default_blog_title;
$blog_archive_lede    = '';

if ( $posts_page_id ) {
	$blog_archive_title = get_the_title( $posts_page_id ) ?: $default_blog_title;

	$blog_archive_lede = has_excerpt( $posts_page_id )
		? get_the_excerpt( $posts_page_id )
		: wp_strip_all_tags( (string) get_post_field( 'post_content', $posts_page_id ) );
	$blog_archive_lede = trim( preg_replace( '/\s+/', ' ', $blog_archive_lede ) );
	$blog_archive_lede = wp_trim_words( $blog_archive_lede, 28 );
}

if ( '' === $blog_archive_lede && is_home() && ! is_front_page() ) {
	$blog_archive_title = single_post_title( '', false ) ?: $blog_archive_title;
}

$blog_archive_lede = $blog_archive_lede ?: $default_blog_lede;
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-blog-archive">
	<section class="okp-section okp-blog" aria-label="<?php esc_attr_e( 'Blog archive', 'okperformance' ); ?>">
		<div class="okp-home__shell">
			<div class="okp-section__header">
				<div>
					<div class="okp-pill"><?php esc_html_e( 'Latest articles', 'okperformance' ); ?></div>
					<h1 class="okp-section__title"><?php echo esc_html( $blog_archive_title ); ?></h1>
					<p class="okp-section__lede okp-section__lede--small"><?php echo esc_html( $blog_archive_lede ); ?></p>
				</div>
			</div>

			<?php if ( have_posts() ) : ?>
				<div class="okp-blog-grid">
					<?php
					while ( have_posts() ) :
						the_post();

						$post_excerpt = has_excerpt() ? get_the_excerpt() : get_the_content();
						$post_excerpt = wp_trim_words( wp_strip_all_tags( (string) $post_excerpt ), 24 );
						$post_image   = get_the_post_thumbnail(
							get_the_ID(),
							'medium_large',
							array(
								'loading' => 'lazy',
								'alt'     => get_the_title(),
							)
						);
						?>
						<article <?php post_class( 'okp-blog-card' ); ?>>
							<?php if ( $post_image ) : ?>
								<a class="okp-blog-card__image" href="<?php the_permalink(); ?>">
									<?php echo $post_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</a>
							<?php else : ?>
								<div class="okp-blog-card__image okp-blog-card__image--placeholder" aria-hidden="true">
									<span><?php echo esc_html( strtoupper( substr( get_the_title(), 0, 1 ) ) ); ?></span>
								</div>
							<?php endif; ?>

							<div class="okp-blog-card__content">
								<div class="okp-blog-card__meta">
									<span><?php echo esc_html( get_the_date( 'F j, Y' ) ); ?></span>
								</div>
								<h2 class="okp-blog-card__title">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h2>
								<p class="okp-blog-card__text">
									<?php echo esc_html( '' !== $post_excerpt ? $post_excerpt : $blog_fallback_text ); ?>
								</p>
								<a class="okp-blog-card__link" href="<?php the_permalink(); ?>">
									<?php echo esc_html( $blog_card_link_label ); ?>
								</a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>

				<?php
				$pagination_links = paginate_links(
					array(
						'type'      => 'array',
						'prev_text' => __( 'Previous', 'okperformance' ),
						'next_text' => __( 'Next', 'okperformance' ),
					)
				);

				if ( ! empty( $pagination_links ) ) :
					?>
					<nav class="okp-archive-pagination" aria-label="<?php esc_attr_e( 'Blog pagination', 'okperformance' ); ?>">
						<?php foreach ( $pagination_links as $link ) : ?>
							<span class="okp-archive-pagination__item"><?php echo wp_kses_post( $link ); ?></span>
						<?php endforeach; ?>
					</nav>
				<?php endif; ?>
			<?php else : ?>
				<div class="okp-products-empty">
					<p><?php echo esc_html( $blog_empty_text ); ?></p>
				</div>
			<?php endif; ?>
		</div>
	</section>
</main>

<?php
get_footer();
