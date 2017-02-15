<?php
/**
 * Template Name: Cart
 */
?>

<?php get_header(); ?>

	<div id="page" class="container clearfix MainWrap"> 

		<h1><span><?php the_title(); ?></span></h1>

		<div class="row">

			<div class="col-md-8 cartwrap">

				<div class="clearfix">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<article class="posts" id="post-<?php the_ID(); ?>">

							<?php the_content(); ?>

							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>

						</article>

					<?php endwhile; endif; ?>

				</div>

			</div>

			<div class="col-md-4" id="RightSidebar">

				<div id="sidebar">

					<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">

						<div class="widget" id="CartTotal">

							<h3 class="widgettitle">Cart Details</h3>
		
							<?php woocommerce_cart_totals(); ?>
							
							<div class="lowerTotals">
								<?php 
								// if ( WC()->cart->coupons_enabled() ) {
								// 	echo '<div class="coupon">';
								// 		include_once(TEMPLATEPATH.'/woocommerce/checkout/form-coupon.php');
								// 		do_action('woocommerce_cart_coupon');
								// 	echo '</div>';
								// }
								if( sizeof( $woocommerce->cart->get_cart() ) > 0 ) { ?>
									<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="btn btn-primary btn-large btn-block btn-checkout form-control">
										Checkout <i class="fa fa-angle-double-right"></i>
									</a>
								<?php } ?>
							</div>
					
						</div>

					</form>

				</div>

			</div>

		</div>

	</div>

<?php get_footer(); ?>
