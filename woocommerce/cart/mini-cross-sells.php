<?php
/**
 * Cross-sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop, $woocommerce, $product;

$minicrosssells = $woocommerce->cart->get_cross_sells();

if ( sizeof( $minicrosssells ) == 0 ) return;

$meta_query = $woocommerce->query->get_meta_query();

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', 1 ),
	'no_found_rows'       => 1,
	'orderby'             => 'rand',
	'post__in'            => $minicrosssells,
	'meta_query'          => $meta_query
);

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', 1 );

$price = get_post_meta( get_the_ID(), '_regular_price', true);

if ( $products->have_posts() ) : ?>

	<div class="cross-sells">

		<a href="<?php the_permalink(); ?>"></a>

		<h3><?php _e('You may also be interested in&hellip;', 'woocommerce') ?></h3>

		<ul class="products list-unstyled">

			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<li class=" col-md-12

					<?php
					if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 )
						echo 'last';
					elseif ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 )
						echo 'first';
					?>">

					<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

					<div class="row">

						<div class="col-md-6 productimage">
							<?php
								/**
								 * woocommerce_before_shop_loop_item_title hook
								 *
								 * @hooked woocommerce_show_product_loop_sale_flash - 10
								 * @hooked woocommerce_template_loop_product_thumbnail - 10
								 */
								do_action( 'woocommerce_before_shop_loop_item_title' );
							?>
							<div class="over">View Product <i class="fa fa-angle-double-right"></i></div>
						</div>

						<div class="col-md-6">
							<div class="productinfo">

								<h4 class="producttitle"><?php the_title(); ?> - 
									<span class="amount"><?php include(TEMPLATEPATH . '/woocommerce/single-product/price.php'); ?></span>
								</h4>

								<?php custom_excerpt(55); ?>
							</div>
						</div>

					</div>

				</li>

			<?php endwhile; // end of the loop. ?>

		</ul>

	</div>

<?php endif;

wp_reset_query();
