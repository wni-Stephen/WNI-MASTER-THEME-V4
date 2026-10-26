<?php
/** WebsiteNI Starter Theme - Taxonomy archive template. */
defined('ABSPATH') || exit;
get_header();
$term_title = single_term_title('', false);
$term_description = term_description();
?>
<main id="content" class="content">
	<header class="archive-header py-12 lg:py-16">
		<div class="site-container">
			<h1 class="archive-title"><?php echo esc_html($term_title); ?></h1>
			<?php if ($term_description) : ?><div class="archive-description"><?php echo wp_kses_post($term_description); ?></div><?php endif; ?>
		</div>
	</header>
	<section class="archive-content pb-12 lg:pb-16">
		<div class="site-container">
			<?php if (have_posts()) : ?>
				<div class="posts-list">
					<?php while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
							<?php if (has_post_thumbnail()) : ?><a class="post-card-image" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1"><?php the_post_thumbnail('large'); ?></a><?php endif; ?>
							<div class="post-card-content">
								<h2 class="post-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<div class="post-card-excerpt"><?php the_excerpt(); ?></div>
								<a class="button" href="<?php the_permalink(); ?>"><?php esc_html_e('View', 'websiteni'); ?></a>
							</div>
						</article>
					<?php endwhile; ?>
				</div>
				<div class="archive-pagination"><?php the_posts_pagination(array('mid_size' => 2, 'prev_text' => __('Previous', 'websiteni'), 'next_text' => __('Next', 'websiteni'))); ?></div>
			<?php else : ?>
				<div class="archive-empty"><p><?php esc_html_e('No items were found.', 'websiteni'); ?></p></div>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
