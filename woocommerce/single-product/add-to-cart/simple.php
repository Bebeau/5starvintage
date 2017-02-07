<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $product;

if ( ! $product->is_purchasable() ) return;
?>

<?php
	// Availability
	$availability = $product->get_availability();
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart" method="post" enctype='multipart/form-data'>
	 	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
	 	<div class="row">
	 		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
	 			<?php
			 		if ( ! $product->is_sold_individually() )
			 			woocommerce_quantity_input( array(
			 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
			 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
			 			) );
			 	?>
	 			<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
	 		</div>
	 		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
	 			<button type="submit" class="single_add_to_cart_button button alt btn btn-primary btn-large btn-block"><?php echo $product->single_add_to_cart_text(); ?></button>
	 		</div>
	 	</div>
		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
	</form>

	<?php 
	if ( $availability['availability'] ) {
		echo apply_filters( 'woocommerce_stock_html', '<p class="stock alert alert-success centered ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>', $availability['availability'] );
	}
	do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>