<?php
if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly
}
$support_url	= 'http://wordpress.org/support/plugin/review-disclaimer';
$support_link	= sprintf(
	wp_kses(
		__( 'To report any issues with this plugin, please visit the <a href="%s">support page on WordPress.org</a>.', 'review-disclaimer' ),
		array( 'a' => array( 'href' => array() ) ) ),
		esc_url( $support_url )
	); ?>
?>
<div class="wrap">
	<div class="postbox">
		<h2><?php _e( 'Review Disclaimer Options', 'review-disclaimer' ); ?></h2>
		<p><?php _e( 'Enter in a default disclaimer text, which you would like to include inside your reviews of products or services.', 'review-disclaimer' ); ?></p>
		<form method='post' action='options.php'>
			<?php wp_nonce_field( 'update-options' ); ?>
			<?php settings_fields( 'oizuled-review-disclaimer-option-group' ); ?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><?php _e( 'Enter the text you wish to use to disclose your relationship with the company, product, or service you are reviewing.', 'review-disclaimer' ); ?></th>
					<td><textarea rows="5" cols="36" name="oizuled-review-disclaimer"><?php echo get_option('oizuled-review-disclaimer'); ?></textarea><br /><?php _e( 'Use shortcode', 'review-disclaimer' ); ?> <strong>[ReviewDisclaimer]</strong> <?php if( function_exists( 'has_blocks' ) ) { _e( 'Or use the Review Disclaimer Block.', 'review-disclaimer' ); } ?></td>
				</tr>
				<tr valign="top">
					<td colspan="2"><input type="hidden" name="action" value="update" /><?php submit_button(); ?></td>
				</tr>
			</table>
		</form>
	</div>
	<div class="postbox">
		<p><?php _e( 'If this plugin has helped you out at all, please consider making a donation to encourage future updates.<br />Your generosity is appreciated!', 'review-disclaimer' ); ?></p>
			<a href="#" onclick="window.open('https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=9AGSF4W2HTR6W');">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" width="147" height="47">
			</a>
		<p><?php echo $support_link; ?></p>
	</div>
</div>