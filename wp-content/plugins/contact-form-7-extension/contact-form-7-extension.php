<?php

/*
Plugin Name: Contact Form 7 - SESSION extension
Description: Provides a dynamic text field that accepts any shortcode to generate the content.  Requires Contact Form 7
License: GPL2
*/

require_once 'wpx_number.php';
require_once 'wpx_select.php';

add_action( 'plugins_loaded', 'wpcf7dtx_init', 20 );

function wpcf7dtx_init() {
	add_action( 'wpcf7_init', 'wpcf7dtx_add_shortcode_wpx_text' );
	add_filter( 'wpcf7_validate_wpx_text*', 'wpcf7dtx_wpx_text_validation_filter', 10, 2 );
	add_filter( 'wpcf7_validate_wpx_email*', 'wpcf7dtx_wpx_text_validation_filter', 10, 2 );
	add_filter( 'wpcf7_validate_wpx_tel*', 'wpcf7dtx_wpx_text_validation_filter', 10, 2 );
}


function wpcf7dtx_add_shortcode_wpx_text() {
	wpcf7_add_form_tag(
		array( 'wpx_text', 'wpx_text*', 'dynamichidden', 'wpx_email', 'wpx_email*', 'wpx_tel', 'wpx_tel*' ),
		'wpcf7dtx_wpx_text_shortcode_handler', true );
}


function wpcf7dtx_wpx_text_shortcode_handler( $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	if ( empty( $tag->name ) ) {
		return '';
	}

	$validation_error = wpcf7_get_validation_error( $tag->name );

	$class = wpcf7_form_controls_class( $tag->type, 'wpcf7dtx-wpx_text' );


	if ( $validation_error ) {
		$class .= ' wpcf7-not-valid';
	}

	$atts = array();

	$atts['size']      = $tag->get_size_option( '40' );
	$atts['maxlength'] = $tag->get_maxlength_option();
	$atts['minlength'] = $tag->get_minlength_option();

	if ( $atts['maxlength'] && $atts['minlength'] && $atts['maxlength'] < $atts['minlength'] ) {
		unset( $atts['maxlength'], $atts['minlength'] );
	}

	$atts['class']    = $tag->get_class_option( $class );
	$atts['id']       = $tag->get_id_option();
	$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

	if ( $tag->has_option( 'readonly' ) ) {
		$atts['readonly'] = 'readonly';
	}

	if ( $tag->is_required() ) {
		$atts['aria-required'] = 'true';
	}

	$atts['aria-invalid'] = $validation_error ? 'true' : 'false';

	$value = (string) reset( $tag->values );
    $placeholder = substr( $value, strpos( $value, 'placeholder=' ));

	if ( $value !== "" && isset( $placeholder ) && $placeholder !== "" ) {
		$placeholder         = substr( $value, strpos( $value, 'placeholder=' ) + 12 );
		$lengthToStrip       = strposX( $placeholder, "'", 2 );
		$placeholder         = substr( $placeholder, 0, $lengthToStrip );
		$placeholder         = trim( $placeholder, "'" );
		$atts['placeholder'] = $placeholder;
	}
//


	$value = $tag->get_default_option( $value );

	$value = wpcf7_get_hangover( $tag->name, $value );


	if ( wpcf7_support_html5() ) {
		$atts['type'] = $tag->basetype;
	} else {
		$atts['type'] = 'text';
	}

	$scval = do_shortcode( '[' . $value . ']' );
	if ( $scval != '[' . $value . ']' ) {
		$value = esc_attr( $scval );
	}

	$atts['value'] = $value;

//echo '<pre>'; print_r( $tag ); echo '</pre>';
	switch ( $tag->basetype ) {
		case 'wpx_text':
			$atts['type'] = 'text';
			break;
		case 'dynamichidden':
			$atts['type'] = 'hidden';
			break;
		case 'wpx_email':
			$atts['type'] = 'email';
			break;
		case 'wpx_tel':
			$atts['type'] = 'tel';
			break;
		default:
			$atts['type'] = 'text';
			break;
	}

	$atts['name'] = $tag->name;

	$atts = wpcf7_format_atts( $atts );

	$html = sprintf(
		'<span class="wpcf7-form-control-wrap %1$s"><input %2$s />%3$s</span>',
		sanitize_html_class( $tag->name ), $atts, $validation_error );

	return $html;
}


