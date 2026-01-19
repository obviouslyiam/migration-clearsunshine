<?php
	 /*
	 Plugin Name: Review Disclaimer
	 Plugin URI: https://surpriseazwebservices.com/wordpress-plugins/review-disclaimer/
	 Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9AGSF4W2HTR6W
	 Description: Use a shortcode or block to quickly insert product or service review disclaimers inside your posts.
	 Version: 2.0.2
	 Author: AMP-MODE
	 Author URI: https://amplifyplugins.com
	 License: GPL2
	 Text Domain: review-disclaimer
	 */

	/*  Copyright 2013  Scott DeLuzio

		This program is free software; you can redistribute it and/or modify
		it under the terms of the GNU General Public License, version 2, as
		published by the Free Software Foundation.

		This program is distributed in the hope that it will be useful,
		but WITHOUT ANY WARRANTY; without even the implied warranty of
		MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		GNU General Public License for more details.

		You should have received a copy of the GNU General Public License
		along with this program; if not, write to the Free Software
		Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
	*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/* I18N */
function review_disclaimer_i18n(){
	$plugin_rel_path = basename( dirname( __FILE__ ) ) . '/languages'; /* Relative to WP_PLUGIN_DIR */
    load_plugin_textdomain( 'review-disclaimer', false, $plugin_rel_path );
}
add_action( 'plugins_loaded', 'review_disclaimer_i18n' );
/* Settings Page */

// Hook for adding admin menus
add_action('admin_menu', 'oizuled_review_disclaimer');

// action function for above hook
function oizuled_review_disclaimer() {
	// Add a new submenu under Settings:
	add_options_page( __( 'Review Disclaimer Options', 'review-disclaimer' ), __( 'Review Disclaimer', 'review-disclaimer' ), 'manage_options', 'oizuledreviewdisclaimer', 'oizuled_review_disclaimer_settings_page');
}

add_action('admin_init', 'register_oizuled_review_disclaimer_settings');

function activate_review_disclaimer() {
	add_option('oizuled-review-disclaimer', 'Enter disclaimer text');
}

function deactive_review_disclaimer() {
	delete_option('oizuled-review-disclaimer');
}

register_activation_hook(__FILE__, 'activate_review_disclaimer');
register_deactivation_hook(__FILE__, 'deactive_review_disclaimer');

function register_oizuled_review_disclaimer_settings() {
	register_setting( 'oizuled-review-disclaimer-option-group', 'oizuled-review-disclaimer');
}

// Display the page content for the disclaimer submenu
function oizuled_review_disclaimer_settings_page() {
	include(WP_PLUGIN_DIR.'/review-disclaimer/options.php');
}

/* Set Shortcode/Block */
require_once __DIR__ . '/blocks/review-disclaimer.php';
function review_disclaimer_render_shortcode() {
	$disclaimer = get_option( 'oizuled-review-disclaimer' );
	return $disclaimer;
}
function review_disclaimer_shortcode(){
	add_shortcode( 'ReviewDisclaimer', 'review_disclaimer_render_shortcode' );
	if( function_exists( 'has_blocks' ) ){
		register_block_type( 'review-disclaimer/review-disclaimer', array(
			'editor_script'		=> 'review-disclaimer',
			'render_callback'	=> 'review_disclaimer_render_shortcode'
		));
	}
}
add_action( 'init', 'review_disclaimer_shortcode' );