<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $product, $woocommerce_loop;

$upsells = $product->get_upsells();

if ( sizeof( $upsells ) == 0 ) return;

$args = array(
	'post_type'				=> 'product',
	'ignore_sticky_posts'	=> 1,
	'posts_per_page' 		=> 4,
	'no_found_rows' 		=> 1,
	'orderby' 				=> 'rand',
	'post__in' 				=> $upsells
);

$products = new WP_Query( $args );

if ( $products->have_posts() ) : ?>

	<div class="upsells productswrap clearfix">

		<h3>
			<?php _e('You may also like&hellip;', 'woocommerce') ?>
		</h3>

		<ul class="products clearfix list-unstyled row">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<li class=" col-md-3

					<?php
					if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
						echo 'last';
					elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
						echo 'first';
					?>">

					<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

						<a href="<?php the_permalink(); ?>">

							<?php
								/**
								 * woocommerce_before_shop_loop_item_title hook
								 *
								 * @hooked woocommerce_show_product_loop_sale_flash - 10
								 * @hooked woocommerce_template_loop_product_thumbnail - 10
								 */
								do_action( 'woocommerce_before_shop_loop_item_title' );
							?>

							<div class="productinfo">

								<h4 class="producttitle"><?php the_title(); ?></h4>

								<?php
									/**
									 * woocommerce_after_shop_loop_item_title hook
									 *
									 * @hooked woocommerce_template_loop_price - 10
									 */
									do_action( 'woocommerce_after_shop_loop_item_title' );
								?>
								
							</div>

						</a>

					<?php 
					// do_action( 'woocommerce_after_shop_loop_item' ); 
					?>

				</li>

			<?php endwhile; // end of the loop. ?>

		</ul>

	</div>

<?php endif;

wp_reset_postdata();