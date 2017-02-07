<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;
?>

<form action="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" method="post">
<?php if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) { ?>
<table class="table table-striped table-bordered table-condensed" cellspacing="0">
	<thead>
		<tr>
			<th class="product-remove centered"><i class="icon-trash"></i></th>
			<th class="product-name"><?php _e('Product', 'woocommerce'); ?></th>
			<th class="product-price centered"><?php _e('Price', 'woocommerce'); ?></th>
			<!-- <th class="product-quantity"><?php _e('Quantity', 'woocommerce'); ?></th> -->
			<th class="product-subtotal centered"><?php _e('Total', 'woocommerce'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php
			foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $values ) {
				$_product = $values['data'];
				if ( $_product->exists() && $values['quantity'] > 0 ) {
					?>
					<tr class = "<?php echo esc_attr( apply_filters('woocommerce_cart_table_item_class', 'cart_table_item', $values, $cart_item_key ) ); ?>">
						<!-- Remove from cart link -->
						<td class="product-remove centered">
							<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'woocommerce') ), $cart_item_key );
							?>
						</td>

						<!-- The thumbnail -->
						<!-- <td class="product-thumbnail">
							
						</td> -->

						<!-- Product Name -->
						<td class="product-name">
							<div class="media">
								<?php
									$thumbnail = apply_filters( 'woocommerce_in_cart_product_thumbnail', $_product->get_image(), $values, $cart_item_key );
									printf('<a href="%s" class="pull-left">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), $thumbnail );
								?>
								<div class="media-body">
									<?php
										if ( ! $_product->is_visible() || ( $_product instanceof WC_Product_Variation && ! $_product->parent_is_visible() ) )
											echo apply_filters( 'woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key );
										else
											printf('<a href="%s">%s</a>', esc_url( get_permalink( apply_filters('woocommerce_in_cart_product_id', $values['product_id'] ) ) ), apply_filters('woocommerce_in_cart_product_title', $_product->get_title(), $values, $cart_item_key ) );

										// Meta data
										echo '<div>' . $woocommerce->cart->get_item_data( $values ) .'</div>';

		                   				// Backorder notification
		                   				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $values['quantity'] ) )
		                   					echo '<p class="backorder_notification">' . __('Available on backorder', 'woocommerce') . '</p>';
									?>
								</div>
							</div>

						</td>

						<!-- Product price -->
						<td class="product-price centered">
							<?php
								$product_price = get_option('woocommerce_display_cart_prices_excluding_tax') == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

								echo apply_filters('woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $values, $cart_item_key );
							?>
						</td>

						<!-- Quantity inputs -->
						<!-- <td class="product-quantity">
							<div class="input-append input-prepend">
									<?php
										if ( $_product->is_sold_individually() ) {
											$product_quantity = '1';
										} else {
											$data_min = apply_filters( 'woocommerce_cart_item_data_min', '', $_product );
											$data_max = ( $_product->backorders_allowed() ) ? '' : $_product->get_stock_quantity();
											$data_max = apply_filters( 'woocommerce_cart_item_data_max', $data_max, $_product );

											$product_quantity = sprintf( '<div class="quantity"><input type="text" name="cart[%s][qty]" data-min="%s" data-max="%s" value="%s" title="Qty" class="centered" maxlength="2" /></div>', $cart_item_key, $data_min, $data_max, esc_attr( $values['quantity'] ) );
										}

										echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
									?>
							</div>
							
							<input type="submit" class="btn btn-primary" name="update_cart" value="<?php _e('Update Cart', 'woocommerce'); ?>" /> 
							
						</td> -->

						<!-- Product subtotal -->
						<td class="product-subtotal centered">
							<?php
								echo apply_filters( 'woocommerce_cart_item_subtotal', $woocommerce->cart->get_product_subtotal( $_product, $values['quantity'] ), $values, $cart_item_key );
							?>
						</td>
					</tr>
					<?php
				}
			} ?>
					<tr>
						<td colspan="3" class="actions text-right">
							<strong>Cart Subtotal</strong>
						</td>
					<td class="centered">
						<?php echo $woocommerce->cart->get_cart_subtotal(); ?>
					</td>
				</tr>
			</tbody>
		</table>
		<input type="submit" class="checkout-button btn btn-primary pull-right" name="proceed" value="<?php _e('Proceed to Checkout', 'woocommerce'); ?>" />
		
		<?php } else { ?>
			
			<p class="alert alert-warning">There are currently no items in your cart.</p>
			<a class="btn pull-left" name="proceed" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>"> Return To Shop</a>
		
		<?php } do_action( 'woocommerce_cart_contents' ); ?>
</form>