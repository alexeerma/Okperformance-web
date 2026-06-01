<?php
/**
 * Template Name: KKK
 * Template Post Type: page
 *
 * @package OKPerformance
 */

get_header();

$okp_home_opts = function_exists( 'okperformance_home_get_options' ) ? okperformance_home_get_options( true ) : array();
?>

<div id="okp-mouse-glow" aria-hidden="true"></div>

<main id="primary" class="site-main okp-faq-page">
	<?php
	get_template_part(
		'template-parts/faq-section',
		null,
		array(
			'context' => 'page',
			'options' => $okp_home_opts,
		)
	);
	?>
</main>

<?php
get_footer();
