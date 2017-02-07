<?php
/**
 * Change password form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

global $woocommerce;
?>

<div class="modal fade" id="ChangePassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">

			<form action="<?php echo esc_url( get_permalink(woocommerce_get_page_id('change_password')) ); ?>" method="post" class="form-horizontal changepassword clearfix">
			
				<div class="modal-header">
					<h4 class="modal-title">Change Password</h4>
				</div>

				<div class="modal-body">

					<div class="row">
						
						<div class="col-md-8 col-md-offset-2">
						
							<div class="form-group">
								<label for="password_1"><?php _e('New password', 'woocommerce'); ?> <span class="required">*</span></label>
								<input type="password" class="form-control" name="password_1" id="password_1" />
							</div>
					
							<div class="form-group">
								<label for="password_2"><?php _e('Re-enter new password', 'woocommerce'); ?> <span class="required">*</span></label>
								<input type="password" class="form-control" name="password_2" id="password_2" />
							</div>
						
						</div>

					</div>

				</div>

				<div class="modal-footer">

					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

					<input type="submit" class="btn btn-primary" name="change_password" value="<?php _e('Save', 'woocommerce'); ?>" />
			
					<?php $woocommerce->nonce_field('change_password')?>
			
					<input type="hidden" name="action" value="change_password" />
				
				</div>

			</form>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->