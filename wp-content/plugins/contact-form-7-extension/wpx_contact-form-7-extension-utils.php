<?php

/*
    Prevent the email sending step for specific form
*/
//Allow Contact Form 7 render shortcodes
add_filter( 'wpcf7_form_elements', 'do_shortcode' );
add_action( 'wpcf7_before_send_mail', 'my_custom_function' );

function my_custom_function( $cf7 ) {

	$title       = $cf7->title();
	$submission  = WPCF7_Submission::get_instance();
	$id          = $cf7->id();
	$posted_data = "";
	if ( $submission ) {
		$posted_data = $submission->get_posted_data();
	}
	if ( 'Contact Form' == $title ) {

		foreach ( $posted_data as $key => $data ) {
			$_SESSION[ $id . '_' . $key ] = $data;
		}
	}
}

//Shortcode to retrive input data from Session
add_filter( 'getSessionInput', 'do_shortcode' );
function getSessionInput( $attr ) {
	$attr = ( shortcode_atts( array(
		'name'        => '',
		'form_id'     => '',
		'placeholder' => ''

	), $attr ) );

	$key = $attr['form_id'] . '_' . $attr['name'];
	$val = '';
	if ( isset( $_SESSION[ $key ] ) ) {
		$val = $_SESSION[ $key ];
	}

	return $val;
}

add_shortcode( 'GET_INPUT', 'getSessionInput' );