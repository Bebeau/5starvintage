<!-- <a class="prev m-arrow" href="#" data-m-slide="prev" data-carousel="categories"></a>
<a class="next m-arrow" href="#" data-m-slide="next" data-carousel="categories"></a> -->

<!-- the viewport -->
<div class="m-scooch m-scooch-categories">
	<a class="prev m-arrow" href="#" data-m-slide="prev" data-carousel="categories">
		<i class="fa fa-angle-left"></i>
	</a>
	<a class="next m-arrow" href="#" data-m-slide="next" data-carousel="categories">
		<i class="fa fa-angle-right"></i>
	</a>
	<!-- the slider -->
	<div class="m-scooch-inner">
		<?php 
		$catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'exclude' => ''));
		foreach($catTerms as $catTerm) :
			// get the thumbnail id user the term_id
			$thumbnail_id = get_woocommerce_term_meta( $catTerm->term_id, 'thumbnail_id', true );
			// get the image URL
			$image = wp_get_attachment_url( $thumbnail_id );
			?>
			<a href="<?php echo get_term_link($catTerm); ?>" class="m-item">
				<img src="<?php echo $image; ?>" alt="<?php echo $catTerm->name; ?>" />
				<h3><?php echo $catTerm->name; ?></h3>
			</a>
			<!-- Breaks the row and creates a new one every 4th item -->
			<?php 
		endforeach; 
		?>
	</div>
</div>

<div class="home-button">
	<a class="btn btn-main btn-large btn-home" href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
		View All Products
	</a>
	<div id="payment" class="centered">
		we accept <img src="<?php bloginfo('template_directory'); ?>/assets/img/payment.png" alt="Pament Methods" />
	</div>
</div>