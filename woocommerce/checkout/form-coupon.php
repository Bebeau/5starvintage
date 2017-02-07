<?php
/**
 * Checkout coupon form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! WC()->cart->coupons_enabled() ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_coupon_message','<h3>'. __( 'Have a coupon?', 'woocommerce' ) . '</h3>' );
wc_print_notice( $info_message, 'notice' );
?>

<form class="checkout_coupon" method="post">
	<div class="row">
		<div class="col-md-8">
			<p class="form-row form-row-first">
				<input type="text" name="coupon_code" class="input-text" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" id="coupon_code" value="" />
			</p>
		</div>
		<div class="col-md-4">
			<p class="form-row form-row-last">
				<input type="submit" class="button btn btn-primary" name="apply_coupon" value="<?php _e( 'Apply', 'woocommerce' ); ?>" />
			</p>
		</div>
	</div>
	<div class="clearfix"></div>
</form>