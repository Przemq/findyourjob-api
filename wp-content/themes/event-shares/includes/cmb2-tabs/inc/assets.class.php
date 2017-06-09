<?php

namespace cmb2_tabs\inc;

class Assets {

	public function __construct() {
		add_action( 'admin_enqueue_scripts', [ $this, 'admin_assets' ] );
	}


	public function admin_assets() {
		// css
		wp_enqueue_style( 'dtheme-cmb2-tabs',  THEME_DIR_URI . '/includes/cmb2-tabs/assets/css/cmb2-tabs.css', [], '1.0.1' );

		// js
		wp_enqueue_script( 'jquery-ui' );
		wp_enqueue_script( 'dtheme-cmb2-tabs', THEME_DIR_URI . '/includes/cmb2-tabs/assets/js/cmb2-tabs.js', [ 'jquery-ui-tabs' ] );
	}

}