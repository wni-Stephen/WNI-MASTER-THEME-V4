<?php
/**
 * Component: Image.
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
	$args ?? array(),
	array(
		'image'   => null,
		'size'    => 'large',
		'class'   => '',
		'alt'     => '',
	)
);

$image_id = 0;

if (is_array($args['image']) && !empty($args['image']['ID'])) {
	$image_id = absint($args['image']['ID']);
} elseif (is_numeric($args['image'])) {
	$image_id = absint($args['image']);
}

if (!$image_id) {
	return;
}

$attributes = array(
	'class'   => trim('w-full h-auto ' . $args['class']),
	'loading' => 'eager',
);

if ($args['alt'] !== '') {
	$attributes['alt'] = $args['alt'];
}

echo wp_get_attachment_image(
	$image_id,
	$args['size'],
	false,
	$attributes
);
