<?php
/**
 * WebsiteNI Starter Theme
 * Footer.
 */
defined('ABSPATH') || exit;

$site_name = get_bloginfo('name', 'display');
$custom_logo_id = get_theme_mod('custom_logo');
$company_name = function_exists('get_field') ? get_field('company_name', 'option') : '';
$company_address = function_exists('get_field') ? get_field('company_address', 'option') : '';
$company_phone = function_exists('get_field') ? get_field('company_phone', 'option') : '';
$company_email = function_exists('get_field') ? get_field('company_email', 'option') : '';

if (!$company_name) {
	$company_name = $site_name;
}

$company_phone_href = preg_replace('/[^0-9+]/', '', $company_phone);
$privacy_policy_url = get_privacy_policy_url();
$terms_page = get_page_by_path('terms-and-conditions');
$terms_url = $terms_page ? get_permalink($terms_page) : '';
?>
<footer class="footer bg-primary">
	<div class="site-container">
		<div class="grid grid-cols-12 gap-x-5 sm:gap-x-[30px] footer-main">
			<div class="footer-company col-span-12 sm:col-span-6 lg:col-span-4">
				<div class="footer-logo">
					<a class="company-logo" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>" rel="home">
						<?php if ($custom_logo_id) : ?>
							<?php echo wp_get_attachment_image($custom_logo_id, 'full', false, array('class' => 'custom-logo', 'alt' => $site_name)); ?>
						<?php else : ?>
							<img src="<?php echo esc_url(get_template_directory_uri() . '/assets/images/header/companylogo.svg'); ?>" class="default-logo" width="143" height="20" alt="<?php echo esc_attr($site_name); ?>">
						<?php endif; ?>
					</a>
				</div>

				<div class="footer-contact">
					<?php if ($company_address) : ?>
						<p class="footer-address"><?php echo wp_kses_post(nl2br(esc_html($company_address))); ?></p>
					<?php endif; ?>
					<?php if ($company_email) : ?>
						<p class="footer-email">Email: <a href="mailto:<?php echo esc_attr($company_email); ?>"><?php echo esc_html($company_email); ?></a></p>
					<?php endif; ?>
					<?php if ($company_phone) : ?>
						<p class="footer-phone">Phone: <a href="tel:<?php echo esc_attr($company_phone_href); ?>"><?php echo esc_html($company_phone); ?></a></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

	<div class="sub-footer bg-secondary w-full">
		<div class="site-container">
			<div class="sub-footer-inner flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
				<div class="footer-left w-full lg:w-auto">
					<div class="footer-mobile-company lg:hidden">
						<p>&copy; <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html($company_name); ?></p>
					</div>
					<div class="footer-links flex flex-wrap gap-4">
						<span class="hidden lg:inline">&copy; <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html($company_name); ?></span>
						<?php if ($privacy_policy_url) : ?><a href="<?php echo esc_url($privacy_policy_url); ?>">Privacy Policy</a><?php endif; ?>
						<?php if ($terms_url) : ?><a href="<?php echo esc_url($terms_url); ?>">Terms &amp; Conditions</a><?php endif; ?>
						<p class="footer-credit-mobile lg:hidden">Created by <a href="https://www.websiteni.com" target="_blank" rel="noopener noreferrer">WebsiteNI</a></p>
					</div>
				</div>
				<div class="footer-right hidden lg:block">Created by <a href="https://www.websiteni.com" target="_blank" rel="noopener noreferrer">WebsiteNI</a></div>
			</div>
		</div>
	</div>
</footer>
</div><!-- #wrapper-inner -->
</div><!-- #wrapper -->
</div><!-- #smooth-content -->
</div><!-- #smooth-wrapper -->

<?php get_template_part('components/search-overlay'); ?>
<?php wp_footer(); ?>
</body>
</html>
