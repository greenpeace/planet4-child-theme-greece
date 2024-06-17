<?php

/**
 * Additional code for the child theme goes in here.
 */

add_action( 'wp_enqueue_scripts', 'enqueue_child_styles', 99);
function enqueue_child_styles() {
	$css_creation = filectime(get_stylesheet_directory() . '/style.css');

	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', [], $css_creation );
}

add_filter( 'gform_validation', 'custom_validation' );
function custom_validation( $validation_result ) {
    $form = $validation_result['form'];
  
    //supposing we don't want input 1 to be a value of 86
    if (preg_match("^GR\d{2}\d{7}\d{16}$",$rgpost( 'IBAN' ))) {
  
        // set the form validation to false
        $validation_result['is_valid'] = false;
  
        //finding Field with ID of 1 and marking it as failed validation
        foreach( $form['fields'] as &$field ) {
  
            //NOTE: replace 1 with the field you would like to validate
            if ( $field->id == '65' ) {
                $field->failed_validation = true;
                $field->validation_message = 'Please enter a valid IBAN';
                break;
            }
        }
  
    }
  
    //Assign modified $form object back to the validation result
    $validation_result['form'] = $form;
    return $validation_result;
  
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