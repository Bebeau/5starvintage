<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

wc_print_notices(); ?>

<h1><span>My Account</span></h1>

<div class="PageWrap">

	<p class="myaccount_user col-lg-12 col-md-12">
		<?php
		printf(
			__( 'Hello <strong>%1$s</strong> (not %1$s? <a href="%2$s">Sign out</a>).', 'woocommerce' ) . ' ',
			$current_user->display_name,
			wp_logout_url( get_permalink( wc_get_page_id( 'myaccount' ) ) )
		);

		printf( __( 'From your account dashboard you can view your recent orders, manage your shipping and billing addresses and <a href="%s">edit your password and account details</a>.', 'woocommerce' ),
			wc_customer_edit_account_url()
		);
		?>
	</p>

	<?php do_action( 'woocommerce_before_my_account' ); ?>

	<?php wc_get_template( 'myaccount/my-address.php' ); ?>

	<?php wc_get_template( 'myaccount/my-orders.php', array( 'order_count' => $order_count ) ); ?>

	<?php wc_get_template( 'myaccount/my-downloads.php' ); ?>

	<?php do_action( 'woocommerce_after_my_account' ); ?>

</div>
