<?php
/** Reusable search form. */
defined('ABSPATH') || exit;
$search_id = wp_unique_id('search-input-');
?>
<form class="search-form" role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>">
	<label class="sr-only" for="<?php echo esc_attr($search_id); ?>">Search the website</label>
	<input id="<?php echo esc_attr($search_id); ?>" class="search-input" name="s" type="search" placeholder="Enter Type..." value="<?php echo esc_attr(get_search_query()); ?>" autocomplete="off">
</form>
