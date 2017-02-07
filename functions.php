<?php

/**
 * Script Loader
 */
	function theme_styles() {
		// Register & Load Styles
		wp_register_style( 'Style CSS', get_bloginfo( 'template_url' ) . '/style.css', 'all' );
		wp_enqueue_style( 'Style CSS' );
		
		// Load default Wordpress jQuery
		wp_deregister_script('jquery');
		wp_enqueue_script('jquery', 'http://code.jquery.com/jquery.min.js', '', null, false );

		// Load Custom JS
		wp_enqueue_script('custom', get_bloginfo( 'template_url' ) . '/assets/js/custom.js', array('jquery'), null, true);
	}
	add_action( 'wp_print_styles', 'theme_styles' );

	add_filter( 'woocommerce_enqueue_styles', '__return_false' );

	if ( function_exists( 'add_theme_support' ) ) {
	  // Add woocommerce support
	  add_theme_support( 'woocommerce' );
	  // Add html5 search form functionality
	  add_theme_support('html5', array('search-form'));
	  // Add post thumbnail support
	  add_theme_support( 'post-thumbnails' );
	}

	// Display 24 products per page. Goes in functions.php
	add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 30;' ), 20 );

	// Register Main Shop Sidebar
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name'          => __( 'Shop Widgets', 'theme_text_domain' ),
			'id'            => 'shop-widgets',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',)
		);
	}
	// Register Main Shop Sidebar
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name'          => __( 'Mobile Shop Widgets', 'theme_text_domain' ),
			'id'            => 'mobile-shop-widgets',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>',)
		);
	}
	// Register Product Details Sidebar
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name'          => __( 'Product Details Widgets', 'theme_text_domain' ),
			'id'            => 'product-detail-widgets',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' ,)
		);
	}
	// Single Blog Post Sidebar
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name'          => __( 'Blog Listing Widgets', 'theme_text_domain' ),
			'id'            => 'blog-listing-widgets',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' ,)
		);
	}
	// Single Blog Post Sidebar
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name'          => __( 'Single Post/Page Widgets', 'theme_text_domain' ),
			'id'            => 'single-post-widgets',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' ,)
		);
	}
	// Footer Widget 1 Sidebar
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name'          => __( 'Footer Copy', 'theme_text_domain' ),
			'id'            => 'footer-widget-1',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s span6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' ,)
		);
	}
	// Size Filtering
	if ( function_exists('register_sidebar') ) {
		register_sidebar(array(
			'name'          => __( 'Shop Size Filtering', 'theme_text_domain' ),
			'id'            => 'size-filtering',
			'description'   => '',
		    'class'         => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s span6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widgettitle">',
			'after_title'   => '</h3>' ,)
		);
	}

	// Register Menus
	function register_my_menus() {
		register_nav_menus(
		    array(
		      'help-menu' => __( 'Need Help?' ),
		      'involved-menu' => __( 'Get Involved!' ),
		      'connect-menu' => __( 'Connect With Us!' )
		    )
		);
	}
	add_action( 'init', 'register_my_menus' );

	// Excerpt Changes
	function custom_excerpt($num) {
	  global $post;
	    $limit = $num+1;
	    $excerpt = explode(' ', get_the_excerpt(), $limit);
	    array_pop($excerpt);
	    $excerpt = implode(" ",$excerpt)."...";
	    $excerpt = '<p>' . $excerpt . '</p>';
	    echo $excerpt;
	}

	// Comments
	require_once (TEMPLATEPATH . '/partials/comments/comments_functions.php');

	// overwrite woocommerce default widgets & unregister unused widgets
	function override_woocommerce_widgets() {
	 
		if ( class_exists( 'WC_Widget_Onsale' ) ) {
			unregister_widget( 'WC_Widget_Onsale' );
			include_once(TEMPLATEPATH . '/woocommerce/widgets/real-widget-onsale.php' );
			register_widget( 'Real_Widget_Onsale' );
		}

		if ( class_exists( 'WC_Widget_Featured_Products' ) ) {
			unregister_widget( 'WC_Widget_Featured_Products' );
			include_once(TEMPLATEPATH . '/woocommerce/widgets/real-widget-featured-products.php' );
			register_widget( 'Real_Widget_Featured_Products' );
		}

		if ( class_exists( 'WC_Widget_Recently_Viewed' ) ) {
			unregister_widget( 'WC_Widget_Recently_Viewed' );
			include_once(TEMPLATEPATH . '/woocommerce/widgets/real-widget-recently-viewed.php' );
			register_widget( 'Real_Widget_Recently_Viewed' );
		}

		if ( class_exists( 'WC_Widget_Best_Sellers' ) ) {
			unregister_widget( 'WC_Widget_Best_Sellers' );
			include_once(TEMPLATEPATH . '/woocommerce/widgets/real-widget-best-sellers.php' );
			register_widget( 'Real_Widget_Best_Sellers' );
		}

		if ( class_exists( 'WC_Widget_Top_Rated_Products' ) ) {
			unregister_widget( 'WC_Widget_Top_Rated_Products' );
			include_once(TEMPLATEPATH . '/woocommerce/widgets/real-widget-top-rated-products.php' );
			register_widget( 'Real_Widget_Top_Rated_Products' );
		}
		
		if ( class_exists( 'WC_Widget_Recent_Products' ) ) {
			unregister_widget( 'WC_Widget_Recent_Products' );
		}
		if ( class_exists( 'WC_Widget_Cart' ) ) {
			unregister_widget( 'WC_Widget_Cart' );
		}
		if ( class_exists( 'WC_Widget_Layered_Nav_Filters' ) ) {
			unregister_widget( 'WC_Widget_Layered_Nav_Filters' );
		}
		if ( class_exists( 'WC_Widget_Layered_Nav' ) ) {
			unregister_widget( 'WC_Widget_Layered_Nav' );
		}
		if ( class_exists( 'WC_Widget_Price_Filter' ) ) {
			unregister_widget( 'WC_Widget_Price_Filter' );
		}
		if ( class_exists( 'WC_Widget_Product_Categories' ) ) {
			unregister_widget( 'WC_Widget_Product_Categories' );
		}
		if ( class_exists( 'WC_Widget_Product_Search' ) ) {
			unregister_widget( 'WC_Widget_Product_Search' );
		}
		if ( class_exists( 'WC_Widget_Product_Tag_Cloud' ) ) {
			unregister_widget( 'WC_Widget_Product_Tag_Cloud' );
		}
		if ( class_exists( 'WC_Widget_Recent_Reviews' ) ) {
			unregister_widget( 'WC_Widget_Recent_Reviews' );
		}

	}

	// Add classes to checkout form inputs
	add_filter('woocommerce_default_address_fields', 'custom_override_default_address_fields');
	function custom_override_default_address_fields( $address_fields ) {
		
		$address_fields['company']['class'] = array( 'form-group' );
		$address_fields['company']['input_class'] = array( 'form-control' );
		
		$address_fields['first_name']['class'] = array( 'form-group' );
		$address_fields['first_name']['input_class'] = array( 'form-control' );

		$address_fields['last_name']['class'] = array( 'form-group' );
		$address_fields['last_name']['input_class'] = array( 'form-control' );

		$address_fields['address_1']['class'] = array( 'form-group' );
		$address_fields['address_1']['input_class'] = array( 'form-control' );

		$address_fields['address_2']['class'] = array( 'form-group' );
		$address_fields['address_2']['input_class'] = array( 'form-control' );

		$address_fields['city']['class'] = array( 'form-group' );
		$address_fields['city']['input_class'] = array( 'form-control' );

		$address_fields['state']['class'] = array( 'form-group' );
		$address_fields['state']['input_class'] = array( 'form-control' );

		$address_fields['postcode']['class'] = array( 'form-group' );
		$address_fields['postcode']['input_class'] = array( 'form-control' );

		return $address_fields;
	}

	// Hook into the woocommerce checkout form fields
	add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
	// Our hooked in function - $fields is passed via the filter!
	function custom_override_checkout_fields( $fields ) {
	  
	 	unset($fields['billing']['billing_company']);
		unset($fields['shipping']['shipping_company']);

	  	return $fields;
	}

	// Hide admin bar
	add_filter('show_admin_bar', '__return_false');

	// Remove the default stripe card manager and add a custom one
	remove_filter( 'woocommerce_after_my_account', 'woocommerce_stripe_saved_cards');
	add_filter( 'woocommerce_after_my_account', 'custom_woocommerce_stripe_saved_cards');
	function custom_woocommerce_stripe_saved_cards() {
		$credit_cards = get_user_meta( get_current_user_id(), '_stripe_customer_id', false );

		if ( ! $credit_cards )
			return;

		$credit_cards = get_user_meta( get_current_user_id(), '_stripe_customer_id', false );

		if ( ! $credit_cards )
			return;
		?>
			<h3 id="saved-cards"><?php _e('Saved cards', 'wc_stripe' ); ?></h3>
			<table class="shop_table table table-bordered">
				<thead>
					<tr>
						<th><?php _e('Card ending in...','wc_stripe'); ?></th>
						<th><?php _e('Expires','wc_stripe'); ?></th>
						<th><i class="fa fa-trash-o"></i></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ( $credit_cards as $i => $credit_card ) : ?>
					<tr>
	                    <td>************<?php esc_html_e($credit_card['active_card']); ?></td>
	                    <td><?php echo esc_html($credit_card['exp_month']) . '/' . esc_html($credit_card['exp_year']); ?></td>
						<td>
	                        <form action="" method="POST" id="SavedCards">
	                            <?php wp_nonce_field ( 'stripe_del_card' ); ?>
	                            <input type="hidden" name="stripe_delete_card" value="<?php echo esc_attr($i); ?>">
	                            <a href="#" id="Delete" type="submit" class="button"><i class="fa fa-times-circle"></i></a>
	                        </form>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		<?php
	}
	remove_action( 'init', 'WC_Gateway_Stripe' );

	// Generate the best Facebook image
	// function get_fbimage() {
	// 	$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), '', '' );
	// 	if ( has_post_thumbnail($post->ID) ) {
	// 		$fbimage = $src[0];
	// 	} else {
	// 		global $post, $posts;
	// 		$fbimage = '';
	// 		$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',
	// 		$post->post_content, $matches);
	// 		$fbimage = $matches [1] [0];
	// 	}
	// 	if(empty($fbimage)) {
	// 		$fbimage = "http://5starvintage.com/wp-content/themes/5StarVintage/assets/img/fb-default.png";
	// 	}
	// 	return $fbimage;
	// }

	// Shop filter options above products. Remove the defaults display, and add a custom display.
	remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

	add_action('woocommerce_single_product_title', 'woocommerce_template_single_title', 10);
	add_action('woocommerce_before_single_product_summary', 'woocommerce_output_related_products', 30);

	// incude notify plugin
    include_once(TEMPLATEPATH . '/partials/plugins/notify.php');

?>