<?php

/**
 * Template Name: Buy Back Program
 */

get_header(); ?>

<div id="BuyBack">

	<section id="Intro">

		<div class="outer">
			<div class="inner">

				<div class="container">

					<div class="row">
						<div class="col-md-12">

							<article class="header">
								<h1> Welcome To 5 Star Vintage Swap!</h1>
								<p class="desc">Trade in your old vintage clohting and we’ll send you new vintage clothing from our stock.</p>
							</article>
							
							<img class="visuals" src="<?php bloginfo('template_directory');?>/assets/img/swap.png" alt="" />

							<a href="#" class="request">Request A Shipping Label</a>

						</div>
					</div>

				</div>

			</div>
		</div>

	</section>

	<section id="HowItWorks">

		<div class="outer">
			<div class="inner">

				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div id="Products">
								<ul class="items">
									<li>
										<div class="outer">
											<div class="inner">
												<img src="<?php bloginfo('template_directory');?>/assets/img/item1.jpg" alt="" />
											</div>
										</div>
									</li>
									<li>
										<div class="outer">
											<div class="inner">
												<img src="<?php bloginfo('template_directory');?>/assets/img/item2.jpg" alt="" />
											</div>
										</div>
									</li>
									<li>
										<div class="outer">
											<div class="inner">
												<img src="<?php bloginfo('template_directory');?>/assets/img/item3.jpg" alt="" />
											</div>
										</div>
									</li>
								</ul>
								<div class="product">
									<?php
										$args = array(
											'post_type' => 'product',
											'meta_key' => '_stock_status',  
											'meta_value' => 'instock',
											'orderby' => 'rand',
											'showposts' => 1,
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
						</div>
						<div class="col-md-6 description">
							<div class="outer">
								<div class="inner">
									<h2>Here's how it works..</h2>
									<p class="desc">Simply print a label and ship, we take care of the rest. For every 3 items that you send in, we'll send you 1 new vintage item.</p>
									<a href="#" class="request">Request A Shipping Label</a>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

	</section>

	<section id="Looking">
		<div class="outer">
			<div class="inner">
				<h2>Here's what we're looking for..</h2>
				<p class="desc">The brands listed below are the primary brands that we deal with. Sending in these brands will give you a better trade in value.</p>
				
				<div class="m-scooch m-scooch-brands">
					<a class="prev m-arrow" href="#" data-m-slide="prev" data-carousel="brands">
						<i class="fa fa-angle-left"></i>
					</a>
					<a class="next m-arrow" href="#" data-m-slide="next" data-carousel="brands">
						<i class="fa fa-angle-right"></i>
					</a>
					<!-- the slider -->
					<div class="m-scooch-inner">

						<div class="m-item">
							<?php 
							$brandTerms = get_terms('product_brand', array('hide_empty' => 0, 'orderby' => 'ASC', 'exclude' => ''));
							$total = count($brandTerms);
							$i = 0;
							foreach($brandTerms as $brandTerm) {
								// get the thumbnail id user the term_id
								$thumbnail_id = get_woocommerce_term_meta( $brandTerm->term_id, 'thumbnail_id', true );
								// get the image URL
								$image = wp_get_attachment_url( $thumbnail_id );

								if($image != NULL ) { ?>
									<a href="<?php echo get_term_link($brandTerm); ?>">
										<img src="<?php echo $image; ?>" alt="<?php echo $brandTerm->name; ?>" />
									</a>
								<?php 
								// add to count
								$i++;
								}
								// break every 8th item
								if($i % 8 === 0 ) {
									echo '</div><div class="m-item">';
								} elseif($i === $total) {
									echo '</div>';
								}

							} ?>

					</div>
				</div>

				<a href="#" class="request">Request A Shipping Label</a>
			</div>
		</div>
	</section>

	<section id="Appraisal">

		<div class="outer">
			<div class="inner">

				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h2>Tweet us <a href="https://twitter.com/5starvintage" target="_blank">@5StarVintage</a> for real-time product appraisal.</h2>
							<p class="desc">Send us a tweet with photos of your vintage clothing to find out what it's worth, and what we'll offer.</p>

							<form method="post" action="<?php echo bloginfo('template_directory');?>/tweet/start.php" enctype="multipart/form-data" onsubmit="FSV.initTweetValidate()" >
								<div id="tweetWrap" class="clearfix">
									<div id="imageDrop">
										<span class="desc">Upload Image</span>
										<input type="file" name="img" id="img"/>
									</div>
									<div id="tweetText">
										<textarea type="text" name="txt" id="txt" maxlength="140" onkeyup="FSV.initCountChar(this)" placeholder="@5StarVintage..."></textarea>
										<div id="charNum">140</div>
									</div>
								</div>
								<input type="submit" name="sub" class="tweet" id="sub" value="Submit"/>
							</form>

						</div>
					</div>
				</div>

			</div>
		</div>

	</section>

</div>

<?php get_footer(); ?>



