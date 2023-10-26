<?php

/**
 * Additional code for the child theme goes in here.
 */

add_action( 'wp_enqueue_scripts', 'enqueue_child_styles', 99);

function enqueue_child_styles() {
	$css_creation = filectime(get_stylesheet_directory() . '/style.css');

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [], $css_creation );
}

add_filter( 'gform_stripe_charge_authorization_only', 'stripe_charge_authorization_only', 10, 2 );
function stripe_charge_authorization_only( $authorization_only, $feed ) {
    gf_stripe()->log_debug( __METHOD__ . '(): Running... ');
    $feed_name  = rgars( $feed, 'meta/feedName' );
    if ( $feed_name == 'Stripe Feed - ddc' ) {
        gf_stripe()->log_debug( __METHOD__ . '(): Authorization only charge for feed ' . $feed_name );
        return true;
    }
  
    return $authorization_only;
}
