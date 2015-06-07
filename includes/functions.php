<?php
/**
 * Helper Functions
 *
 * @package     EDD\Empty Cart\Functions
 * @since       1.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;


/**
 * Add new content to the empty cart
 *
 * @since       1.0.0
 * @return      string The content displayed in the empty cart
 */
function edd_empty_cart_content( $content ) {
	$empty_cart_title          = edd_get_option( 'edd_empty_cart_title', __( 'Your cart is empty.', 'edd-empty-cart' ) );
	$empty_cart_content        = edd_get_option( 'edd_empty_cart_content', __( 'It appears you do not have any items in your cart. Perhaps you would be interested in one of the items below.', 'edd-empty-cart' ) );
	$empty_cart_downloads      = edd_get_option( 'edd_empty_cart_downloads_shortcode', '[downloads]' );
	
	if ( !edd_is_checkout() ) {
		$content = '<span>' . __( 'Your cart is empty.', 'edd-empty-cart' ) . '</span>';
		return $content;
	}

	ob_start();

	if ( '' != $empty_cart_title ) {
		echo '<h3 class="edd-empty-cart-title">' . $empty_cart_title . '</h3>';
	}

	if ( '' != $empty_cart_content ) {
		echo '<div class="edd-empty-cart-content">' . wpautop( $empty_cart_content ) . '</div>';
	}

	if ( !empty( $empty_cart_downloads ) ) {

		$downloads = '<div class="edd-empty-cart-downloads">';
		$downloads .= do_shortcode( $empty_cart_downloads );
		$downloads .= '</div>';

		echo $downloads;
	}

	$content = ob_get_clean();

	return $content;
}
add_filter( 'edd_empty_cart_message', 'edd_empty_cart_content', 999, 1 );