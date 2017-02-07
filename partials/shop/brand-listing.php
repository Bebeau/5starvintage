<!-- the viewport -->
<div class="m-scooch m-scooch-shop-brands">
	<a class="prev m-arrow" href="#" data-m-slide="prev" data-carousel="shop-brands">
		<i class="fa fa-angle-left"></i>
	</a>
	<a class="next m-arrow" href="#" data-m-slide="next" data-carousel="shop-brands">
		<i class="fa fa-angle-right"></i>
	</a>

	<!-- the slider -->
	<div class="m-scooch-inner">
		<?php 
		$args = array(
			'hide_empty' => 0, 
			'orderby' => 'DESC', 
			'exclude' => ''
		);
		$brandTerms = get_terms('product_brand', $args);
		foreach($brandTerms as $brand) {
			// get the thumbnail id user the term_id
			$thumbnail_id = get_woocommerce_term_meta( $brand->term_id, 'thumbnail_id', true );
			// get the image URL
			$image = wp_get_attachment_url( $thumbnail_id );
			if($image != NULL ) { 
				$brandID = get_term_link( $brand );
				?>
				<a class="m-item" href="<?php echo $brandID; ?>">
					<img src="<?php echo $image; ?>" alt="<?php echo $brand->name; ?>" />
				</a>
				<!-- Breaks the row and creates a new one every 4th item -->
				<?php
			}
		} ?>
	</div>

</div>