<?php
/**
 * Template Name: Contact Us
 */
?>

<?php get_header(); ?>

<div id="wrapper"  class="clearfix">
	<div id="content" class="clearfix">
		<div class="container clearfix MainWrap" id="Contact">
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

			        <div id="successMessage" class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Success! Your message was sent. We will get back to you shortly.
					</div>
					<div id="failureMessage" class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						Make sure you fill out all the required fields!
					</div>
						 
					<form action="<?php bloginfo('template_directory'); ?>/partials/contact.php" method="post" id="contact_frm" name="contact_frm" class="form-horizontal" role="form">
			            <input type="hidden" name="request_url" value="#" />

			            <div class="form-group">
							<label for="name" class="control-label col-sm-2"> Name <span class="indicates">*</span></label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="name" name="name" placeholder="name">
							</div>
						</div>

						 <div class="form-group">
							<label for="emailaddress" class="control-label col-sm-2"> Email <span class="indicates">*</span></label>
							<div class="col-sm-10">
								<input type="email" class="form-control" id="emailaddress" name="emailaddress" placeholder="email@address...">
							</div>
						</div>

						<div class="form-group">
							<label for="message" class="control-label col-sm-2"> Message <span class="indicates">*</span></label>
							<div class="col-sm-10">
								<textarea type="text" class="form-control" id="message" name="message" placeholder="your message..."></textarea>
							</div>
						</div>

						<div id="security" class="hide">
							If you see this, leave this form field blank.
							<input type="text" name="password" id="password" value="" />
						</div>

						<div class="clearfix btn-wrap">
			            	<input type="submit" value="Send Message" class="b_submit btn btn-primary btn-large pull-right" />
			            </div>

			            <input type="hidden" name="submitted" id="submitted" value="true" />

			        </form> 

			    </div><!-- content-in #end -->

			</div> <!-- row end -->
		</div> <!-- page #end -->
	</div>
</div><!-- wrapper #end -->

<?php get_footer(); ?>
