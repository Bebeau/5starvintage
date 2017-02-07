<?php

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		This post is password protected. Enter the password to view comments.
	<?php
		return;
	}
?>

<?php if ( have_comments() ) : ?>
	
	<h3 id="comments">
		<?php comments_number('No Responses', 'One Response', '% Responses' );?>
	</h3>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>

	<ul class="commentlist list-unstyled">
		<?php wp_list_comments('avatar_size=48&callback=custom_comment'); ?>
	</ul>

	<div class="navigation">
		<div class="next-posts"><?php previous_comments_link() ?></div>
		<div class="prev-posts"><?php next_comments_link() ?></div>
	</div>
	
 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ( comments_open() ) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php else : // comments are closed ?>
		<p>Comments are closed.</p>

	<?php endif; ?>
	
<?php endif; ?>

<?php if ( comments_open() ) : ?>

<div id="respond">

	<h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>

	<div class="cancel-comment-reply">
		<?php cancel_comment_reply_link(); ?>
	</div>

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p>You must be <a href="<?php echo wp_login_url( get_permalink() ); ?>">logged in</a> to post a comment.</p>
	<?php else : ?>

	<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

		<?php if ( is_user_logged_in() ) : ?>

			<p class="alert alert-info">
				Logged in as <strong><?php echo $user_identity; ?></strong>. 
				<a class="logout" href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a>
			</p>

		<?php else : ?>
			<div class="row-fluid">
				<div class="col-md-4">
					<label for="author">Name <?php if ($req) echo "<span class='required'>*</span>"; ?></label>
					<input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" class="form-control" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />
				</div>

				<div class="col-md-4">
					<label for="email">Mail <?php if ($req) echo "<span class='required'>*</span>"; ?> <span class="small-text oblique">(will not be published)</span></label>
					<input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" class="form-control" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />
				</div>

				<div class="col-md-4">
					<label for="url">Website</label>
					<input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" class="form-control" tabindex="3" />
				</div>
			</div>

		<?php endif; ?>

		<!--<p>You can use these tags: <code><?php echo allowed_tags(); ?></code></p>-->

		<div>
			<textarea name="comment" id="comment" rows="5" tabindex="4" class="form-control"></textarea>
			<br />
		</div>

		<div class="pull-right">
			<input name="submit" type="submit" id="submit" class="btn btn-primary btn-large" tabindex="5" value="Submit Comment" />
			<?php comment_id_fields(); ?>
		</div>

		<div class="clearfix"></div>
		
		<?php do_action('comment_form', $post->ID); ?>

	<?php endif; // If registration required and not logged in ?>

	</form>
	
</div>
<div class="clearfix"></div>

<?php endif; ?>
