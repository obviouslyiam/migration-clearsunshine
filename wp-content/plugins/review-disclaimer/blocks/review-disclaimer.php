<?php
/**
 * Registers Review Disclaimer block utilities
 *
 * @package Review_Disclaimer_Block
 */
/**
 * Register block editor assets
 */
function review_disclaimer_enqueue_block_editor_assets() {
	$dir        = dirname( __FILE__ );
	$block_js   = 'review-disclaimer/index.js';
	wp_enqueue_script(
		'review-disclaimer', plugins_url( $block_js, __FILE__ ), array(
			'wp-blocks',
			'wp-i18n',
			'wp-element',
		), filemtime( "$dir/$block_js" )
	);
}
add_action( 'enqueue_block_editor_assets', 'review_disclaimer_enqueue_block_editor_assets' );