<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<p class="alert centered">Ops, You don't have anything in your cart. Click the button below to go to visit our online store.</p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<a class="button btn btn-default btn-large btn-block" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">
			<?php _e( '&larr; Return To Shop', 'woocommerce' ) ?>
		</a>
	</div>
</div>