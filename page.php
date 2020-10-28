<?php get_header('../partials/header-home.php'); ?>
	<div class="container MainWrap">
		<h1><span><?php the_title(); ?></span></h1>
		<div class="row">
			<div class="PageWrap col-md-8">
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="post" id="post-<?php the_ID(); ?>">
						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
						</div>
						<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
					</article>
				<?php endwhile; endif; ?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
