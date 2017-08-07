<?php
/**
 * This files add some magic functions to the template.
 */

/**
 * Theme autoload media (CSS & JS)
 */
add_action( 'wp_enqueue_scripts', function() {

	/**
	 * Register vendors.
	 */
	if ( is_file( THEME_VENDORS . '/register_vendors.php' )) {
		include THEME_VENDORS . '/register_vendors.php';
	}

	/**
	 * Load css styles for development.
	 */
	if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
		$version_hash = uniqid();
		wp_enqueue_style( 'wpx-fonts',      THEME_CSS_URI . '/fonts.css',       [], $version_hash, 'all' );
		wp_enqueue_style( 'wpx-bootstrap',  THEME_CSS_URI . '/bootstrap.css',   [], $version_hash, 'all' );
		wp_enqueue_style( 'wpx-style',      THEME_CSS_URI . '/style.css',       [], $version_hash, 'all' );

		/**
		 * Autoload modules css files.
		 */
		\Nurture\PageboxBootstrap::registerAutoloader();
		if( class_exists( '\Nurture\Pagebox' )) {
			try {
				$usedPostContext = apply_filters( 'wpx_used_post_contexts', [ new \Nurture\Pagebox\Post() ] );
				$usedModules = [];

				if( is_array( $usedPostContext ) && isset( $usedPostContext[0] ) && $usedPostContext[0] instanceof \Nurture\Pagebox\Post ) {
					foreach( $usedPostContext as $context ) {
						if( $context instanceof \Nurture\Pagebox\Post ) {
							$usedModules = array_merge( $usedModules, \Nurture\Pagebox\Template\Manager::getUsedModules( $context ));
						}
					}
				} else {
					// Use current post context.
					$usedModules = \Nurture\Pagebox\Template\Manager::getUsedModules();
				}

				foreach ( $usedModules as $hash => $relativePath ) {
					wp_enqueue_style( "wpx-{$hash}", $relativePath . "/css/module.css", [], $version_hash, 'all' );
				}
			} catch( \Nurture\Pagebox\Exception $e ) {
				\Nurture\Pagebox\Log::exception( $e );
			}
		}
	} else {
		/**
		 * Load only one, compressed file for production.
		 */
        $lastChangeHash = get_option( 'wpx_last_blog_update', null );
		wp_enqueue_style( 'theme-style', THEME_CSS_URI . '/style.min.css', [], $lastChangeHash, 'all' );
	}
});

/**
 * Remove Pagebox actions from plugins list table.
 */
add_filter( 'plugin_action_links_pagebox/pagebox.php', '__return_empty_array' );

/**
 * Check is Pagebox plugin is activated.
 * If not, check is pagebox file is exists and try to activate plugin.
 */
function wpx_force_activate_pagebox_plugin() {
	// Check is user can activate plugins
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	// Add necessary WP files
	if ( ! function_exists( 'is_plugin_inactive' ) ) {
		require( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	// Check is plugin is inactive
	if ( is_plugin_inactive( 'pagebox/pagebox.php' ) ) {
		$plugin = WP_PLUGIN_DIR . '/pagebox/pagebox.php';

		// Check is plugin file exists
		if ( is_file( $plugin ) ) {

			// Activate plugin (this is method from WP core)
			$activate = activate_plugin( $plugin, '', is_multisite() );
			if ( is_wp_error( $activate ) ) {
				wp_die( 'This template needs Pagebox plugin to work properly.<br><br>' . $activate->get_error_message() );
			}
		}
	}
}
add_action( 'init', 'wpx_force_activate_pagebox_plugin' );