</div>

<footer id="footer">

	<div id="weaccept">
		we accept <img src="<?php bloginfo('template_directory'); ?>/assets/img/payment.png" alt="Pament Methods" />
	</div>

	<!-- Social bookmark icons in header -->
	<div id="footerSocial" class="hidden-xs">
		<a class="twitter-icon" href="https://twitter.com/5StarVintage" target="_blank">
			<i class="fab fa-twitter"></i>
		</a>
		<a class="tumblr-icon" href="https://www.sneakerbound.com" target="_blank">
			<i class="fab fa-tumblr"></i>
		</a>
		<a class="pinterest-icon" href="#" target="_blank">
			<i class="fab fa-pinterest"></i>
		</a>
		<a class="instagram-icon" href="https://instagram.com/5starvintage/" target="_blank">
			<i class="fab fa-instagram"></i>
		</a>
	</div>

	<?php 
		if ( has_nav_menu( 'footer-menu' ) ) {
			wp_nav_menu( array('menu' => 'Footer Menu' ) );
		};
	?>

	<!-- Social bookmark icons in header -->
	<div id="footerSocial" class="visible-xs">
		<a class="twitter-icon" href="https://twitter.com/5StarVintage" target="_blank">
			<i class="fab fa-twitter"></i>
		</a>
		<a class="tumblr-icon" href="https://www.sneakerbound.com" target="_blank">
			<i class="fab fa-tumblr"></i>
		</a>
		<a class="pinterest-icon" href="#" target="_blank">
			<i class="fab fa-pinterest"></i>
		</a>
		<a class="instagram-icon" href="https://instagram.com/5starvintage/" target="_blank">
			<i class="fab fa-instagram"></i>
		</a>
	</div>

	<div id="legal">
		Copyright © 2013 5 Star Vintage. All rights reserved. All logos and trademarks are the property of their respective owners. <br />
		<a href="http://theinitgroup.com" target="_blank">Web Design &amp; Development</a> by Kyle Bebeau.
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