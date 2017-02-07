<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( $order ) : ?>

	<?php if ( $order->has_status( 'failed' ) ) : ?>

		<p class="alert alert-danger">
			<?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce' ); ?>
		</p>

		<p class="alert alert-warning">
			<?php
				if ( is_user_logged_in() )
					_e( 'Please attempt your purchase again or go to your account page.', 'woocommerce' );
				else
					_e( 'Please attempt your purchase again.', 'woocommerce' );
			?>
		</p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay btn btn-primary btn-large">
				<?php _e( 'Pay', 'woocommerce' ) ?>
			</a>
			<?php if ( is_user_logged_in() ) : ?>
			<a href="<?php echo esc_url( get_permalink( woocommerce_get_page_id( 'myaccount' ) ) ); ?>" class="button pay btn btn-default btn-large">
				<?php _e( 'My Account', 'woocommerce' ); ?>
			</a>
			<?php endif; ?>
		</p>

		<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

	<?php else : ?>

		<p class="alert alert-success centered">
			<?php _e( 'Thank you. Your order has been received.', 'woocommerce' ); ?>
		</p>

		<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
		<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

		<div class="clearfix"></div>

	<?php endif; ?>


<?php else : ?>

	<p class="alert alert-success centered">
		<p><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></p>
	</p>

<?php endif; ?>