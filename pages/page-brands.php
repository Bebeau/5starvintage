<?php
/**
 * Template Name: Brands Listing
 */
?>

<?php get_header();?>

<section class="container MainWrap" id="BrandListing">

	<article>
		<div class="PageWrap">
			<?php 
			$brandTerms = get_terms('product_brand', array('posts_per_page' => -1, 'hide_empty' => 1, 'orderby' => 'ASC', 'exclude' => ''));
			foreach($brandTerms as $brandTerm) {
				// get the thumbnail id user the term_id
				$thumbnail_id = get_woocommerce_term_meta( $brandTerm->term_id, 'thumbnail_id', true );
				// get the image URL
				$image = wp_get_attachment_url( $thumbnail_id );
				if($image != NULL ) { ?>
					<a href="<?php echo get_term_link($brandTerm); ?>">
						<img src="<?php echo $image; ?>" alt="<?php echo $brandTerm->name; ?>" />
					</a>
					<!-- Breaks the row and creates a new one every 4th item -->
					<?php
				}
			} ?>
		</div>

		<div class="home-button">
			<a class="btn btn-main btn-large btn-home" href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
				View All Products
			</a>
		</div>
	</article>

</section>

<?php get_footer(); ?>