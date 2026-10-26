<?php
/** Flexible Content Layout: Accordion */

defined('ABSPATH') || exit;

$eyebrow = get_sub_field('eyebrow');
$heading = get_sub_field('heading');
$content = get_sub_field('content');
$items   = get_sub_field('items');

if (!$heading && !$content && !$items) {
	return;
}

$section_classes = trim('accordion-section ' . $layout['classes']);
?>
<section
	<?php if ($layout['id']) : ?>id="<?php echo esc_attr($layout['id']); ?>"<?php endif; ?>
	class="<?php echo esc_attr($section_classes); ?>"
>
	<div class="site-container">
		<div class="grid gap-10 lg:grid-cols-12 lg:gap-16">
			<div class="lg:col-span-4">
				<?php get_template_part('components/section-heading', null, array(
					'eyebrow' => $eyebrow,
					'heading' => $heading,
					'content' => $content,
				)); ?>
			</div>

			<?php if ($items) : ?>
				<div class="lg:col-span-8">
					<div class="divide-y divide-grey border-y border-grey">
						<?php foreach ($items as $item) : ?>
							<details class="group py-5">
								<summary class="flex cursor-pointer list-none items-center justify-between gap-6 text-lg font-bold">
									<span><?php echo esc_html($item['question'] ?? ''); ?></span>
									<span class="text-2xl leading-none transition-transform duration-300 group-open:rotate-45" aria-hidden="true">+</span>
								</summary>

								<?php if (!empty($item['answer'])) : ?>
									<div class="content-block__content pt-4 pr-10">
										<?php echo wp_kses_post($item['answer']); ?>
									</div>
								<?php endif; ?>
							</details>
						<?php endforeach; ?>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
