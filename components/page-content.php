<?php
/**
 * Render the current page using the WebsiteNI flexible-content builder,
 * falling back to the WordPress editor when no layouts are configured.
 */

defined('ABSPATH') || exit;

$has_flexible_content = (
	function_exists('have_rows')
	&& have_rows('page_content')
);

if ($has_flexible_content) {
	get_template_part('components/flexible-content');
	return;
}
?>
<div class="site-container page-content-fallback">
	<div class="grid grid-cols-12 gap-x-5 sm:gap-x-[30px]">
		<div class="col-span-12">
			<?php the_content(); ?>
		</div>
	</div>
</div>
