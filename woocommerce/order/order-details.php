<?php
/**
 * Order details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$order = wc_get_order( $order_id );

?>

<header>
	<h3><?php _e( 'Purchase Details', 'woocommerce' ); ?></h3>
	<hr>
</header>

<ul class="order_details">
	<li class="order">
		<?php _e( 'Order:', 'woocommerce' ); ?>
		<strong><?php echo $order->get_order_number(); ?></strong>
	</li>
	<li class="date">
		<?php _e( 'Date:', 'woocommerce' ); ?>
		<strong><?php echo date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ); ?></strong>
	</li>
	<li class="total">
		<?php _e( 'Total:', 'woocommerce' ); ?>
		<strong><?php echo $order->get_formatted_order_total(); ?></strong>
	</li>
	<?php if ( $order->payment_method_title ) : ?>
	<li class="method">
		<?php _e( 'Payment method:', 'woocommerce' ); ?>
		<strong><?php echo $order->payment_method_title; ?></strong>
	</li>
	<?php endif; ?>
</ul>

<h3><?php _e( 'Order Details', 'woocommerce' ); ?></h3>
<hr>

<div class="row">

	<div class="col-md-8">

		<table class="shop_table order_details table table-bordered">
			<thead>
				<tr>
					<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th>
					<th class="product-total"><?php _e( 'Total', 'woocommerce' ); ?></th>
				</tr>
			</thead>
			<tfoot>
				<?php
					if ( $totals = $order->get_order_item_totals() ) 
						foreach ( $totals as $total ) :
					?>
						<tr>
							<th scope="row" class="text-right"><?php echo $total['label']; ?></th>
							<td><?php echo $total['value']; ?></td>
						</tr>
						<?php
					endforeach;
				?>
			</tfoot>
			<tbody>
				<?php
				if ( sizeof( $order->get_items() ) > 0 ) {

					foreach( $order->get_items() as $item_id => $item ) {
						$_product  = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
						$item_meta = new WC_Order_Item_Meta( $item['item_meta'], $_product );

				if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
					?>
						<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_order_item_class', 'order_item', $item, $order ) ); ?>">
							<td class="product-name" style="vertical-align: middle;">
								<div class="row">
									<div class="col-md-3">
										<div class="centered">
											<?php
												$thumbnail = apply_filters( 'woocommerce_order_item_thumbnail', $_product->get_image('medium'), $item);

												if ( ! $_product->is_visible() )
													echo $thumbnail;
												else
													printf( '<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail );
											?>
										</div>
									</div>
									<div class="col-md-9">
										<?php
											if ( $_product && ! $_product->is_visible() ) {
												echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );
											} else {
												echo apply_filters( 'woocommerce_order_item_name', sprintf( '<a href="%s">%s</a>', get_permalink( $item['product_id'] ), $item['name'] ), $item );
											}

												echo apply_filters( 'woocommerce_order_item_quantity_html', ' <strong class="product-quantity">' . sprintf( '&times; %s', $item['qty'] ) . '</strong>', $item );
								// Allow other plugins to add additional product information here
								do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );
												$item_meta->display();

											if ( $_product && $_product->exists() && $_product->is_downloadable() && $order->is_download_permitted() ) {

												$download_files = $order->get_item_downloads( $item );
												$i              = 0;
												$links          = array();

												foreach ( $download_files as $download_id => $file ) {
													$i++;

													$links[] = '<small><a href="' . esc_url( $file['download_url'] ) . '">' . sprintf( __( 'Download file%s', 'woocommerce' ), ( count( $download_files ) > 1 ? ' ' . $i . ': ' : ': ' ) ) . esc_html( $file['name'] ) . '</a></small>';
												}

												echo '<br/>' . implode( '<br/>', $links );
											}
								// Allow other plugins to add additional product information here
								do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
										?>
									</div>
								</div>
							</td>
							<td class="product-total">
								<?php echo $order->get_formatted_line_subtotal( $item ); ?>
							</td>
						</tr>
						<?php
				}

						if ( $order->has_status( array( 'completed', 'processing' ) ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) {
							?>
							<tr class="product-purchase-note">
								<td colspan="3"><?php echo wpautop( do_shortcode( wp_kses_post( $purchase_note ) ) ); ?></td>
							</tr>
							<?php
						}
					}
				}

				// do_action( 'woocommerce_order_items_table', $order );
				?>
			</tbody>
		<tfoot>
	<?php
		$has_refund = false;

		if ( $total_refunded = $order->get_total_refunded() ) {
			$has_refund = true;
		}

		// Check for refund
		if ( $has_refund ) { ?>
			<tr>
				<th scope="row"><?php _e( 'Refunded:', 'woocommerce' ); ?></th>
				<td>-<?php echo wc_price( $total_refunded, array( 'currency' => $order->get_order_currency() ) ); ?></td>
			</tr>
		<?php
		}

		// Check for customer note
		if ( '' != $order->customer_note ) { ?>
			<tr>
				<th scope="row"><?php _e( 'Note:', 'woocommerce' ); ?></th>
				<td><?php echo wptexturize( $order->customer_note ); ?></td>
			</tr>
		<?php } ?>

	</tfoot>
</table>

<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>

	</div>

	<div class="col-md-4">

		<div class="form-group">
			<header class="title">
				<h4><?php _e( 'Contact', 'woocommerce' ); ?></h4>
			</header>
			<div class="customer_details">
				<?php
					if ( $order->billing_phone ) echo  '<div><i class="fa fa-phone"></i> ' . $order->billing_phone . '</div>';
					if ( $order->billing_email ) echo  '<div><i class="fa fa-envelope"></i> ' . $order->billing_email . '</div>';
					// Additional customer details hook
					do_action( 'woocommerce_order_details_after_customer_details', $order );
				?>
			</div>
		</div>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

		<div class="col2-set addresses">

			<div class="col-1">

		<?php endif; ?>

				<header class="title">
					<h4><?php _e( 'Billing Address', 'woocommerce' ); ?></h4>
				</header>

				<address>
			<?php
				if ( ! $order->get_formatted_billing_address() ) {
					_e( 'N/A', 'woocommerce' );
				} else {
					echo $order->get_formatted_billing_address();
				}
			?>
				</address>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && get_option( 'woocommerce_calc_shipping' ) !== 'no' ) : ?>

			</div><!-- /.col-1 -->

			<div class="col-2">

				<header class="title">
					<h4><?php _e( 'Shipping Address', 'woocommerce' ); ?></h4>
				</header>

				<address>
			<?php
				if ( ! $order->get_formatted_shipping_address() ) {
					_e( 'N/A', 'woocommerce' );
				} else {
					echo $order->get_formatted_shipping_address();
				}
			?>
				</address>

			</div><!-- /.col-2 -->

		</div><!-- /.col2-set -->

		<?php endif; ?>

	</div>

</div>

<div class="clearfix"></div>
