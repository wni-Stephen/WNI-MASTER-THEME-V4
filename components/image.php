<?php
/** Component: Image. Optional loading and fetchpriority overrides; null uses WordPress defaults. */
defined('ABSPATH') || exit;

$args = wp_parse_args($args ?? array(), array(
	'image' => null,
	'size' => 'large',
	'class' => '',
	'alt' => null,
	'loading' => null,
	'fetchpriority' => null,
));
$attributes = array('class' => trim('w-full h-auto ' . $args['class']));
foreach (array('alt', 'loading', 'fetchpriority') as $attribute) {
	if ($args[$attribute] !== null) $attributes[$attribute] = $args[$attribute];
}

echo websiteni_get_image($args['image'], $args['size'], $attributes);