//add_filter( 'wpcf7_validate_text', 'wpcf7_text_validation_filter', 10, 2 );  // in init
function wpcf7dtx_wpx_text_validation_filter( $result, $tag ) {
	$tag = new WPCF7_FormTag( $tag );

	$name = $tag->name;

	$value = isset( $_POST[ $name ] )
		? trim( wp_unslash( strtr( (string) $_POST[ $name ], "\n", " " ) ) )
		: '';

	if ( 'wpx_text' == $tag->basetype ) {
		if ( $tag->is_required() && '' == $value ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
		}
	}

	if ( 'wpx_email' == $tag->basetype ) {
		if ( $tag->is_required() && '' == $value ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
		} elseif ( '' != $value && ! wpcf7_is_email( $value ) ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_email' ) );
		}
	}

	if ( 'wpx_url' == $tag->basetype ) {
		if ( $tag->is_required() && '' == $value ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
		} elseif ( '' != $value && ! wpcf7_is_url( $value ) ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_url' ) );
		}
	}

	if ( 'wpx_tel' == $tag->basetype ) {
		if ( $tag->is_required() && '' == $value ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
		} elseif ( '' != $value && ! wpcf7_is_tel( $value ) ) {
			$result->invalidate( $tag, wpcf7_get_message( 'invalid_tel' ) );
		}
	}

	if ( ! empty( $value ) ) {
		$maxlength = $tag->get_maxlength_option();
		$minlength = $tag->get_minlength_option();

		if ( $maxlength && $minlength && $maxlength < $minlength ) {
			$maxlength = $minlength = null;
		}

		$code_units = wpcf7_count_code_units( $value );

		if ( false !== $code_units ) {
			if ( $maxlength && $maxlength < $code_units ) {
				$result->invalidate( $tag, wpcf7_get_message( 'invalid_too_long' ) );
			} elseif ( $minlength && $code_units < $minlength ) {
				$result->invalidate( $tag, wpcf7_get_message( 'invalid_too_short' ) );
			}
		}
	}

	return $result;
}

//
//function wpcf7_text_validation_filter( $result, $tag ) {
//	$name = $tag->name;
//
//	$value = isset( $_POST[$name] )
//		? trim( wp_unslash( strtr( (string) $_POST[$name], "\n", " " ) ) )
//		: '';
//
//	if ( 'text' == $tag->basetype ) {
//		if ( $tag->is_required() && '' == $value ) {
//			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
//		}
//	}
//
//
//	if ( 'url' == $tag->basetype ) {
//		if ( $tag->is_required() && '' == $value ) {
//			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
//		} elseif ( '' != $value && ! wpcf7_is_url( $value ) ) {
//			$result->invalidate( $tag, wpcf7_get_message( 'invalid_url' ) );
//		}
//	}
//
//	if ( 'tel' == $tag->basetype ) {
//		if ( $tag->is_required() && '' == $value ) {
//			$result->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
//		} elseif ( '' != $value && ! wpcf7_is_tel( $value ) ) {
//			$result->invalidate( $tag, wpcf7_get_message( 'invalid_tel' ) );
//		}
//	}
//
//	if ( '' !== $value ) {
//		$maxlength = $tag->get_maxlength_option();
//		$minlength = $tag->get_minlength_option();
//
//		if ( $maxlength && $minlength && $maxlength < $minlength ) {
//			$maxlength = $minlength = null;
//		}
//
//		$code_units = wpcf7_count_code_units( stripslashes( $value ) );
//
//		if ( false !== $code_units ) {
//			if ( $maxlength && $maxlength < $code_units ) {
//				$result->invalidate( $tag, wpcf7_get_message( 'invalid_too_long' ) );
//			} elseif ( $minlength && $code_units < $minlength ) {
//				$result->invalidate( $tag, wpcf7_get_message( 'invalid_too_short' ) );
//			}
//		}
//	}
//
//	return $result;
//}


if ( is_admin() ) {
	//add_action( 'admin_init', 'wpcf7dtx_add_tag_generator_wpx_text', 25 );
	add_action( 'wpcf7_admin_init', 'wpcf7dtx_add_tag_generator_wpx_text', 100 );
}

function wpcf7dtx_add_tag_generator_wpx_text() {

	if ( ! class_exists( 'WPCF7_TagGenerator' ) ) {
		return;
	}

	$tag_generator = WPCF7_TagGenerator::get_instance();
	$tag_generator->add( 'wpx_text', __( 'wpx_text', 'contact-form-7' ),
		'wpcf7dtx_tag_generator_wpx_text' );

	$tag_generator->add( 'dynamichidden', __( 'dynamic hidden', 'contact-form-7' ),
		'wpcf7dtx_tag_generator_wpx_text' );

	$tag_generator->add( 'wpx_email', __( 'wpx_email', 'contact-form-7' ),
		'wpcf7dtx_tag_generator_wpx_text' );

	$tag_generator->add( 'wpx_tel', __( 'wpx_tel', 'contact-form-7' ),
		'wpcf7dtx_tag_generator_wpx_text' );
}


