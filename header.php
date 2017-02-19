<!DOCTYPE html>
<html <?php language_attributes(); ?> xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- the meta information for the page -->
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<!-- page title -->
	<title><?php wp_title(); ?></title>

	<meta name="msvalidate.01" content="0535308D0ACAABA55BA3455CB59F43C3" />
	<meta http-equiv="pragma" content="no-store" />
	<meta http-equiv="cache-control" content="no-store" />
	<meta name="robots" content="all" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!-- Facebook open graph tags -->
	<meta property="og:title" content="<?php the_title(); ?>"/>
	<meta property="og:description" content="<?php
	  if ( function_exists('wpseo_get_value') ) {
	    echo wpseo_get_value('metadesc');
	  } else {
	    echo $post->post_excerpt;
	  }
	?>"/>
	<meta property="og:url" content="<?php the_permalink(); ?>"/>
	<meta property="og:image" content="<?php // echo get_fbimage(); ?>"/>
	<meta property="og:type" content="<?php
	  if (is_single() || is_page()) { echo "article"; } else { echo "website";}
	?>"/>
	<meta property="og:site_name" content="<?php bloginfo('name'); ?>"/>
	<!-- <meta property="og:street-address" content=""/>
	<meta property="og:locality" content=""/>
	<meta property="og:region" content=""/>
	<meta property="og:postal-code" content=""/> -->
	<meta property="og:country-name" content="USA"/>
	
	<!-- Wordpress Header -->
	<?php wp_head(); ?>
	
	<!-- Google Verifiication For Webmaster Tools -->
	<meta name="google-site-verification" content="N2oxqfH1JJ3fJJSIq0HF0hxcP_52cSuIM_jTgSVZP6Y" />

</head>
	
	<body <?php body_class(); ?>>

	<?php 
		global $options;
		$link = get_option('notify_link');
		$message = get_option('notify_message');

		if($link && $message ) {
			echo '<div id="notifyBar">';
				echo '<a class="btn" href="'.$link.'" target="_blank">';
					echo $message;
				echo '</a>';
				echo '<i class="fa fa-close notify-close"></i>';
			echo '</div>';
		}
	?>

	<div id="wrapper">
		<header id="header" class="hidden-xs">
			<?php 

				if(is_cart()) {
					echo '<p id="freeShipMessage">Free shipping with all orders over $35.00.</p>';
				}

				global $options;
				$link = get_option('notify_link');
				$message = get_option('notify_message');
				$button = get_option('notify_button');

				if($link && $message && $button) {
					echo '<div id="notifyBar">';
						echo $message;
						echo '<a href="'.$link.'" class="btn btn-default btn-large">';
							echo $button;
						echo '</a>';
						echo '<i class="fa fa-close"></i>';
					echo '</div>';
				}
			?>

			<!-- logo -->
			<div class="parent" id="logo">
				<a href="<?php echo site_url(); ?>">
					<img src="<?php bloginfo('template_directory'); ?>/assets/img/logo.png" alt="5 Star Vintage" />
				</a>
			</div>

			<div class="rightside">
				<!-- account link -->
				<div class="parent" id="account">
					<?php if (is_user_logged_in()) { 
						global $current_user;
						wp_get_current_user();
					?>
						<a href="<?php echo site_url('/my-account'); ?>" class="loggedin">
							My Account
						</a>
					<?php } else { ?>
						<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
							Login / Register
						</a>
					<?php } ?>
				</div>

				<div class="parent" id="cart">
					<?php global $woocommerce; ?>
					<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="navlink parentnav cartbutton">
						<i class="fa fa-shopping-cart"></i> <?php echo $woocommerce->cart->get_cart_contents_count(); ?> 
						 / <?php echo $woocommerce->cart->get_cart_subtotal(); ?>
					</a>
				</div>
			</div>
		</header>
		<header id="header" class="visible-xs">
			<div class="navbar-collapse nav-collapse collapse" id="mobile-nav">
				<ul class="nav list-unstyled clearfix" id="MobileDropdownNav">
					<li>
						<h3>
							<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
								View All Product <i class="fa fa-angle-double-right"></i>
							</a>
						</h3>
					</li>
					<li>
						<h3><button data-toggle="collapse" data-target="#category-list">Shop By Categories <i class="fa fa-align-justify"></i></button></h3>
						<ul id="category-list" class="collapse list-unstyled">
							<?php
								$counter = 0;
								$args = array(
									'hide_empty' 	=> 1, 
									'orderby'		=> 'title', 
									'order' 		=> 'ASC'
								);
								$catTerms = get_terms('product_cat', $args);
								shuffle ($catTerms);
								foreach($catTerms as $catTerm) {
							?>
								<li>
									<a href="<?php echo get_term_link($catTerm); ?>">
										<?php echo $catTerm->name; ?>
									</a>
								</li>
							<?php }; ?>
						</ul>
					</li>
					<li>
						<h3><button data-toggle="collapse" data-target="#brand-list">Shop By Brands <i class="fa fa-align-justify"></i></button></h3>
						<ul id="brand-list" class="collapse list-unstyled">
							<?php
								$counter = 0;
								$args = array(
									'hide_empty' 	=> 0, 
									'orderby'		=> 'title', 
									'order' 		=> 'ASC'
								);
								$brandTerms = get_terms('product_brand', $args);
								shuffle ($brandTerms);
								foreach($brandTerms as $brandTerm) {
							?>
								<li>
									<a href="<?php echo get_term_link($brandTerm); ?>">
										<?php echo $brandTerm->name; ?>
									</a>
								</li>
							<?php }; ?>
						</ul>
					</li>
					<li id="Search">
						<form role="search" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
						    <div class="input-group">
						        <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" class="form-control" placeholder="<?php _e( 'Search for products...', 'woocommerce' ); ?>" />
						        <span class="input-group-btn">
						        	<button type="button" id="searchsubmit" value="go" class="btn btn-default">
							        	<i class="fa fa-search"></i>
							    	</button>
							    </span>
						    </div>
						    <input type="hidden" name="post_type" value="product" />
						</form>
					</li>
				</ul>
			</div>
			<ul class="nav list-unstyled clearfix" id="MainMobileNav">
				<li class="col-xs-5" id="Menu">
					<button class="nav-collapse collapsed" data-toggle="collapse" data-target="#mobile-nav">
						<i class="fa fa-bars"></i> Menu
					</button>
				</li>
				<li class="col-xs-2" id="MobileLogo">
					<div class="logo">
						<a href="<?php echo site_url(); ?>">
							<img src="<?php bloginfo('template_directory'); ?>/assets/img/logo.png" alt="5 Star Vintage" />
							<h1 class="hide">5 Star Vintage</h1>
						</a>
					</div>
				</li>
				<li class="col-xs-5" id="Cart">
					<?php global $woocommerce; ?>
					<a href="<?php echo site_url('/cart'); ?>">
						Cart ( <?php echo $woocommerce->cart->get_cart_contents_count(); ?> ) <br />
						<?php echo $woocommerce->cart->get_cart_subtotal(); ?>
					</a>
				</li>
			</ul>
		</header>
		<?php if(wp_is_mobile()) {
			echo '<p id="freeShipMessage">Free shipping with all orders over $35.00.</p>';
		} ?>