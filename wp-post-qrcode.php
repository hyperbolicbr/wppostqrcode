<?php
/*
Plugin Name: WP Post QR Code 
Plugin URI: http://blog.hyperbolic.com.br/wp-post-qrcode
Description: Generate a QR Code for each post
Author: Hyperbolic
Version: 1.0
Author URI: http://www.hyperbolic.com.br
*/

require_once(plugin_dir_path( __FILE__ )."options.php");

function wppostqrcode_meta_box() {
	
	$options = get_option('wppostqrcodefields');
	$screens = $options["post_types"];

	foreach ( $screens as $screen ) {
		if ($_GET["action"]=="edit")
			add_meta_box('wppostqrcode','QR Code','wppostqrcode_meta_box_callback',$screen);
	}
}
add_action( 'add_meta_boxes', 'wppostqrcode_meta_box' );

function wppostqrcode_meta_box_callback( $post ) {
	echo "<p style='text-align:center;'><img src='https://chart.googleapis.com/chart?cht=qr&chs=500x500&chl=".get_permalink($post->ID)."'/></p>";
}