<?php
/**
 * Theme helper functions.
 */

defined('ABSPATH') || exit;

/**
 * Get a trimmed post excerpt.
 *
 * @param int $limit Number of words to return.
 *
 * @return string
 */
function websiteni_joints_excerpt($limit = 20) {
	$limit = absint($limit);

	if (!$limit) {
		return '';
	}

	$excerpt = get_the_excerpt();
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = wp_strip_all_tags($excerpt);

	return wp_trim_words($excerpt, $limit, '');
}

/**
 * Move the comment field to the bottom of the WordPress comment form.
 *
 * @param array $fields Comment form fields.
 *
 * @return array
 */
function websiteni_joints_comment_form_comment_field_to_bottom($fields) {
	if (empty($fields['comment'])) {
		return $fields;
	}

	$comment_field = $fields['comment'];
	unset($fields['comment']);
	$fields['comment'] = $comment_field;

	return $fields;
}

add_filter(
	'comment_form_fields',
	'websiteni_joints_comment_form_comment_field_to_bottom'
);

/**
 * Get layout settings for the current Flexible Content row.
 *
 * Supports:
 * 1. ACF Extended Flexible Content Settings Modal.
 * 2. A manual ACF Clone field named "layout_options".
 * 3. No layout settings at all.
 *
 * @return array
 */
function websiteni_joints_get_layout_settings() {
	if (
		function_exists('have_settings')
		&& have_settings()
	) {
		$options = array();

		while (have_settings()) {
			the_setting();

			$options = array(
				'section_id'     => get_sub_field('section_id'),
				'background'     => get_sub_field('background'),
				'padding_top'    => get_sub_field('padding_top'),
				'padding_bottom' => get_sub_field('padding_bottom'),
			);
		}

		return $options;
	}

	if (function_exists('get_sub_field')) {
		$options = get_sub_field('layout_options');

		if (is_array($options)) {
			return $options;
		}
	}

	return array();
}

/**
 * Build reusable Tailwind layout attributes from Flexible Content options.
 *
 * Keep complete Tailwind class names in these maps so Tailwind's scanner can
 * detect and generate them during the build.
 *
 * @param array $options Layout settings.
 *
 * @return array
 */
function websiteni_joints_get_layout_options($options = array()) {
	if (!is_array($options)) {
		$options = array();
	}

	$classes = array();

	$backgrounds = array(
		'primary'    => 'bg-primary',
		'secondary'  => 'bg-secondary',
		'tertiary'   => 'bg-tertiary',
		'quaternary' => 'bg-quaternary',
		'quinary'    => 'bg-quinary',
		'senary'     => 'bg-senary',
		'white'      => 'bg-white',
		'black'      => 'bg-black',
	);

	if (
		!empty($options['background'])
		&& isset($backgrounds[$options['background']])
	) {
		$classes[] = $backgrounds[$options['background']];
	}

	$padding_top = array(
		'xsmall' => 'pt-section-xs',
		'small'  => 'pt-section-sm',
		'medium' => 'pt-section-md',
		'large'  => 'pt-section-lg',
		'xlarge' => 'pt-section-xl',
	);

	if (
		!empty($options['padding_top'])
		&& isset($padding_top[$options['padding_top']])
	) {
		$classes[] = $padding_top[$options['padding_top']];
	}

	$padding_bottom = array(
		'xsmall' => 'pb-section-xs',
		'small'  => 'pb-section-sm',
		'medium' => 'pb-section-md',
		'large'  => 'pb-section-lg',
		'xlarge' => 'pb-section-xl',
	);

	if (
		!empty($options['padding_bottom'])
		&& isset($padding_bottom[$options['padding_bottom']])
	) {
		$classes[] = $padding_bottom[$options['padding_bottom']];
	}

	$section_id = '';

	if (!empty($options['section_id'])) {
		$section_id = sanitize_title($options['section_id']);
	}

	return array(
		'id'      => $section_id,
		'classes' => implode(' ', array_unique($classes)),
	);
}
