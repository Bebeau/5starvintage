<?php
/**
 * Template Name: Full Width
 */
?>

<?php get_header('../partials/header-home.php'); ?>
	<div class="container MainWrap">
		<h1><span><?php the_title(); ?></span></h1>
		<div class="PageWrap">
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article class="post" id="post-<?php the_ID(); ?>">
					<div class="entry">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; endif; ?>
		</div>
	</div>
<?php get_footer(); ?>

