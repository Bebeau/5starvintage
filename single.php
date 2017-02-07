<?php get_header('../partials/header-home.php'); ?>
	
	<div class="container MainWrap">

		<h1><span>Blog</span></h1>

		<div class="row">

			<div class="PageWrap col-md-8" id="SinglePage">
				
				<h2><?php the_title(); ?></h2>
				
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article class="post" id="post-<?php the_ID(); ?>">
						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
						</div>
						<?php edit_post_link('Edit this entry.', '<p>', '</p>'); ?>
					</article>
				<?php endwhile; ?>

				<?php else : ?>
					<p class="alert alert-info">
						There are no related posts to this artilce at this time.
					</p>
				<?php endif; ?>
				<?php include(TEMPLATEPATH . '/partials/recent-posts.php'); ?>
				<div class="comments">
					<?php comments_template(); ?>
				</div>
			</div>

			<div class="col-md-4 single clearfix" id="RightSidebar" >
				<?php get_sidebar(); ?>
			</div>

		</div>

	</div>

<?php get_footer(); ?>
