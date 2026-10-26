<?php
/** Flexible Content Layout: CTA */

defined('ABSPATH') || exit;

$eyebrow          = get_sub_field('eyebrow');
$heading          = get_sub_field('heading');
$content          = get_sub_field('content');
$primary_button   = get_sub_field('primary_button');
$secondary_button = get_sub_field('secondary_button');
$alignment        = get_sub_field('alignment') ?: 'center';

if (!$heading && !$content) {
	return;
}

$section_classes = trim('cta ' . $layout['classes']);
$alignment_classes = $alignment === 'left'
	? 'items-start text-left'
	: 'items-center text-center';
?>
<section
	<?php if ($layout['id']) : ?>id="<?php echo esc_attr($layout['id']); ?>"<?php endif; ?>
	class="<?php echo esc_attr($section_classes); ?>"
>
	<div class="site-container">
		<div class="mx-auto flex max-w-4xl flex-col <?php echo esc_attr($alignment_classes); ?>">
			<?php get_template_part('components/section-heading', null, array(
				'eyebrow' => $eyebrow,
				'heading' => $heading,
				'content' => $content,
				'align'   => $alignment,
			)); ?>

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
	</div>
</section>
