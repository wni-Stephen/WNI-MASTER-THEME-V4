<?php
/** Flexible Content Layout: Hero */

defined('ABSPATH') || exit;

$eyebrow          = get_sub_field('eyebrow');
$heading          = get_sub_field('heading');
$content          = get_sub_field('content');
$image            = get_sub_field('image');
$primary_button   = get_sub_field('primary_button');
$secondary_button = get_sub_field('secondary_button');
$image_position   = get_sub_field('image_position') ?: 'right';

if (!$heading && !$content && !$image) {
	return;
}

$section_classes = trim('hero ' . $layout['classes']);
$content_order   = $image_position === 'left' ? 'lg:order-2' : '';
$image_order     = $image_position === 'left' ? 'lg:order-1' : '';
?>
<section
	<?php if ($layout['id']) : ?>id="<?php echo esc_attr($layout['id']); ?>"<?php endif; ?>
	class="<?php echo esc_attr($section_classes); ?>"
>
	<div class="site-container">
		<div class="grid items-center gap-10 lg:grid-cols-2 lg:gap-16">
			<div class="<?php echo esc_attr($content_order); ?>">
				<?php if ($eyebrow) : ?>
					<p class="mb-4 text-sm font-bold uppercase tracking-[0.12em] text-primary">
						<?php echo esc_html($eyebrow); ?>
					</p>
				<?php endif; ?>

				<?php if ($heading) : ?>
					<h1 class="text-h1"><?php echo esc_html($heading); ?></h1>
				<?php endif; ?>

				<?php if ($content) : ?>
					<div class="content-block__content mt-6 max-w-2xl">
						<?php echo wp_kses_post($content); ?>
					</div>
				<?php endif; ?>

				<?php if ($primary_button || $secondary_button) : ?>
					<div class="mt-8 flex flex-wrap gap-4">
						<?php if ($primary_button) : ?>
							<?php get_template_part('components/button', null, array(
								'url'    => $primary_button['url'] ?? '',
								'text'   => $primary_button['title'] ?? '',
								'target' => $primary_button['target'] ?? '',
							)); ?>
						<?php endif; ?>

						<?php if ($secondary_button) : ?>
							<?php get_template_part('components/button', null, array(
								'url'    => $secondary_button['url'] ?? '',
								'text'   => $secondary_button['title'] ?? '',
								'target' => $secondary_button['target'] ?? '',
								'style'  => 'outline',
							)); ?>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			</div>

			<?php if ($image) : ?>
				<div class="<?php echo esc_attr($image_order); ?>">
					<?php get_template_part('components/image', null, array(
						'image'   => $image,
						'size'    => 'full',
						'class'   => 'aspect-[4/3] object-cover',
						'loading' => 'eager',
					)); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
