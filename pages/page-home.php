<?php
/**
 * Template Name: Home Page
 */ 
?>
<?php get_header("blank");?>

<section class="hidden-xs" id="HomepageWrap">

	<article id="slide1" class="homeSection slide" style="background: url('<?php bloginfo('template_directory'); ?>/assets/img/backgrounds/3.jpg') no-repeat scroll center / cover;">
		<div class="outer">
			<div class="inner">
				<?php get_template_part( 'partials/homepage/head', 'home' ); ?>
				<?php get_template_part( 'partials/homepage/newarrivals', 'homepage' ); ?>
			</div>
		</div>
	</article>

</section>

<div class="visible-xs">
	<?php get_template_part( 'partials/homepage/mobile', 'homepage' ); ?>
</div>

<?php get_footer('home'); ?>