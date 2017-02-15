<?php

global $post;

function theme_styles() {
	// Register & Load Styles
	wp_enqueue_style( 'Bootstrap CSS', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', 'all' );
	wp_enqueue_style( 'Style CSS', get_bloginfo( 'template_url' ) . '/style.css', 'all' );
	
	// Load default Wordpress jQuery
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'http://code.jquery.com/jquery.min.js', '', null, false );

	// Load Custom JS
	wp_enqueue_script('custom', get_bloginfo( 'template_url' ) . '/assets/js/custom.min.js', array('jquery'), null, true);
	wp_localize_script( 'custom', 'ajax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'page' => 2,
        'loading' => false
    ));
}
add_action( 'wp_print_styles', 'theme_styles' );

// add_filter( 'woocommerce_enqueue_styles', '__return_false' );
function grd_woocommerce_script_cleaner() {
	// Remove the generator tag
	remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
	// Unless we're in the store, remove all the cruft!
	if ( is_cart() || is_checkout() ) {
		wp_dequeue_style( 'woocommerce_frontend_styles' );
		wp_dequeue_style( 'woocommerce-general');
		wp_dequeue_style( 'woocommerce-layout' );
		wp_dequeue_style( 'woocommerce-smallscreen' );
		wp_dequeue_style( 'woocommerce_fancybox_styles' );
		wp_dequeue_style( 'woocommerce_chosen_styles' );
		wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
		wp_dequeue_style( 'select2' );
	}
}
add_action( 'wp_enqueue_scripts', 'grd_woocommerce_script_cleaner', 99 );

if ( function_exists( 'add_theme_support' ) ) {
  // Add woocommerce support
  add_theme_support( 'woocommerce' );
  // Add html5 search form functionality
  add_theme_support('html5', array('search-form'));
  // Add post thumbnail support
  add_theme_support( 'post-thumbnails' );
}

// Register Main Shop Sidebar
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name'          => 'Shop Widgets',
		'id'            => 'shop-widgets',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>',)
	);
	register_sidebar(array(
		'name'          => 'Product Details Widgets',
		'id'            => 'product-detail-widgets',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' ,)
	);
	register_sidebar(array(
		'name'          => 'Footer Copy',
		'id'            => 'footer-widget-1',
		'description'   => '',
	    'class'         => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s span6">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widgettitle">',
		'after_title'   => '</h3>' ,)
	);
}

// Register Menus
add_action( 'init', 'register_my_menus' );
function register_my_menus() {
	register_nav_menus(
	    array(
	      'footer-menu' => __( 'Footer Menu' )
	    )
	);
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


// Shop filter options above products. Remove the defaults display, and add a custom display.
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);

add_action('woocommerce_single_product_title', 'woocommerce_template_single_title', 10);
add_action('woocommerce_before_single_product_summary', 'woocommerce_output_related_products', 30);

// incude notify plugin
include_once(TEMPLATEPATH . '/partials/plugins/notify.php');

function wc_remove_related_products( $args ) {
	return array();
}
add_filter('woocommerce_related_products_args','wc_remove_related_products', 10);

// Display 24 products per page. Goes in functions.php
// add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 30;' ), 20 );
// ajax response to return posts
add_action('wp_ajax_ajaxBlog', 'addPosts');
add_action('wp_ajax_nopriv_ajaxBlog', 'addPosts');
function addPosts() {
    global $post;

    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    $args = array(
        'paged' => $page,
        'orderby' => 'asc',
        'post_type' => array("product"),
        'posts_per_page' => 38
    );

    $results = new WP_Query($args);

    if ($results->have_posts()) :
    
    while ($results->have_posts()) : $results->the_post();
        
        woocommerce_get_template_part( 'content', 'product' );

    endwhile; endif;

    wp_reset_query();

    exit;

}

?>