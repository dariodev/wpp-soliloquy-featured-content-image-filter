<?php
/*
Plugin Name: wpPERFORM.com Soliloquy Featured Content Image Filter
Description: Sets an image in a custom field of Slider to the Soliloquy Featured Content image
Version: 0.7
License: GPL
Author: The wpPERFORM.com Team with props to Thomas J. Griffin
Author URI: http://wpperform.com
 
*/

// register activation hook to only activate this plugin if requirements met
register_activation_hook( __FILE__, 'wpp_sfcif_activation_hook' );

// set activation requirements
function wpp_sfcif_activation_hook() {

	if (!is_plugin_active('soliloquy-featured-content/soliloquy-featured-content.php')) {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( sprintf( __( 'Sorry, you can\'t activate unless you have activated <a href="%s">Soliloquy Featured Content Addon</a>', 'apl' ), 'http://soliloquywp.com/addons/featured-content/' ) );
	}	
}

// set a filter in case there is no featured image
add_filter( 'tgmsp_fc_no_featured_image', 'wpp_soliloquy_force_image', 10, 4 );

function wpp_soliloquy_force_image( $bool, $image, $id, $post ) {

	// Now we can get our image URL and use that instead.
	// It is expected that an array with the image URL, width and height be returned
	// width and heigth aren't used by default, so you can pass 0 in or the slider dimensions
	if ( $src = get_post_meta( $post->ID, 'Slider', true ) )
		return array( $src, 0, 0 );
	else
		return $bool;
}