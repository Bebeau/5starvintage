<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce, $product, $post; ?>

<script type="text/javascript">
  function swap(image) {
   document.getElementById("mainimage").src = image.href;
   document.getElementById("mainimage").src = image.href;
  }
</script>

<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

get_header('shop'); ?>

<div class="Shop">
	<div class="container MainWrap" id="ProductDetails">

			<div class="row">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php do_action( 'woocommerce_single_product_title' ); ?>

					<?php
						/**
						 * woocommerce_before_main_content hook
						 *
						 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
						 * @hooked woocommerce_breadcrumb - 20
						 */
						do_action( 'woocommerce_before_main_content' );
					?>

					<div class="col-md-8 PageWrap">

						<div id="SingleProduct">
								
							<?php wc_get_template_part( 'content', 'single-product' ); ?>

						</div>

						<?php
							/**
							 * woocommerce_after_main_content hook
							 *
							 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
							 */
							do_action('woocommerce_after_main_content');
						?>

					</div>

				<?php endwhile; // end of the loop. ?>

			<div class="col-md-4" id="RightSidebar">

				<div id="sidebar">
				
					<div class="widget">
						<h3>Buy Now!</h3>

						<div class="PurchaseWrap">
							<div id="purchase">
								<?php include(TEMPLATEPATH . '/woocommerce/single-product/add-to-cart/simple.php'); ?>
								<div class="clearfix"></div>
							</div>
						</div>

						<div class="row ProductDetails">
							<div class="col-md-12 description">
								<?php include(TEMPLATEPATH . '/woocommerce/single-product/tabs/description.php'); ?>
							</div>
						</div>
						
					</div>

					<div class="widget visible-xs">
						<div id="RelatedProducts">
							<?php include(TEMPLATEPATH . '/woocommerce/single-product/related.php'); ?>
						</div>
					</div>

					<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Product Details Widgets')) ?>

				</div>

			</div>

		</div>

	</div>

</div>

	<?php
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		// do_action( 'woocommerce_sidebar' );
	?>

<?php get_footer('shop'); ?>