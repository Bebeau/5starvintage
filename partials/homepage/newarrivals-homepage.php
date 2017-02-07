<!-- <a class="prev m-arrow" href="#" data-m-slide="prev" data-carousel="products"></a>
<a class="next m-arrow" href="#" data-m-slide="next" data-carousel="products"></a> -->

<!-- the viewport -->
<div class="m-scooch m-scooch-products">
	<a class="prev m-arrow" href="#" data-m-slide="prev" data-carousel="products">
		<i class="fa fa-angle-left"></i>
	</a>
	<a class="next m-arrow" href="#" data-m-slide="next" data-carousel="products">
		<i class="fa fa-angle-right"></i>
	</a>
	<!-- the slider -->
	<div class="m-scooch-inner">
		<?php
			$args = array(
				'post_type' => 'product',
				'meta_key' => '_stock_status',  
				'meta_value' => 'instock',
				'orderby' => 'rand',
				'showposts' => 20,
			);
			$loop = new WP_Query( $args );
			if ( $loop->have_posts() ) {													
				while ( $loop->have_posts() ) : $loop->the_post();
					woocommerce_get_template_part( 'content', 'newarrivals' );
				endwhile;
			} else {
				echo '<p class="alert alert-info centered">' . __( 'No products found' ) . '</p>';
			}
			wp_reset_postdata();
		?>
	</div>

</div>

<div class="home-button">
	<a class="btn btn-main btn-large btn-home" href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
		View All Products <i class="icon-double-angle-right"></i>
	</a>
	<div id="payment" class="centered">
		we accept <img src="<?php bloginfo('template_directory'); ?>/assets/img/payment.png" alt="Pament Methods" />
	</div>
</div>