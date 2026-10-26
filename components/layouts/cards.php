<?php
/** Flexible Content Layout: Cards */

defined('ABSPATH') || exit;

$eyebrow = get_sub_field('eyebrow');
$heading = get_sub_field('heading');
$content = get_sub_field('content');
$cards   = get_sub_field('cards');
$columns = get_sub_field('columns') ?: '3';

if (!$heading && !$content && !$cards) {
	return;
}

$column_classes = array(
	'2' => 'sm:grid-cols-2',
	'3' => 'sm:grid-cols-2 lg:grid-cols-3',
	'4' => 'sm:grid-cols-2 lg:grid-cols-4',
);

$grid_classes = $column_classes[$columns] ?? $column_classes['3'];
$section_classes = trim('cards-section ' . $layout['classes']);
?>
<section
	<?php if ($layout['id']) : ?>id="<?php echo esc_attr($layout['id']); ?>"<?php endif; ?>
	class="<?php echo esc_attr($section_classes); ?>"
>
	<div class="site-container">
		<?php get_template_part('components/section-heading', null, array(
			'eyebrow' => $eyebrow,
			'heading' => $heading,
			'content' => $content,
		)); ?>

		<?php if ($cards) : ?>
			<div class="mt-10 grid gap-6 <?php echo esc_attr($grid_classes); ?>">
				<?php foreach ($cards as $card) : ?>
					<?php
					$link = $card['link'] ?? array();

					get_template_part('components/card', null, array(
						'image'        => $card['image'] ?? null,
						'eyebrow'      => $card['eyebrow'] ?? '',
						'title'        => $card['title'] ?? '',
						'content'      => $card['content'] ?? '',
						'url'          => $link['url'] ?? '',
						'button_label' => $link['title'] ?? 'View more',
					));
					?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
</section>
