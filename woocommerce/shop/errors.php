<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if ( ! $errors ) return;
?>

<?php foreach ( $errors as $error ) : ?>
	<p class="alert alert-danger"><button type="button" class="close" data-dismiss="alert"><i class="fa fa-times"></i></button><?php echo $error; ?></p>
<?php endforeach; ?>