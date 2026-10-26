<?php
/**
 * WebsiteNI Starter Theme
 *
 * Created by WebsiteNI.
 */

defined('ABSPATH') || exit;

$theme_uri = get_template_directory_uri();
$site_name = get_bloginfo('name', 'display');
$custom_logo_id = get_theme_mod('custom_logo');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="WebsiteNI">
	<?php wp_head(); ?>
</head>
<body <?php body_class(apply_filters('websiteni_smooth_scroll_enabled', false) ? 'smooth-scroll' : ''); ?>>
	<?php wp_body_open(); ?>

	<div id="skip-navigation-link">
		<a href="#content">Skip to Main Content</a>
	</div>

	<div id="mobile-navigation" class="navigation-overlay" aria-hidden="true" role="dialog" aria-modal="true" aria-label="Site navigation" tabindex="-1">
		<nav aria-label="Primary navigation">
			<button class="close" type="button" aria-label="Close menu">
				<img src="<?php echo esc_url($theme_uri . '/assets/images/header/close.svg'); ?>" alt="">
			</button>
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary-navigation',
					'menu_class'     => 'primary-menu',
				)
			);
			?>
		</nav>
	</div>

	<div id="smooth-wrapper">
		<div id="smooth-content">
			<div id="wrapper" class="wrapper">
				<div id="wrapper-inner" class="wrapper-inner">
					<header class="navigation">
						<div class="w-full">
							<div class="site-container">
								<div class="grid grid-cols-12 gap-x-5 sm:gap-x-[30px]">
									<div class="companylogo col-span-6 flex items-center justify-start lg:col-span-3">
										<a class="company-logo" href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($site_name); ?>" rel="home">
											<?php if ($custom_logo_id) : ?>
												<?php
												echo wp_get_attachment_image(
													$custom_logo_id,
													'full',
													false,
													array(
														'class' => 'custom-logo',
														'alt'   => $site_name,
													)
												);
												?>
											<?php else : ?>
												<img src="<?php echo esc_url($theme_uri . '/assets/images/header/companylogo.svg'); ?>" alt="<?php echo esc_attr($site_name); ?>">
											<?php endif; ?>
										</a>
									</div>

									<div class="col-span-6 flex items-center justify-end lg:hidden">
										<button class="search-open" type="button" aria-label="Open search">
											<img src="<?php echo esc_url($theme_uri . '/assets/images/header/search.svg'); ?>" alt="">
										</button>
										<button class="hamburger hamburger--slider-r" type="button" aria-label="Open menu" aria-controls="mobile-navigation" aria-expanded="false">
											<span class="hamburger-box"><span class="hamburger-inner"></span></span>
										</button>
									</div>

									<div class="hidden items-center justify-end lg:col-span-8 lg:col-start-5 lg:flex">
										<nav aria-label="Secondary navigation">
											<?php
											wp_nav_menu(
												array(
													'theme_location' => 'secondary-navigation',
													'menu_class'     => 'secondary-menu',
												)
											);
											?>
										</nav>
										<button class="search-open" type="button" aria-label="Open search">
											<img src="<?php echo esc_url($theme_uri . '/assets/images/header/search.svg'); ?>" alt="">
										</button>
									</div>
								</div>
							</div>
						</div>
					</header>
