<!-- List featured products -->
<div class="container mobile-home">
	<h2><span>New Vintage</span></h2>
	<!-- <div class="row"> -->
		<ul class="options list-unstyled products" id="MobileProductListing">
			<?php
				$args = array(
					'post_type' => 'product',
					'meta_key' => '_stock_status',  
					'meta_value' => 'instock',
					'orderby' => 'rand',
					'showposts' => 30,
					);
				
				$loop = new WP_Query( $args );
				
				if ( $loop->have_posts() ) {
					
					while ( $loop->have_posts() ) : $loop->the_post();

						woocommerce_get_template_part( 'content', 'product' );

					endwhile;

				} else {
					echo '<p class="alert alert-info centered">' . __( 'No products found' ) . '</p>';
				}
				wp_reset_postdata();
			?>
		</ul>
	<!-- </div> -->
	<div class="clearfix"></div>
</div>

