<?php

global $post;

// Hide admin bar
add_filter('show_admin_bar', '__return_false');

function theme_styles() {
	// Register & Load Styles
	wp_enqueue_style( 'Style CSS', get_bloginfo( 'template_url' ) . '/style.css?foo', 'all' );
	
	// Load default Wordpress jQuery
	wp_deregister_script('jquery');
	wp_enqueue_script('jquery', 'https://code.jquery.com/jquery.min.js', '', null, false );
	wp_enqueue_script('bootstrap', 'https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js', '', null, false );

	// Load Custom JS
	wp_enqueue_script('custom', get_bloginfo( 'template_url' ) . '/assets/js/custom.min.js?foo', array('jquery'), null, true);
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
		// wp_dequeue_style( 'select2' );
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

// overwrite woocommerce default widgets & unregister unused widgets
function override_woocommerce_widgets() {
	
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

// Shop filter options above products. Remove the defaults display, and add a custom display.
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
remove_action('woocommerce_single_product_title', 'woocommerce_template_single_title', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

add_action('woocommerce_before_single_product', 'woocommerce_template_single_title', 10);
add_action('woocommerce_before_shop_loop', 'woocommerce_get_sidebar', 10);

add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );

function woocommerce_template_product_description() {
	wc_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );

// incude notify plugin
include_once(TEMPLATEPATH . '/partials/plugins/notify.php');

// ajax response to return products
add_action('wp_ajax_ajaxBlog', 'addPosts');
add_action('wp_ajax_nopriv_ajaxBlog', 'addPosts');
function addPosts() {
    global $post;

    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;
    $cat = (isset($_POST['cat'])) ? $_POST['cat'] : 0;

    if(!empty($cat) & $cat !== "localhost:8888" && $cat !== "5starvintage.com") {

        $terms = get_term_by('slug', $cat, 'product_cat');
        $catID = $terms->term_id;

        $args = array(
            'paged' => $page,
            'posts_per_page' => get_option( 'posts_per_page' ),
            'post_type' => 'product',
            'post_status' => 'publish',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $catID,
                    'include_children' => true,
                    'operator' => 'IN'
                )
            )
        );

    } else {
        $args = array(
            'paged' => $page,
            'posts_per_page' => get_option( 'posts_per_page' ),
            'post_type' => 'product',
            'post_status' => 'publish'
        );
    }

    $results = new WP_Query($args);

    if ($results->have_posts()) :
    
    while ($results->have_posts()) : $results->the_post();
        
        woocommerce_get_template_part( 'content', 'product' );

    endwhile; endif;

    wp_reset_query();

    wp_die();

}

add_filter( 'loop_shop_per_page', 'new_loop_shop_per_page', 20 );

function new_loop_shop_per_page( $cols ) {
  // $cols contains the current number of products per page based on the value stored on Options -> Reading
  // Return the number of products you wanna show per page.
  $cols = 64;
  return $cols;
}

function fb_purchase_pixel() {
	?>
	<!-- Paste Tracking Code Under Here -->
	<script>
		fbq('track', 'Purchase');
	</script>
	<!-- End Tracking Code -->
	<?php	
}
add_action( 'woocommerce_thankyou', 'fb_purchase_pixel' );

function fb_checkout_pixel() {
	?>
	<!-- Paste Tracking Code Under Here -->
	<script>
		fbq('track', 'InitiateCheckout');
	</script>
	<!-- End Tracking Code -->
	<?php	
}
add_action( 'woocommerce_before_checkout_form', 'fb_checkout_pixel' );

function fb_cart_pixel() {
	?>
	<!-- Paste Tracking Code Under Here -->
	<script>
		var total = document.getElementsByClassName("woocommerce-Price-amount")[0].innerHTML.replace(/<(?:.|\n)*?>/gm, '').replace(/[&\/\\#,+()$~%'":*?<>{}]/g, '');
		fbq('track', 'AddToCart', {
			value: total,
			currency: 'USD'
		});
	</script>
	<!-- End Tracking Code -->
	<?php	
}
add_action( 'woocommerce_before_cart', 'fb_cart_pixel' );

// Custom Scripting to Move JavaScript from the Head to the Footer
function remove_head_scripts() { 
   remove_action('wp_head', 'wp_print_scripts'); 
   remove_action('wp_head', 'wp_print_head_scripts', 9); 
   remove_action('wp_head', 'wp_enqueue_scripts', 1);

   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5);
} 
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );

?>