function wpcf7dtx_tag_generator_wpx_text( $contact_form, $args = '' ) {
	$args        = wp_parse_args( $args, array() );
	$type        = $args['id'];
	$description = "";


	switch ( $type ) {
		case 'wpx_text':
			$description = __( "Generate a form-tag for a single-line plain text input field, with a dynamically generated default value.", 'contact-form-7' );
			//$type = 'text';
			break;
		case 'dynamichidden':
			$description = __( "Generate a form-tag for a hidden input field, with a dynamically generated default value.", 'contact-form-7' );
			//$type = 'hidden';
			break;
		case 'wpx_email':
			$description = __( "Generate a form-tag for a email input field, with a dynamically generated default value.", 'contact-form-7' );
			//$type = 'hidden';
			break;
		default:
			//$type = 'text';
			break;
	}


	?>
    <div class="control-box">
        <fieldset>
            <legend><?php echo $description; ?></legend>

            <table class="form-table">
                <tbody>
                <tr>
                    <th scope="row"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></th>
                    <td>
                        <fieldset>
                            <legend class="screen-reader-text"><?php echo esc_html( __( 'Field type', 'contact-form-7' ) ); ?></legend>
                            <label><input type="checkbox"
                                          name="required"/> <?php echo esc_html( __( 'Required field', 'contact-form-7' ) ); ?>
                            </label>
                        </fieldset>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label
                                for="<?php echo esc_attr( $args['content'] . '-name' ); ?>"><?php echo esc_html( __( 'Name', 'contact-form-7' ) ); ?></label>
                    </th>
                    <td><input type="text" name="name" class="tg-name oneline"
                               id="<?php echo esc_attr( $args['content'] . '-name' ); ?>"/></td>
                </tr>

                <tr>
                    <th scope="row"><label
                                for="<?php echo esc_attr( $args['content'] . '-values' ); ?>"><?php echo esc_html( __( 'Dynamic value', 'contact-form-7' ) ); ?></label>
                    </th>
                    <td><input type="text" name="values" class="oneline"
                               id="<?php echo esc_attr( $args['content'] . '-values' ); ?>"/><br/>
						<?php _e( 'You can enter any short code.  Just leave out the square brackets (<code>[]</code>) and only use single quotes (<code>\'</code> not <code>"</code>).  <br/>So <code>[shortcode attribute="value"]</code> becomes <code>shortcode attribute=\'value\'</code>', 'contact-form-7' ); ?>
                    </td>
                </tr>

                <tr>
                    <th scope="row"><label
                                for="<?php echo esc_attr( $args['content'] . '-id' ); ?>"><?php echo esc_html( __( 'Id attribute', 'contact-form-7' ) ); ?></label>
                    </th>
                    <td><input type="text" name="id" class="idvalue oneline option"
                               id="<?php echo esc_attr( $args['content'] . '-id' ); ?>"/></td>
                </tr>

                <tr>
                    <th scope="row"><label
                                for="<?php echo esc_attr( $args['content'] . '-class' ); ?>"><?php echo esc_html( __( 'Class attribute', 'contact-form-7' ) ); ?></label>
                    </th>
                    <td><input type="text" name="class" class="classvalue oneline option"
                               id="<?php echo esc_attr( $args['content'] . '-class' ); ?>"/></td>
                </tr>

                </tbody>
            </table>
        </fieldset>
    </div>

    <div class="insert-box">
        <input type="text" name="<?php echo $type; ?>" class="tag code" readonly="readonly" onfocus="this.select()"/>

        <div class="submitbox">
            <input type="button" class="button button-primary insert-tag"
                   value="<?php echo esc_attr( __( 'Insert Tag', 'contact-form-7' ) ); ?>"/>
        </div>

        <br class="clear"/>

    </div>
	<?php
}

function strposX( $haystack, $needle, $number ) {
	if ( $number == '1' ) {
		return strpos( $haystack, $needle );
	} elseif ( $number > '1' ) {
		return strpos( $haystack, $needle, strposX( $haystack, $needle, $number - 1 ) + strlen( $needle ) );
	} else {
		return error_log( 'Error: Value for parameter $number is out of range' );
	}
}