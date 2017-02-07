<section id="HomeTabs">
	<div class="container">
		<ul class="nav nav-tabs row">
		  <li class="col-md-4 col-sm-4 active"><a href="#new" data-toggle="tab">New Arrivals</a></li>
		  <li class="col-md-4 col-sm-4"><a href="#categories" data-toggle="tab">Shop By Category</a></li>
		  <li class="col-md-4 col-sm-4"><a href="#brands" data-toggle="tab">Shop By Brand</a></li>
		</ul>
	</div>
</section>
<section id="HomePanes">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="tab-content">
				  	<div class="tab-pane active" id="new">

				  		<div id="myCarousel2" class="carousel slide">
				  			<a id="LeftArrow" class="arrow left" href="#myCarousel2" data-slide="prev"></a>
							<a id="RightArrow" class="arrow right" href="#myCarousel2" data-slide="next"></a>
				  			<!-- Carousel items -->
		  					<div class="carousel-inner">
								<div class="item 1 active">
							  		<div class="row">
										<ul class="options list-unstyled products">
											<?php
												$args = array(
													'post_type' => 'product',
		    										'meta_key' => '_stock_status',  
		    										'meta_value' => 'instock',
		    										'orderby' => 'rand',
		    										'showposts' => 16,
													);
												$counter = 1;
												$group = 2;
												$loop = new WP_Query( $args );
												if ( $loop->have_posts() ) {													
													while ( $loop->have_posts() ) : $loop->the_post();
														woocommerce_get_template_part( 'content', 'product' );
														if ($counter % 4 == 0 && $group < 5) {
															echo '</ul></div></div><div class="item ' . $group++ . '"><div class="row"><ul class="options list-unstyled products">';
														}
														$counter++;
													endwhile;
												} else {
													echo '<p class="alert alert-info centered">' . __( 'No products found' ) . '</p>';
												}
												wp_reset_postdata();
											?>
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
							<span class="viewall">
								<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
									View All Products <i class="icon-double-angle-right"></i>
								</a>
							</span>
						</div>
						
				  	</div>
				  	<div class="tab-pane" id="categories">
					  	<?php $catTerms = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'exclude' => '')); ?>
					  	<div id="CategoriesCarousel" class="carousel slide">
				  			<a id="LeftArrow" class="arrow left" href="#CategoriesCarousel" data-slide="prev"></a>
							<a id="RightArrow" class="arrow right" href="#CategoriesCarousel" data-slide="next"></a>
				  			<!-- Carousel items -->
		  					<div class="carousel-inner">
								<div class="item 1 active">
									<div class="row">
										<ul class="categories list-unstyled options">
											<?php 
											$counter = 1;
											$group = 2;
											?>
											<?php foreach($catTerms as $catTerm) : ?>
											<?php 
												// get the thumbnail id user the term_id
							    				$thumbnail_id = get_woocommerce_term_meta( $catTerm->term_id, 'thumbnail_id', true );
							    				// get the image URL
							    				$image = wp_get_attachment_url( $thumbnail_id );
							    			?>
											<li class="col-md-3 col-sm-3">
												<a href="<?php get_site_url(); echo '/product-category/' . $catTerm->slug; ?>">
													<img src="<?php echo $image; ?>" alt="<?php echo $catTerm->name; ?>" />
													<h3><?php echo $catTerm->name; ?></h3>
												</a>
											</li>
											<!-- Breaks the row and creates a new one every 4th item -->
											<?php if ($counter % 4 == 0 && $group < 5){
												echo '</ul></div></div><div class="item ' . $group++ . '"><div class="row"><ul class="options list-unstyled categories">';
											};?>
											<?php $counter++ ; endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
							<span class="viewall">
								<a href="<?php echo get_bloginfo('url') . '/categories'; ?>">
									View All Categories <i class="icon-double-angle-right"></i>
								</a>
							</span>
						</div>
				  	</div>
				  	<div class="tab-pane" id="brands">
				  		<?php $brandTerms = get_terms('product_brand', array('hide_empty' => 0, 'orderby' => 'ASC', 'exclude' => '')); ?>
						<div id="BrandsCarousel" class="carousel slide">
				  			<a id="LeftArrow" class="arrow left" href="#BrandsCarousel" data-slide="prev"></a>
							<a id="RightArrow" class="arrow right" href="#BrandsCarousel" data-slide="next"></a>
				  			<!-- Carousel items -->
		  					<div class="carousel-inner">
								<div class="item 1 active">
									<div class="row">
										<ul class="list-unstyled options brands">
											<?php 
											$counter = 1;
											$group = 2;
											?>
											<?php foreach($brandTerms as $brandTerm) : ?>
											<?php 
												// get the thumbnail id user the term_id
							    				$thumbnail_id = get_woocommerce_term_meta( $brandTerm->term_id, 'thumbnail_id', true );
							    				// get the image URL
							    				$image = wp_get_attachment_url( $thumbnail_id );
							    			?>
							    			<?php if($image != NULL ) { ?>
												<li class="col-md-3 col-sm-3">
													<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ) . '?filter_product_brand=' . $brandTerm->term_id; ?>">
														<img src="<?php echo $image; ?>" alt="<?php echo $brandTerm->name; ?>" />
														<h3><?php echo $brandTerm->name; ?></h3>
													</a>
												</li>
												<!-- Breaks the row and creates a new one every 4th item -->
												<?php if ($counter % 4 == 0 && $group < 18 ){
													echo '</ul></div></div><div class="item ' . $group++ . '"><div class="row"><ul class="options list-unstyled brands">';
												};?>
											<?php $counter++ ; } endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
							<span class="viewall">
								<a href="<?php echo get_bloginfo('url') . '/brands'; ?>">
									View All Brands <i class="icon-double-angle-right"></i>
								</a>
							</span>
						</div>
				  	</div>
				</div>
			</div>
		</div>
	</div>
</section>