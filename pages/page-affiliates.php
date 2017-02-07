<?php
/**
 * Template Name: Affiliates Request
 */

global $current_user;
      get_currentuserinfo();
?>


<?php get_header(); ?>

<div id="wrapper"  class="clearfix">
	<div id="content" class="clearfix">
		<div class="container clearfix MainWrap" id="Vendors">
			
			<h1><span><?php the_title(); ?></span></h1>
			
			<div class="row"> 
				
				<div id="content" class="col-md-8 col-md-offset-2 PageWrap">

			    	<?php if(have_posts()) : ?>
						
						<?php while(have_posts()) : the_post() ?>
			        		
			        		<?php $pagedesc = get_post_meta($post->ID, 'pagedesc', $single = true); ?>
			        
			                <div id="post-<?php the_ID(); ?>" >
			                    <div class="entry"> 
			                        <?php the_content(); ?>
			                    </div>
			                </div>
			                
			            <?php endwhile;?>
			        
			        <?php endif; ?>

			        <hr>
						 
					<form class="form-horizontal" role="form" action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="vendors_frm" name="vendors_frm">
			            <input type="hidden" name="request_url" value="<?php echo $_SERVER['REQUEST_URI'];?>" />

			            <h2>Personal Account Information</h2>

			            <div class="form-group">
							<label for="name" class="col-sm-2 control-label">Name <span class="indicates">*</span></label>
							<div class="col-sm-10">
								<input type="name" id="name" class="form-control" value="<?php if($current_user->user_firstname != NULL) { echo $current_user->user_firstname . ' ' . $current_user->user_lastname; } ?>" placeholder="name">
							</div>
						</div>

						<div class="form-group">
							<label for="email" class="col-sm-2 control-label">Email <span class="indicates">*</span></label>
							<div class="col-sm-10">
								<input type="email" id="email" class="form-control" value="<?php if($current_user->user_email != NULL) { echo $current_user->user_email; } ?>" placeholder="email@address...">
							</div>
						</div>

						<div class="form-group">
							<label for="phonenumber" class="col-sm-2 control-label">Phone <span class="indicates">*</span></label>
							<div class="col-sm-10">
								<input type="text" id="phonenumber" class="form-control" value="<?php if($current_user->billing_phone != NULL) { echo $current_user->billing_phone; } ?>" placeholder="(555)-555-5555">
							</div>
						</div>

						<div id="security" class="hide">
							If you see this, leave this form field blank.
							<input type="text" name="password" id="password" value="" />
						</div>

						<div class="clearfix btn-wrap">
			            	<input type="submit" value="Submit Vendor Request" class="b_submit btn btn-primary btn-large pull-right" />
			            </div>
			        </form> 

					<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/contact_us_validation.js"></script>
			    </div><!-- content-in #end -->
			    
			    <!-- <div class="span4" id="RightSidebar">
					<?php // get_sidebar(); ?>
				</div> -->

			</div> <!-- row end -->
		</div> <!-- page #end -->
		<div class="visible-lg">
			<?php get_template_part( 'partials/homepage/tabs', 'homepage' ); ?>
		</div>
	</div>
</div><!-- wrapper #end -->
<?php get_footer(); ?>