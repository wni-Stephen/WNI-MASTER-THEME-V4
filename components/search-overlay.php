<?php
/** Site search overlay, rendered once in the footer. */
defined('ABSPATH') || exit;
?>
<div id="site-search" class="search" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Site search" tabindex="-1">
	<div class="search-inner">
		<div class="search-container">
			<?php get_search_form(); ?>
			<button class="search-close" type="button" aria-label="Close search">
				<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/header/close.svg'); ?>" width="15" height="15" alt="" class="close-icon">
			</button>
		</div>
	</div>
</div>
