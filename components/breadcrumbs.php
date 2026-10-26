<?php
/**
 * Component: Breadcrumbs.
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
	$args ?? array(),
	array(
		'class' => '',
	)
);

$classes = trim('breadcrumbs text-sm ' . $args['class']);

if (function_exists('yoast_breadcrumb')) {
	yoast_breadcrumb(
		'<nav class="' . esc_attr($classes) . '" aria-label="Breadcrumb">',
		'</nav>'
	);
	return;
}
?>
<nav class="<?php echo esc_attr($classes); ?>" aria-label="Breadcrumb">
	<ol class="flex flex-wrap items-center gap-2">
		<li>
			<a class="hover:text-primary" href="<?php echo esc_url(home_url('/')); ?>">
				<?php esc_html_e('Home', 'websiteni'); ?>
			</a>
		</li>
		<li aria-hidden="true">/</li>
		<li aria-current="page">
			<?php echo esc_html(wp_get_document_title()); ?>
		</li>
	</ol>
</nav>
