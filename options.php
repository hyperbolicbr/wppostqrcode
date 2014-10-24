<?php 
add_action('admin_init', 'wppostqrcodeoptions_init' );
add_action('admin_menu', 'wppostqrcodeoptions_add_page');

// Init plugin options to white list our options
function wppostqrcodeoptions_init(){
	register_setting( 'wppostqrcodeoptions', 'wppostqrcodefields');
	if (get_option('wppostqrcodefields') == null)
		update_option('wppostqrcodefields', array("post_types"=>array("page", "post")));
}

// Add menu page
function wppostqrcodeoptions_add_page() {
	add_options_page('WP Post QR Code', 'WP Post QR Code', 'manage_options', 'wppostqrcodeoptions_page', 'wppostqrcodeoptions_do_page');
}

// Draw the menu page itself
function wppostqrcodeoptions_do_page() {
	?>
	<div class="wrap">
		<h2>WP Post QR Code</h2>
		<p>Select below in which post type QR Codes will appear:</p>
		<form method="post" action="options.php">
			<?php settings_fields('wppostqrcodeoptions'); ?>
			<?php $options = get_option('wppostqrcodefields'); ?>
			<table class="form-table">
				<tr valign="top"><th scope="row">Post types</th>
					<td>
						<?php
							$post_types = get_post_types( '', 'names' ); 
							foreach ( $post_types as $post_type ) {
						?>
						   <label><input type="checkbox" name="wppostqrcodefields[post_types][]" value="<?php echo $post_type; ?>" <?php if (in_array($post_type, $options["post_types"])) { ?>checked="checked"<?php } ?> /> <?php echo $post_type; ?></label><br />
						<?php } ?>
					</td>
				</tr>
			</table>
			<p class="submit">
			<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
			</p>
		</form>
	</div>
	<?php	
}