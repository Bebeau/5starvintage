<header class="HomeHeader hidden-sm hidden-xs">
	<?php 
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
	<div class="container-fluid">

		<div class="row clearfix">
			<!-- Left Nav -->
			<div class="col-lg-5 col-md-5 home-menu HeaderMenuLeft">
				<ul class="list-unstyled row">
					<li class="col-lg-4 col-md-4 col-sm-4">
						<a class="parent" href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>">
							Shop
						</a>
					</li>
					<li class="col-lg-4 col-md-4 col-sm-4 arrow">
						<a class="parent" href="<?php echo get_permalink(1705); ?>">
							Size
						</a>
						<div class="size-dropdown">
							<ul class="list-unstyled">
								<li>
									<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>?filter_size=17">
										Small
									</a>
								</li>
								<li>
									<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>?filter_size=16">
										Medium
									</a>
								</li>
								<li>
									<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>?filter_size=15">
										Large
									</a>
								</li>
								<li>
									<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>?filter_size=18">
										X-Large
									</a>
								</li>
								<li>
									<a href="<?php echo get_permalink( woocommerce_get_page_id( 'shop' ) ); ?>?filter_size=19">
										2X-Large
									</a>
								</li>
							</ul>
						</div>
					</li>
					<li class="col-lg-4 col-md-4 col-sm-4 arrow">
						<a class="parent" href="<?php echo get_permalink(1707); ?>">
							Categories
						</a>
					</li>
				</ul>
			</div>
			<!-- Logo -->
			<div class="col-lg-2 col-md-2 logo">
				<a href="<?php echo site_url(); ?>" class="arrow">
					<img src="<?php bloginfo('template_directory'); ?>/assets/img/logo.png" alt="5 Star Vintage" />
				</a>
			</div>
			<!-- Right Nav -->
			<div class="col-lg-5 col-md-5 home-menu HeaderMenuRight">
				<ul class="list-unstyled row">
					<!-- Login -->
					<li class="col-lg-4 col-md-4 menu-item NavLogin">
						<div class="ParentNav">
							<?php if (is_user_logged_in()) { 
								global $current_user;
									get_currentuserinfo();
							?>
							<a href="<?php echo site_url('/my-account'); ?>" class="loggedin">
								My Account
							</a>
						</div>
						<?php } else { ?>
							<a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
								Login / Register
							</a>
						<?php } ?>
					</li>

					<!-- Nav Mini Cart Display -->
					<li class="col-lg-4 col-md-4 menu-item NavCart">
						<div class="ParentNav">
							<?php global $woocommerce; ?>
							<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="navlink parentnav cartbutton">
								<i class="fa fa-shopping-cart"></i> ( <?php echo $woocommerce->cart->get_cart_contents_count(); ?> ) 
								<?php echo $woocommerce->cart->get_cart_subtotal(); ?>
							</a>
						</div>
					</li>

					<!-- Social bookmark icons in header -->
					<li class="col-lg-4 col-md-4 menu-item Bookmarks">
						<a class="twitter-icon" href="https://twitter.com/5StarVintage" target="_blank">
							<i class="fa fa-twitter"></i>
						</a>
						<a class="tumblr-icon" href="https://www.sneakerbound.com" target="_blank">
							<i class="fa fa-tumblr"></i>
						</a>
						<a class="pinterest-icon" href="#" target="_blank">
							<i class="fa fa-pinterest"></i>
						</a>
						<a class="instagram-icon" href="https://instagram.com/5starvintage/" target="_blank">
							<i class="fa fa-instagram"></i>
						</a>
					</li>

				</ul>
			</div>
		</div>

	</div>

</header>