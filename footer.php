</div>

<footer id="footer">
	<div class="container hidden-xs">
		<div class="container-fluid">
			<div class="row" id="about">
				<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Copy')) : else : ?>
					<div class="col-md-6">
						<h3>About 5 Star Vintage</h3>
						<p>
							5 Star Vintage is a company that caters to the masses of men and woman, both young and old, 
							who wish to embrace the clothing styles of the 1980s and 1990s. Our products are spread across 
							the entire vintage spectrum, from suave pull-overs, to classic team jerseys, which are all found 
							within the popular brand names of the eras. All in all, our products come at the best prices around, 
							as our motto will tell you, “… providing vintage clothing without breaking the bank.” We guarantee 
							satisfaction with every customer we serve, while bringing forth a new style that is both retro, 
							and fashionable.
						</p>
					</div>
		    	<?php endif; ?>

		    	<?php 

		    		if ( has_nav_menu( 'help-menu' ) ) {

		    			echo "<div class='col-md-2'>";
			    			echo "<h3>Need Help?</h3>";
			    			wp_nav_menu( array('menu' => 'Need Help?' ) );
		    			echo "</div>";

		    		} else { ?>
			    		<div class="col-md-2">
			    			<h3>Need Help?</h3>
			    			<ul class="list-unstyled">
			    				<li><a href="#">Terms Of Use</a></li>
			    				<li><a href="#">Privacy Policy</a></li>
			    				<li><a href="#">Return &amp; Exchanges</a></li>
			    				<li><a href="#">Buying FAQ's</a></li>
			    				<li><a href="#">Contact Us</a></li>
			    			</ul>
			    		</div>
		    	<?php }; ?>
		    	
		    	<?php 
		    	if ( has_nav_menu( 'involved-menu' ) ) {

		    		echo "<div class='col-md-2'>";
		    			echo "<h3>Get Involved!</h3>";
		    			wp_nav_menu( array('menu' => 'Get Involved!' ) );
	    			echo "</div>";

		    	} else { ?>
		    		<div class="col-md-2">
		    			<h3>Get Involved!</h3>
		    			<ul class="list-unstyled">
		    				<li><a href="#">Affiliates Program</a></li>
		    				<li><a href="#">Send In Clothes</a></li>
		    				<li><a href="#">Bounty Posters</a></li>
		    			</ul>
		    		</div>
		    	<?php }; ?>
			    

		    	<?php 
		    	if ( has_nav_menu( 'connect-menu' ) ) {

		    		echo "<div class='col-md-2'>";
		    			echo "<h3>Connect With Us!</h3>";
		    			wp_nav_menu( array('menu' => 'Connect With Us!' ) );
	    			echo "</div>";

		    	} else { ?>
		    		<div class="col-md-2">
		    			<h3>Connect With Us!</h3>
		    			<ul class="list-unstyled">
		    				<li><i class="fa fa-facebook"></i> <a href="#" target="_blank">Facebook</a></li>
		    				<li><i class="fa fa-twitter"></i> <a href="https://twitter.com/5StarVintage" target="_blank">Twitter</a></li>
		    				<li><i class="fa fa-instagram"></i> <a href="https://instagram.com/5starvintage/" target="_blank">Instagram</a></li>
		    				<li><i class="fa fa-pinterest"></i> <a href="#" target="_blank">Pinterest</a></li>
		    				<li><i class="fa fa-tumblr"></i> <a href="https://www.sneakerbound.com" target="_blank">Tumblr</a></li>
		    			</ul>
					</div>
		    	<?php }; ?>
			</div>

			<div class="row" id="payment">
				<div class="centered col-md-12">
					we accept <img src="<?php bloginfo('template_directory'); ?>/assets/img/payment.png" alt="Pament Methods" />
				</div>
			</div>

			<div class="row" id="legal">
				<div class="col-md-12">
					Copyright © 2013 5 Star Vintage. All rights reserved. All logos and trademarks are the property of their respective owners. <br />
					<a href="http://theinitgroup.com" target="_blank">Los Angeles Web Design</a> by The INiT Group.
				</div>
			</div>

		</div>
	</div>

	<div class="visible-xs" id="about">
				
		<?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Footer Copy')) : else : ?>
			<div>
				<h3><button data-toggle="collapse" data-target="#about5star">About 5 Star Vintage <i class="fa fa-align-justify"></i></button></h3>
				<p id="about5star" class="collapse collapsed">
					5 Star Vintage is a company that caters to the masses of men and woman, both young and old, 
					who wish to embrace the clothing styles of the 1980s and 1990s. Our products are spread across 
					the entire vintage spectrum, from suave pull-overs, to classic team jerseys, which are all found 
					within the popular brand names of the eras. All in all, our products come at the best prices around, 
					as our motto will tell you, “… providing vintage clothing without breaking the bank.” We guarantee 
					satisfaction with every customer we serve, while bringing forth a new style that is both retro, 
					and fashionable.
				</p>
			</div>
    	<?php endif; ?>

    	<?php 

    		if ( has_nav_menu( 'help-menu' ) ) {

    			echo "<div>";
	    			echo '<h3><button data-toggle="collapse" data-target="#HelpMenu">Need Help? <i class="fa fa-align-justify"></i></button></h3>';
	    			wp_nav_menu( array(
	    				'menu' => 'Need Help?',
	    				'menu_id' => 'HelpMenu',
	    				'menu_class' => 'collapsed collapse list-unstyled' 
	    			));
    			echo "</div>";

    		} else { ?>
	    		<div>
	    			<h3><button data-toggle="collapse" data-target="#HelpMenu">Need Help? <i class="fa fa-align-justify"></i></button></h3>
	    			<ul class="list-unstyled collapsed collapse list-unstyled">
	    				<li><a href="#">Terms Of Use</a></li>
	    				<li><a href="#">Privacy Policy</a></li>
	    				<li><a href="#">Return &amp; Exchanges</a></li>
	    				<li><a href="#">Buying FAQ's</a></li>
	    				<li><a href="#">Contact Us</a></li>
	    			</ul>
	    		</div>
    	<?php }; ?>
    	
    	<?php 
    	if ( has_nav_menu( 'involved-menu' ) ) {

    		echo "<div>";
    			echo '<h3><button data-toggle="collapse" data-target="#InvolvedMenu">Get Involved! <i class="fa fa-align-justify"></i></button></h3>';
    			wp_nav_menu( array(
    				'menu' => 'Get Involved!',
    				'menu_id' => 'InvolvedMenu',
    				'menu_class' => 'collapsed collapse list-unstyled' 
    			));
			echo "</div>";

    	} else { ?>
    		<div>
    			<h3><button data-toggle="collapse" data-target="#InvolvedMenu">Get Involved! <i class="fa fa-align-justify"></i></button></h3>
    			<ul class="list-unstyled collapsed collapse list-unstyled">
    				<li><a href="#">Affiliates Program</a></li>
    				<li><a href="#">Send In Clothes</a></li>
    				<li><a href="#">Bounty Posters</a></li>
    			</ul>
    		</div>
    	<?php }; ?>
	    
    	<?php 
    	if ( has_nav_menu( 'connect-menu' ) ) {

    		echo "<div>";
    			echo '<h3><button data-toggle="collapse" data-target="#ConnectMenu">Connect With Us! <i class="fa fa-align-justify"></i></button></h3>';
    			wp_nav_menu( array(
    				'menu' => 'Connect With Us!',
    				'menu_id' => 'ConnectMenu',
    				'menu_class' => 'collapse collapsed list-unstyled'
    			));
			echo "</div>";

    	} else { ?>
    		<div>
    			<h3><button data-toggle="collapse" data-target="#ConnectMenu">Connect With Us! <i class="fa fa-align-justify"></i></button></h3>
    			<ul class="list-unstyled collapsed collapse" id="ConnectMenu">
    				<li><a href="#" target="_blank"><i class="fa fa-facebook"></i> Facebook</a></li>
    				<li><a href="https://twitter.com/5StarVintage" target="_blank"><i class="fa fa-twitter"></i> Twitter</a></li>
    				<li><a href="https://instagram.com/5starvintage/" target="_blank"><i class="fa fa-instagram"></i> Instagram</a></li>
    				<li><a href="#" target="_blank"><i class="fa fa-pinterest"></i> Pinterest</a></li>
    				<li><a href="https://www.sneakerbound.com" target="_blank"><i class="fa fa-tumblr"></i> Tumblr</a></li>
    			</ul>
			</div>
    	<?php }; ?>

    	<div class="row" id="payment">
			<div class="centered col-md-12">
				we accept <img src="<?php bloginfo('template_directory'); ?>/assets/img/payment.png" alt="Pament Methods" />
			</div>
		</div>

		<div class="row" id="legal">
			<div class="col-md-12">
				Copyright © 2013 5 Star Vintage. All rights reserved. All logos and trademarks are the property of their respective owners. <br />
				<a href="http://theinitgroup.com" target="_blank">Los Angeles Web Design</a> by The INiT Group.
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>

<!-- Google Analytics Code -->
<script type="text/javascript">
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-44007005-2', '5starvintage.com');
	ga('send', 'pageview');
</script>

</body>
</html>