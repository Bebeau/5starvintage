<!-- the viewport -->
<div class="m-scooch m-scooch-brands">
	<a class="prev m-arrow" href="#" data-m-slide="prev" data-carousel="brands">
		<i class="fa fa-angle-left"></i>
	</a>
	<a class="next m-arrow" href="#" data-m-slide="next" data-carousel="brands">
		<i class="fa fa-angle-right"></i>
	</a>
	<!-- the slider -->
	<div class="m-scooch-inner">
		<?php 
		$brandTerms = get_terms('product_brand', array('hide_empty' => 0, 'orderby' => 'ASC', 'exclude' => ''));
		foreach($brandTerms as $brandTerm) {
			// get the thumbnail id user the term_id
			$thumbnail_id = get_woocommerce_term_meta( $brandTerm->term_id, 'thumbnail_id', true );
			// get the image URL
			$image = wp_get_attachment_url( $thumbnail_id );
			if($image != NULL ) { ?>
				<a class="m-item" href="<?php echo get_term_link($brandTerm); ?>">
					<img src="<?php echo $image; ?>" alt="<?php echo $brandTerm->name; ?>" />
				</a>
				<!-- Breaks the row and creates a new one every 4th item -->
				<?php
			}
		} ?>
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