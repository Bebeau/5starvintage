<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;
?>

<div id="MiniCart">

	<?php do_action( 'woocommerce_before_mini_cart' ); ?>

	<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

		<div class="row">

			<div class="col-md-12">

				<h3><?php _e('Items In Your Cart&hellip;', 'woocommerce') ?></h3>

				<ul class="cart_list product_list_widget list-unstyled">

					<?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

						<?php
							foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
								$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
								$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

								if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

									$product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
									$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
									$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

									?>
									<li>
										<div class="row">
											<div class="col-md-2 col-xs-6">
												<a href="<?php echo get_permalink( $product_id ); ?>">
													<?php echo $thumbnail; ?>
												</a>
											</div>
											<div class="col-md-10 col-xs-6">
												<div class="product-remove">
													<?php
														echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s"><i class="fa fa-times-circle"></i></a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
													?>
												</div>
												<div>
													<h4><?php echo $product_name; ?></h4>

													<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
												</div>
											</div>
										</div>
									</li>
									<?php
								}
							}
						?>

					<?php else : ?>

						<li class="empty"><?php _e( 'No products in the cart.', 'woocommerce' ); ?></li>

					<?php endif; ?>

				</ul><!-- end product list -->

				<hr>

				<div class="text-right">

					<p class="total">
						<?php _e( 'Subtotal', 'woocommerce' ); ?>: <?php echo WC()->cart->get_cart_subtotal(); ?>
					</p>

					<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

					<p class="buttons btn-group">
						<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="button view-cart wc-forward btn btn-default btn-large"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
						<a href="<?php echo WC()->cart->get_checkout_url(); ?>" class="button checkout wc-forward btn btn-primary btn-large"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
					</p>
				</div>

			</div>

		</div>

		<?php // include_once(TEMPLATEPATH . '/woocommerce/cart/mini-cross-sells.php'); ?>

	<?php else : ?>

		<div class="col-md-12" id="emptycart">
			<p class="centered">
				<?php _e( 'Your cart is currently empty.', 'woocommerce' ) ?>
				<a class="button btn btn-default" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">
					Visit Our Shop
				</a>
			</p>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_mini_cart' ); ?>

</div>