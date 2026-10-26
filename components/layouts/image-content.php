<?php
/** Flexible Content Layout: Image + Content */

defined('ABSPATH') || exit;

$eyebrow        = get_sub_field('eyebrow');
$heading        = get_sub_field('heading');
$content        = get_sub_field('content');
$image          = get_sub_field('image');
$button         = get_sub_field('button');
$image_position = get_sub_field('image_position') ?: 'left';

if (!$heading && !$content && !$image) {
	return;
}

$section_classes = trim('image-content ' . $layout['classes']);
$image_order     = $image_position === 'right' ? 'lg:order-2' : '';
$content_order   = $image_position === 'right' ? 'lg:order-1' : '';
?>
<section
	<?php if ($layout['id']) : ?>id="<?php echo esc_attr($layout['id']); ?>"<?php endif; ?>
	class="<?php echo esc_attr($section_classes); ?>"
>
	<div class="site-container">
		<div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
			<?php if ($image) : ?>
				<div class="<?php echo esc_attr($image_order); ?>">
					<?php get_template_part('components/image', null, array(
						'image' => $image,
						'size'  => 'large',
						'class' => 'aspect-[4/3] object-cover',
					)); ?>
				</div>
			<?php endif; ?>

			<div class="<?php echo esc_attr($content_order); ?>">
				<?php get_template_part('components/section-heading', null, array(
					'eyebrow' => $eyebrow,
					'heading' => $heading,
					'content' => $content,
				)); ?>

				<?php if ($button) : ?>
					<div class="mt-8">
						<?php get_template_part('components/button', null, array(
							'url'    => $button['url'] ?? '',
							'text'   => $button['title'] ?? '',
							'target' => $button['target'] ?? '',
						)); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
