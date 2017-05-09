<?php

/**
* Defined constants
*/
define( 'THEME_DIR_PATH',       get_template_directory() );
define( 'THEME_DIR_URI',        get_template_directory_uri() );

/**
 * Pagebox constants
 */
define( 'THEME_VENDORS',        THEME_DIR_PATH  . '/assets/vendors' );
define( 'THEME_VENDORS_URI',    THEME_DIR_URI   . '/assets/vendors' );

define( 'THEME_SCSS',           THEME_DIR_PATH  . '/assets/stylesheets/scss' );
define( 'THEME_CSS_URI',        THEME_DIR_URI   . '/assets/stylesheets/css' );
define( 'THEME_JS_URI',         THEME_DIR_URI   . '/assets/javascripts' );
define( 'THEME_FONTS_URI',      THEME_DIR_URI   . '/assets/fonts' );
define( 'THEME_IMAGES_URI',     THEME_DIR_URI   . '/assets/images' );

define( 'HOME_URL', get_home_url() );