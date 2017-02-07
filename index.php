<?php get_header(); ?>

	<div class="container MainWrap">
		
		<h1><span>Blog</span></h1>

		<div class="row" id="BlogListing">

			<div class="PageWrap col-md-8">

				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					<article <?php post_class() ?> id="post-<?php the_ID(); ?>">

						<a href="<?php the_permalink() ?>" class="SingleLink"></a>
						
						<div class="row">

							<?php if( has_post_thumbnail() ) { ?>

								<div class="col-md-4">
									<?php the_post_thumbnail(); ?>
								</div>

								<div class="col-md-8 postcopy">
									<h2>
										<?php the_title(); ?>
									</h2>

									<?php include (TEMPLATEPATH . '/partials/meta.php' ); ?>

									<div class="entry">
										<?php custom_excerpt(75); ?>
									</div>
								</div>

							<?php } else { ?>

								<div class="postcopy col-md-12">
									<h2>
										<?php the_title(); ?>
									</h2>

									<?php include (TEMPLATEPATH . '/partials/meta.php' ); ?>

									<div class="entry">
										<?php custom_excerpt(75); ?>
									</div>
								</div>

							<?php } ?>
							
						</div>

					</article>

				<?php endwhile; ?>

				<?php include (TEMPLATEPATH . '/partials/nav.php' ); ?>

				<?php endif; ?>

			</div>

			<div class="col-md-4" id="RightSidebar">
				<div id="sidebar">
					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Blog Listing Widgets')) : else : ?>
					<?php endif; ?>
				</div>
			</div>

		</div>

	</div>

<?php get_footer(); ?>
