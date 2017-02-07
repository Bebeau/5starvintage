<?php
// create custom plugin settings menu
add_action('admin_menu', 'notify_create_menu');

function notify_create_menu() {

	//create new top-level menu
	add_menu_page('Notify Settings', 'Notify Settings', 'administrator', __FILE__, 'notify_settings_page');

	//call register settings function
	add_action( 'admin_init', 'register_mysettings' );
}


function register_mysettings() {
	//register our settings
	register_setting( 'notify-settings-group', 'notify_message' );
	register_setting( 'notify-settings-group', 'notify_link' );
}

function notify_settings_page() { ?>
	<div class="wrap">

		<h2>Notify Settings</h2>

		<form method="post" action="options.php">

		    <?php settings_fields( 'notify-settings-group' ); ?>

		    <?php do_settings_sections( 'notify-settings-group' ); ?>

		    <table class="form-table">

		        <tr valign="top">
			        <th scope="row">Message</th>
			        <td><input class="widefat" type="text" name="notify_message" value="<?php echo esc_attr( get_option('notify_message') ); ?>" placeholder="add call to action.." /></td>
		        </tr>
		         
		        <tr valign="top">
			        <th scope="row">Button Link</th>
			        <td><input class="widefat" type="text" name="notify_link" value="<?php echo esc_attr( get_option('notify_link') ); ?>" placeholder="http://..."/></td>
		        </tr>

		    </table>
		    
		    <?php submit_button(); ?>

		</form>

	</div>
<?php } ?>