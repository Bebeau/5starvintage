<div class="modal fade" id="NavRegister">
	
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title"><?php _e( 'Register', 'woocommerce' ); ?></h4>
	</div>

	<form method="post" class="register form-horizontal">

		<div class="modal-body">
			<?php if ( get_option( 'woocommerce_registration_email_for_username' ) == 'no' ) : ?>
				<div class="form-row form-row-first control-group">
					<label for="reg_username" class="control-label"><?php _e( 'Username', 'woocommerce' ); ?> <span class="required">*</span></label>
					<div class="controls">
						<input type="text" class="input-text" name="username" id="reg_username" value="<?php if (isset($_POST['username'])) echo esc_attr($_POST['username']); ?>" />
					</div>
				</div>
				<div class="form-row form-row-last">
			<?php else : ?>
			<div class="form-row form-row-wide control-group">
			<?php endif; ?>
				<label for="reg_email" class="control-label"><?php _e( 'Email', 'woocommerce' ); ?> <span class="required">*</span></label>
				<div class="controls">
					<input type="email" class="input-text input-block-level" name="email" id="reg_email" value="<?php if (isset($_POST['email'])) echo esc_attr($_POST['email']); ?>" />
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="form-row form-row-first control-group">
				<label for="reg_password" class="control-label"><?php _e( 'Password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<div class="controls">
					<input type="password" class="input-text input-block-level" name="password" id="reg_password" value="<?php if (isset($_POST['password'])) echo esc_attr($_POST['password']); ?>" />
				</div>
			</div>
			<div class="form-row form-row-last control-group">
				<label for="reg_password2" class="control-label"><?php _e( 'Re-enter password', 'woocommerce' ); ?> <span class="required">*</span></label>
				<div class="controls">
					<input type="password" class="input-text input-block-level" name="password2" id="reg_password2" value="<?php if (isset($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
				</div>
			</div>
			<div class="clearfix"></div>
			<!-- Spam Trap -->
			<div style="left:-999em; position:absolute;">
				<label for="trap">Anti-spam</label>
				<input type="text" name="email_2" id="trap" tabindex="-1" />
			</div>
			<?php do_action( 'register_form' ); ?>
		</div>

		<div class="modal-footer">	
			<p class="form-row pull-right">
				<?php $woocommerce->nonce_field('register', 'register') ?>
				<input type="submit" class="button btn btn-large" name="register" value="<?php _e( 'Register', 'woocommerce' ); ?>" />
			</p>
		</div>

	</form>
	
</div>