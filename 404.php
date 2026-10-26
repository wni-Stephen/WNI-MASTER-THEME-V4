<?php
/** WebsiteNI Starter Theme - 404 template. */
defined('ABSPATH') || exit;
get_header();
?>
<main id="content" class="content">
	<section class="error-404">
		<div class="site-container">
			<div class="grid grid-cols-12 gap-x-5 sm:gap-x-[30px]">
				<div class="col-span-12">
					<div class="error-404-content text-center">
						<h1 class="error-404-title"><?php esc_html_e('Oops! Page not found.', 'websiteni'); ?></h1>
						<p class="error-404-text"><?php esc_html_e('Sorry, the page you are looking for doesn’t exist or may have been moved.', 'websiteni'); ?></p>
						<a class="button error-404-button" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Return Home', 'websiteni'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</section>
</main>
<?php get_footer(); ?>
