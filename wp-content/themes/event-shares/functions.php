<?php

/**
 * Global definitions
 */
require_once 'functions/global-definitions.php';

/**
 * Init CMB2
 */

require_once 'includes/cmb2/init.php';
require_once 'includes/cmb2-tabs/plugin.php';

/**
 * Init Menu Description Walker
 */

require_once 'includes/menu-with-description.php';

/**
 * Import Theme Utils (Pagebox tools)
 */
require_once 'functions/theme.php';
require_once( 'includes/theme-options.php' );

/**
 * Theme styles (CSS) and scripts (JavaScript)
 * Use registered media in assets/vendors/register_vendors.php
 */
add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_script( 'scripts', THEME_JS_URI . '/script.js', array( 'jquery', 'bootstrap' ), null, true );
} );

/**
 * Login redirect - redirect user when not logged in
 */
if ( ! defined( 'WP_PROD' ) || ! WP_PROD ) {
	add_action( 'wp', 'login_to_view_site' );
}
function login_to_view_site() {
	$protocol = 'http://';
	if ( isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] === 'on' || strpos( get_option( 'siteurl' ), 'https' ) !== false ) {
		$protocol = 'https://';
	}
	$show = isset( $_GET['show'] ) ? $_GET['show'] : false;
	if ( ! is_user_logged_in() && $show != 'tester' ) {
		$current_url = urlencode( $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
		wp_redirect( HOME_URL . "/wp-login.php?redirect_to=" . $current_url );
		die();
	}
}

/**
 * Enabled post-thumbnail support
 */
add_theme_support( 'post-thumbnails' );

/**
 * Register default menus
 */
add_action( 'after_setup_theme', function () {
	register_nav_menus( [
		'header' => __( 'Header Menu', 'theme' ),
		'footer' => __( 'Footer Menu', 'theme' )
	] );
} );

//Add nav-menu to nav

function event_menu_classes( $classes, $item, $args ) {
	if ( $args->theme_location == 'header' ) {
		$classes[] = 'nav-item';
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'event_menu_classes', 1, 3 );

/**
 * Hide WP version strings from scripts and styles
 * @return {string} $src
 * @filter script_loader_src
 * @filter style_loader_src
 */
function remove_wp_version_strings( $src ) {
	global $wp_version;
	parse_str( parse_url( $src, PHP_URL_QUERY ), $query );
	if ( ! empty( $query['ver'] ) && $query['ver'] === $wp_version ) {
		$src = remove_query_arg( 'ver', $src );
	}

	return $src;
}

add_filter( 'script_loader_src', 'remove_wp_version_strings' );
add_filter( 'style_loader_src', 'remove_wp_version_strings' );


/**
 * Hide WP version strings from generator meta tag
 */
function wpmudev_remove_version() {
	return '';
}


/**
 * Create JIRA task link
 *
 * @param $task string Enter JIRA task number (for ex. OMGI-1)
 *
 * @return string Returning <a> element with JIRA task link
 */

function createTaskLink( $task ) {
	if ( defined( 'WP_ENVIRONMENT' ) && WP_ENVIRONMENT === 'dev' ) {
		return '<a class="task-number" target="_blank" href="https://nurture.atlassian.net/browse/' . $task . '">' . $task . '</a>';
	}

	return '';
}


/**
 * Makes correct links to minified styles while you are using that on Multisite website and BWP minify plugin.
 * It changes links from SITE_DOMAIN/country/investor/ to main SITE_DOMAIN (without any additional parts).
 * Uncomment filter if you want to use it.
 *
 * @param $src
 *
 * @return mixed|string
 */
//function multisite_bwpminify_src( $src ) {
//	$src = preg_replace( "/(f=|,)([\\/a-zA-Z0-9_-]*?)wp-content/", "$1wp-content", $src );
//
//	return $src;
//}

//add_filter( 'bwp_minify_get_src', 'multisite_bwpminify_src', 10, 2 );


/**
 * Add support for new post type.
 * Change 'header_nav' to your custom post type.
 * Please see also: 'Put custom post with pagebox into page'
 */
//add_filter( 'wpx_pre_get_config_post_types', function ( $post_types ) {
//	$post_types[] = 'header_nav';
//
//	return $post_types;
//} );


/**
 * Add option to add support to extra custom posts.
 * Change 'header_nav' to your custom post type.
 * Please see also: 'Put custom post with pagebox into page'
 */
//add_filter( 'wpx_used_post_contexts', function ( $contexts ) {
//	foreach ( get_posts( [ 'post_type' => 'header_nav' ] ) as $headerPost ) {
//		/** @var WP_Post $headerPost */
//		$contexts[] = new \Nurture\Pagebox\Post( $headerPost->ID );
//	}
//
//	return $contexts;
//} );

/**
 * Put custom post with pagebox into page
 * If you want to add somewhere custom post with pageboxes use this function below:
 */
//if ( function_exists( 'wpx_pagebox' ) ) {
//	foreach ( get_posts( [ 'post_type' => 'header_nav' ] ) as $headerPost ) {
//		/** @var WP_Post $headerPost */
//		wpx_pagebox( $headerPost->ID );
//	}
//}


/**
 * Custom posts type header_nav
 */

// Register Custom Post Type
function flyout_menu() {

	$labels = array(
		'name'                  => _x( 'Menus', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'Flyout Menu', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'Flyout Menu', 'text_domain' ),
		'name_admin_bar'        => __( 'Flyout Menu', 'text_domain' ),
		'archives'              => __( 'Menu', 'text_domain' ),
		'attributes'            => __( 'Menu', 'text_domain' ),
		'parent_item_colon'     => __( 'Menu', 'text_domain' ),
		'all_items'             => __( 'Menu', 'text_domain' ),
		'add_new_item'          => __( 'Add new menu', 'text_domain' ),
		'add_new'               => __( 'Add New', 'text_domain' ),
		'new_item'              => __( 'New menu', 'text_domain' ),
		'edit_item'             => __( 'Edit menu', 'text_domain' ),
		'update_item'           => __( 'Update menu', 'text_domain' ),
		'view_item'             => __( 'View menu', 'text_domain' ),
		'view_items'            => __( 'View menu', 'text_domain' ),
		'search_items'          => __( 'Search menu', 'text_domain' ),
		'not_found'             => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
		'featured_image'        => __( 'Featured Image', 'text_domain' ),
		'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
		'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
		'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into menu', 'text_domain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this menu', 'text_domain' ),
		'items_list'            => __( 'Menus list', 'text_domain' ),
		'items_list_navigation' => __( 'Menus list navigation', 'text_domain' ),
		'filter_items_list'     => __( 'Filter menus list', 'text_domain' ),
	);
	$args   = array(
		'label'               => __( 'Menu', 'text_domain' ),
		'description'         => __( 'Flyout menu', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'revisions', ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => false,
		'can_export'          => false,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'header_nav', $args );

}

add_action( 'init', 'flyout_menu', 0 );

/**
 * Add support for new post type
 */
add_filter( 'wpx_pre_get_config_post_types', function ( $post_types ) {
	$post_types[] = 'header_nav';
	$post_types[] = 'team_members';

	return $post_types;
} );

/**
 * Add header_nav post type to menu
 */
add_filter( 'wpx_used_post_contexts', function ( $contexts ) {
	foreach ( get_posts( [ 'post_type' => 'header_nav' ] ) as $headerPost ) {
		/** @var WP_Post $headerPost */
		$contexts[] = new \Nurture\Pagebox\Post( $headerPost->ID );
	}

	return $contexts;
} );


add_action( 'init', 'addGetInTouchSession' );
function addGetInTouchSession() {
	if ( empty( session_id() ) || ( session_id() === "" ) ) {
		session_start();
	}
}

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
	$_SESSION['form_data'] = serialize( $submission );
	$_SESSION['form_id']   = serialize( $cf7 );
}


