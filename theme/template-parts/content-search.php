<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package OKPerformance
 */

$post_type_object  = get_post_type_object( get_post_type() );
$post_type_label   = $post_type_object ? $post_type_object->labels->singular_name : __( 'Content', 'okperformance' );
$post_excerpt      = wp_trim_words( wp_strip_all_tags( (string) get_the_excerpt() ), 28 );
$post_title        = get_the_title();
$placeholder_label = function_exists( 'mb_substr' ) && function_exists( 'mb_strtoupper' )
	? mb_strtoupper( mb_substr( $post_title, 0, 1 ) )
	: strtoupper( substr( $post_title, 0, 1 ) );
$post_image        = get_the_post_thumbnail(
	get_the_ID(),
	'medium_large',
	array(
		'loading' => 'lazy',
		'alt'     => get_the_title(),
	)
);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'okp-search-card' ); ?>>
	<a class="okp-search-card__media" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
		<?php if ( $post_image ) : ?>
			<?php echo $post_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php else : ?>
			<span aria-hidden="true"><?php echo esc_html( $placeholder_label ); ?></span>
		<?php endif; ?>
	</a>

	<div class="okp-search-card__body">
		<div class="okp-search-card__meta">
			<span><?php echo esc_html( $post_type_label ); ?></span>
			<?php if ( 'post' === get_post_type() ) : ?>
				<span><?php echo esc_html( get_the_date( 'j. M Y' ) ); ?></span>
			<?php endif; ?>
		</div>

		<h2 class="okp-search-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>

		<?php if ( '' !== $post_excerpt ) : ?>
			<p class="okp-search-card__excerpt"><?php echo esc_html( $post_excerpt ); ?></p>
		<?php endif; ?>

		<a class="okp-search-card__link" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Vaata lähemalt', 'okperformance' ); ?>
			<span aria-hidden="true">-&gt;</span>
		</a>
	</div>
</article>
