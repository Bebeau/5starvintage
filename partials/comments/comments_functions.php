<?php

/*
URI: http://wphacks.com/log/how-to-add-spam-and-delete-buttons-to-your-blog/
*/ 

function delete_comment_link($id) {
    if (current_user_can('edit_post')) {
        echo '<a href="'.admin_url("comment.php?action=cdc&amp;c=$id").'" class="btn btn-mini">Delete </a>';
    }
}

// Use legacy comments on versions before WP 2.7
add_filter('comments_template', 'old_comments');

function old_comments($file) {

	if(!function_exists('wp_list_comments')) : // WP 2.7-only check
		$file = TEMPLATEPATH . '/comments-old.php';
	endif;

	return $file;
}
// Custom comment loop
function custom_comment($comment, $args, $depth) {	
       $GLOBALS['comment'] = $comment; ?>
	
<li class="comment wrap threaded" id="comment-<?php comment_ID() ?>">
		
	<div class="row">
		<div class="col-md-1 hidden-phone">
			<span class="thumbnail"><?php echo get_avatar( $comment->comment_author_email,48 ); ?></span>
		</div>
		<div class="col-md-11">
			<div class="<?php if (1 == $comment->user_id) $oddcomment = "authcomment"; echo $oddcomment; ?>">
             	<div class="row">
             		<div class="col-md-8">
             			<p class="authorcomment"> 
		             		<strong><?php comment_author_link() ?></strong> <span> at <?php comment_date('M d, Y h:i:s'); ?> </span>
		             	</p>
		             </div>
		             <div class="col-md-4">
		             	<span class="comm-reply pull-right">
						 	<?php edit_comment_link('Edit'.'', ''); ?>
						 	<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						 	<?php // delete_comment_link(get_comment_ID()); ?>
				 		</span>
				 	</div>
			 	</div>
 				<div class="commentcopy"><?php comment_text() ?></div>
 				<?php if ($comment->comment_approved == '0') : ?>
 					<p><em><?php echo get_option('ptthemes_comment_moderation_name'); ?></em></p>
 				<?php endif; ?>
 			</div>
		</div>
		<div class="clearfix"></div>
	</div>
		 
<?php } ?>