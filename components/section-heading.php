<?php
/**
 * Component: Section Heading.
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
	$args ?? array(),
	array(
		'eyebrow'       => '',
		'heading'       => '',
		'content'       => '',
		'align'         => 'left',
		'heading_level' => 'h2',
		'class'         => '',
	)
);

if (!$args['eyebrow'] && !$args['heading'] && !$args['content']) {
	return;
}

$allowed_headings = array('h2', 'h3', 'h4');
$heading_level = in_array($args['heading_level'], $allowed_headings, true)
	? $args['heading_level']
	: 'h2';

$alignments = array(
	'left'   => 'text-left',
	'center' => 'text-center mx-auto',
);

$classes = trim(
	'section-heading max-w-3xl '
	. ($alignments[$args['align']] ?? $alignments['left'])
	. ' '
	. $args['class']
);
?>
<div class="<?php echo esc_attr($classes); ?>">
	<?php if ($args['eyebrow']) : ?>
		<p class="mb-3 text-sm font-bold uppercase tracking-[0.12em] text-primary">
			<?php echo esc_html($args['eyebrow']); ?>
		</p>
	<?php endif; ?>

	<?php if ($args['heading']) : ?>
		<<?php echo esc_attr($heading_level); ?> class="text-h2">
			<?php echo esc_html($args['heading']); ?>
		</<?php echo esc_attr($heading_level); ?>>
	<?php endif; ?>

	<?php if ($args['content']) : ?>
		<div class="content-block__content mt-5">
			<?php echo wp_kses_post($args['content']); ?>
		</div>
	<?php endif; ?>
</div>
