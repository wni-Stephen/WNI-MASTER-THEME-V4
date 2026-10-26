<?php
/**
 * Theme activation setup.
 *
 * Provides an explicit starter setup action under Tools.
 */

defined('ABSPATH') || exit;

/**
 * Create a Home page and set it as the static front page.
 *
 * Existing front-page settings are left untouched.
 */
function websiteni_theme_activation_setup() {

	/**
	 * Do not overwrite an existing static front page.
	 */
	$current_front_page = absint(get_option('page_on_front'));

	if ($current_front_page) {
		return;
	}

	/**
	 * Look for an existing Home page.
	 */
	$home_page = get_page_by_path(
		'home',
		OBJECT,
		'page'
	);

	/**
	 * Create the Home page if required.
	 */
	if (!$home_page) {

		$home_page_id = wp_insert_post(
			array(
				'post_type'    => 'page',
				'post_title'   => 'Home',
				'post_name'    => 'home',
				'post_content' => '',
				'post_status'  => 'publish',
			),
			true
		);

		if (
			is_wp_error($home_page_id)
			|| !$home_page_id
		) {
			wp_die(esc_html__('The Home page could not be created. Please try again.', 'websiteni'));
		}

	} else {

		if ('publish' !== $home_page->post_status) {
			wp_die(esc_html__('Publish the existing Home page before running starter setup.', 'websiteni'));
		}
		$home_page_id = $home_page->ID;
	}

	/**
	 * Set Home as the static front page.
	 */
	update_option(
		'page_on_front',
		$home_page_id
	);

	update_option(
		'show_on_front',
		'page'
	);
}

add_action('admin_menu', function () {
	add_management_page('Starter Setup', 'Starter Setup', 'manage_options', 'wni-starter-setup', 'websiteni_starter_setup_page');
});

function websiteni_starter_setup_page() {
	if (!current_user_can('manage_options')) return;
	?>
	<div class="wrap">
		<h1>Starter Setup</h1>
		<p>Create or reuse a Home page and make it the static homepage. Existing static homepage assignments are preserved.</p>
		<p>Activating this theme does not change your homepage settings.</p>
		<form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
			<input type="hidden" name="action" value="wni_starter_setup">
			<?php wp_nonce_field('wni_starter_setup'); ?>
			<?php submit_button('Set up homepage'); ?>
		</form>
	</div>
	<?php
}

add_action('admin_post_wni_starter_setup', function () {
	if (!current_user_can('manage_options')) wp_die(esc_html__('You do not have permission to run setup.', 'websiteni'));
	check_admin_referer('wni_starter_setup');
	websiteni_theme_activation_setup();
	wp_safe_redirect(admin_url('options-reading.php'));
	exit;
});
