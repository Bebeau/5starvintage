<?php
/**
 * Template Name: Woocommerce Page
 */
?>

<?php get_header('../partials/header-home.php'); ?>
	<div class="container MainWrap">
		<!-- <h1><span><?php the_title(); ?></span></h1> -->
		<section>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
				<article class="post" id="post-<?php the_ID(); ?>">
					<div class="entry">
						<?php the_content(); ?>
					</div>
				</article>
			<?php endwhile; endif; ?>
		</section>
	</div>
<?php get_footer(); ?>