add_filter( 'wpcf7_form_input', 'do_shortcode' );
function wpx_form_input( $attr ) {
	$attr = ( shortcode_atts( array(
		'form_id'     => 0,
		'type'        => '',
		'name'        => '',
		'id'          => '',
		'size'        => 40,
		'class'       => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control small-input rounded-0',
		'placeholder' => '',
		'required'    => 'false'

	), $attr ) );

	$key = $attr['form_id'] . '_' . $attr['name'];
	$val = '';
	if ( isset( $_SESSION[ $key ] ) ) {
		$val = $_SESSION[ $key ];
	}
	$input = '<span class="wpcf7-form-control-wrap '.$attr['name'].'"/>';
	$input .= '<input type="' . $attr['type'] . '" name="' . $attr['name'] . '" value="' . $val . '" size="' . $attr['size'] . '" 
	class="' . $attr['class'] . '" id="' . $attr['id'] . '" placeholder="' .
	         $attr['placeholder'] . '" aria-required="' . $attr['required'] . '" aria-invalid="false" />';
	$input .= '</span>';

	return $input;
}
add_shortcode( 'WPX_FORM_INPUT', 'wpx_form_input' );


add_filter( 'getSessionInput', 'do_shortcode' );
function getSessionInput( $attr ) {
	$attr = ( shortcode_atts( array(
		'name'        => '',
		'form_id'        => ''

	), $attr ) );

	$key = $attr['form_id'] . '_' . $attr['name'];
	$val = '';
	if ( isset( $_SESSION[ $key ] ) ) {
		$val = $_SESSION[ $key ];
	}
	return $val;
}
add_shortcode( 'GET_INPUT', 'getSessionInput' );




function wpx_form_select( $attr ) {
	$attr = ( shortcode_atts( array(
		'form_id'     => 0,
		'name'        => '',
		'id'          => '',
		'class'       => 'wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control small-input rounded-0',
		'placeholder' => '',
		'required'    => 'false',
		'options' => ""

	), $attr ) );

	$sessionKey = $attr['form_id'] . '_' . $attr['name'];
	$val = '';
	if ( isset( $_SESSION[ $sessionKey ] ) ) {
		$val = $_SESSION[ $sessionKey ];
	}
	$options = explode(",",$attr["options"]);
	$output = "";
	$output  = '<option value="" disabled selected>Select your option</option>';

	foreach ($options as $key => $value){
		if($val === $value){
			$output.= '<option value="'.$value.'" selected>'.$value.'</option>';
		}else{
			$output.= '<option value="'.$value.'">'.$value.'</option>';
		}
	};
	$select = '<select name="' . $attr['name'] . '" class="' . $attr['class'] . '" id="' . $attr['id'] .
	          '" aria-required="' . $attr['required'] . '" aria-invalid="false" />';
	$select .= $output;
	$select .= '</select>';

	return $select;
}

add_shortcode( 'WPX_FORM_SELECT', 'wpx_form_select' );


//add_action( 'wpcf7_init', 'wpcf7_add_form_tag_text_session' );
//
//function wpcf7_add_form_tag_text_session() {
//	wpcf7_add_form_tag(
//		array( 'text', 'text*', 'email', 'email*', 'url', 'url*', 'tel', 'tel*' ),
//		'wpcf7_text_form_tag_handler', array( 'name-attr' => true ) );
//}
