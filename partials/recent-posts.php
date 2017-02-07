<?php
	global $post;
	$orig_post = $post;
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>3, // Number of related posts that will be shown.
			'ignore_sticky_posts'=>1,
			'orderby' => 'rand',
			'meta_key' => '_thumbnail_id'
		);
		$my_query = new wp_query( $args );
?>

<div id="related_posts">

	<h3 class="title">Related Posts</h3>

	<div class="row">
		<ul class="thumbnails list-unstyled">
		<?php 
			if( $my_query->have_posts() ) { 
				while( $my_query->have_posts() ) { 
					$my_query->the_post(); ?>
					<li class="col-md-4">
						<a href="<? the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>">
							<span class="imagewrap">
								<?php the_post_thumbnail(); ?>
							</span>
							<h5 class="centered"><?php the_title(); ?></h5>
						</a>
					</li>
				<? } 
			}
			else { ?>
				<p class="alert alert-info">
					There are no related posts to this article at this time.
				</p>
			<?php } } $post = $orig_post; ?>
		</ul>
	</div>

</div>

<?php wp_reset_query(); ?>