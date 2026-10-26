<?php
/**
 * Component: Button.
 *
 * @var array $args {
 *     @type string $url    Button URL.
 *     @type string $text   Button label.
 *     @type string $style  primary|secondary|outline|white.
 *     @type string $target Link target.
 *     @type string $class  Additional classes.
 * }
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
	$args ?? array(),
	array(
		'url'    => '',
		'text'   => '',
		'style'  => 'primary',
		'target' => '',
		'class'  => '',
	)
);

if (!$args['url'] || !$args['text']) {
	return;
}

$styles = array(
	'primary'   => 'button',
	'secondary' => 'button button-secondary',
	'outline'   => 'button button-outline',
	'white'     => 'button button-white',
);

$classes = $styles[$args['style']] ?? $styles['primary'];
$classes = trim($classes . ' ' . $args['class']);
$target  = $args['target'] === '_blank' ? '_blank' : '';
$rel     = $target === '_blank' ? 'noopener noreferrer' : '';
?>
<a
	class="<?php echo esc_attr($classes); ?>"
	href="<?php echo esc_url($args['url']); ?>"
	<?php if ($target) : ?>target="<?php echo esc_attr($target); ?>"<?php endif; ?>
	<?php if ($rel) : ?>rel="<?php echo esc_attr($rel); ?>"<?php endif; ?>
>
	<?php echo esc_html($args['text']); ?>
</a>
