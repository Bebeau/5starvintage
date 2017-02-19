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

				<?php
					/**
					 * woocommerce_before_main_content hook
					 *
					 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
					 * @hooked woocommerce_breadcrumb - 20
					 */
					do_action( 'woocommerce_before_main_content' );
					do_action( 'woocommerce_single_product_title' );
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
				
					<div class="widget" id="buyNow">
						<h3>Buy Now!</h3>

						<div class="PurchaseWrap">
							<div id="purchase">
								<?php echo '<div id="productPrice"> $'.$product->get_price().'</div>'; ?>
								<?php include(TEMPLATEPATH . '/woocommerce/single-product/add-to-cart/simple.php'); ?>
								<div class="clearfix"></div>
							</div>
						</div>

						<div class="ProductDetails">
							<div class="description">
								<?php include(TEMPLATEPATH . '/woocommerce/single-product/tabs/description.php'); ?>
							</div>
						</div>
						
					</div>

					<div class="widget">
						<?php
						
						global $post;
						
						$type = get_post_type( $post->ID );
						
						query_posts( array(
								'post_type' => $type,
								'posts_per_page' => 1,
								'orderby' => 'rand',
								'post__not_in' => array($post->ID)
							)
						);

						if (have_posts()) {
							echo '<div class="relatedProducts">';
								while (have_posts()) { 
									the_post();

									$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID), 'large' );
									echo '<a href="'.get_permalink().'">';
										echo '<img src="'.$image[0].'" alt="" />';
										echo '<h3>'.get_the_title().'</h3>';
									echo '</a>';
								}
							echo '</div>';
						}

						wp_reset_query(); 

						?>
					</div>

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