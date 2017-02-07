<?php 

$blog = get_posts('category_name=Blog');

if ( $blog ) { ?>

<div class="container" id="HomePost">
	<h2><span>Recent News</span></h2>
	<div class="PostWrap">
		<!-- Index Loop -->
		<?php 
		// The Query
		global $query_string;
		query_posts( $query_string . '$category_name=Blog&order=DESC&posts_per_page=1' );
		while ( have_posts() ) : the_post(); ?>
		<!-- post -->
			<article class="post" id="post-<?php the_ID(); ?>">
				<div class="entry">
					<a href="<?php the_permalink();?>" class="PostLink"></a>
					<div class="row">
						<?php if(has_post_thumbnail()) {
							echo '<div class="col-md-3 col-sm-4">';
								the_post_thumbnail('medium');
							echo '</div>';
						} ?>
						<div class="col-md-9 col-sm-8">
							<h3><?php the_title(); ?></h3>
							<?php get_template_part( 'partials/meta', 'index' ); ?>
							<?php custom_excerpt(100); ?>
						</div>
					</div>
				</div>
			</article>
		<?php 
		endwhile; 
		wp_reset_query();
		?>
	</div>
	<div id="VisitOurBlog">
		<a href="<?php bloginfo('url');?>/blog">Visit Our Blog</a>
	</div>
</div>

<?php } ?>