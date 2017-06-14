<?php
/**
 * Libs folder is for all external libraries (css, js, etc.)
 *
 * This file contains only wp_register_script() and wp_register_style() for vendor libs.
 * For enqueue this, use functions.php or pagebox module config.
 */

/**
 * Unregister WordPress jQuery
 */
wp_deregister_script( 'jquery' );

/**
 * JS files
 */
wp_register_script( 'jquery', THEME_VENDORS_URI . '/jquery/jquery.min.js', [], '3.2.1', true );
wp_register_script( 'tether', THEME_VENDORS_URI . '/tether/tether.min.js', [ 'jquery' ], '1.3.7', true );
wp_register_script( 'tether-select', THEME_VENDORS_URI . '/tether-select/js/select.min.js', [ 'tether' ], '1.1.1', true );
wp_register_script( 'bootstrap', THEME_VENDORS_URI . '/bootstrap/bootstrap.min.js', [ 'jquery', 'tether' ], 'v4.0.0-alpha.6', true );
wp_register_script( 'slick', THEME_VENDORS_URI . '/slick/slick.min.js', [ 'jquery' ], '1.6.0', true );
wp_register_script( 'js-cookie', THEME_VENDORS_URI . '/js-cookie/js.cookie.js', [ 'jquery' ], '2.1.3', true);
wp_register_script( 'parallax.js', THEME_VENDORS_URI . '/parallax.js/parallax.min.js', [ 'jquery' ], '1.4.2', true );

/**
 * CSS files
 */
wp_register_style( 'slick', THEME_VENDORS_URI . '/slick/slick.css', [], '1.6.0' );
wp_register_style( 'slick-theme', THEME_VENDORS_URI . '/slick/slick-theme.css', [ 'slick' ], '1.6.0' );