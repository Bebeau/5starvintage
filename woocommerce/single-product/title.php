<?php
/**
 * Single Product title
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $post, $product;
?>
<h1 itemprop="name" class="product_title entry-title">
	<span><?php the_title(); ?> - <?php echo $product->get_price_html(); ?></span>
</h1>