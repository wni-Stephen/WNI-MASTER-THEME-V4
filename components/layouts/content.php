<?php
/** Flexible Content Layout: Content */

defined('ABSPATH') || exit;

$heading = get_sub_field('heading');
$content = get_sub_field('content');
$section_classes = trim('content-block ' . $layout['classes']);

if (!$heading && !$content) {
	return;
}
?>
<section
	<?php if ($layout['id']) : ?>
		id="<?php echo esc_attr($layout['id']); ?>"
	<?php endif; ?>
	class="<?php echo esc_attr($section_classes); ?>"
>
	<div class="site-container">
		<div class="grid grid-cols-12 gap-x-5 md:gap-x-[30px]">
			<div class="col-span-12 lg:col-span-8 lg:col-start-3">
				<?php if ($heading) : ?><h2><?php echo esc_html($heading); ?></h2><?php endif; ?>
				<?php if ($content) : ?><div class="content-block__content"><?php echo wp_kses_post($content); ?></div><?php endif; ?>
			</div>
		</div>
	</div>
</section>
