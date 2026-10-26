<?php
/** Navigation and search available until frontend initialisation succeeds. */
defined('ABSPATH') || exit;
?>
<div class="navigation-fallback site-container">
	<details>
		<summary><?php esc_html_e('Menu and search', 'websiteni'); ?></summary>
		<nav aria-label="<?php esc_attr_e('Site navigation', 'websiteni'); ?>">
			<?php
			$menu_item_id = static function ($id) { return $id ? 'fallback-' . $id : ''; };
			add_filter('nav_menu_item_id', $menu_item_id);
			wp_nav_menu(array('theme_location' => 'primary-navigation', 'menu_id' => 'fallback-menu', 'container' => false));
			remove_filter('nav_menu_item_id', $menu_item_id);
			?>
		</nav>
		<?php get_search_form(); ?>
	</details>
</div>
