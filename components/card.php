<?php
/**
 * Component: Card.
 */

defined('ABSPATH') || exit;

$args = wp_parse_args(
	$args ?? array(),
	array(
		'image'         => null,
		'eyebrow'       => '',
		'title'         => '',
		'content'       => '',
		'url'           => '',
		'button_label'  => 'View more',
		'heading_level' => 'h3',
		'class'         => '',
	)
);

if (!$args['image'] && !$args['title'] && !$args['content']) {
	return;
}

$allowed_headings = array('h2', 'h3', 'h4');
$heading_level = in_array($args['heading_level'], $allowed_headings, true)
	? $args['heading_level']
	: 'h3';
?>
<article class="card flex h-full flex-col overflow-hidden border border-grey-light bg-white <?php echo esc_attr($args['class']); ?>">
	<?php if ($args['image']) : ?>
		<div class="card-image overflow-hidden">
			<?php
			get_template_part(
				'components/image',
				null,
				array(
					'image' => $args['image'],
					'size'  => 'large',
					'class' => 'aspect-[16/10] object-cover transition-transform duration-500 hover:scale-[1.03]',
				)
			);
			?>
		</div>
	<?php endif; ?>

	<div class="card-content flex flex-1 flex-col p-6">
		<?php if ($args['eyebrow']) : ?>
			<p class="mb-2 text-sm font-bold uppercase tracking-[0.1em] text-primary">
				<?php echo esc_html($args['eyebrow']); ?>
			</p>
		<?php endif; ?>

		<?php if ($args['title']) : ?>
			<<?php echo esc_attr($heading_level); ?> class="text-2xl">
				<?php echo esc_html($args['title']); ?>
			</<?php echo esc_attr($heading_level); ?>>
		<?php endif; ?>

		<?php if ($args['content']) : ?>
			<div class="content-block__content mt-4">
				<?php echo wp_kses_post($args['content']); ?>
			</div>
		<?php endif; ?>

		<?php if ($args['url']) : ?>
			<div class="mt-auto pt-6">
				<?php
				get_template_part(
					'components/button',
					null,
					array(
						'url'  => $args['url'],
						'text' => $args['button_label'],
					)
				);
				?>
			</div>
		<?php endif; ?>
	</div>
</article>
