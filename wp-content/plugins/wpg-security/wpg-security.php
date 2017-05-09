<?php
/*
    Plugin Name: Security Manager
    Description: Manage security and performance issues in WordPress.
    Version: 1.0.0
    License: GPL2
    Text Domain: wpg-security

    Copyright (C) 2016

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

namespace WPGSecurity;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

error_log("security\n");

// Directories and urls definitions
define( 'WPGSecurity\DOMAIN',   'wpg-security' );
define( 'WPGSecurity\URL',      plugin_dir_url( __FILE__ ) );
define( 'WPGSecurity\DIR',      plugin_dir_path( __FILE__ ) );

require 'wpg-interface.php';
require 'wpg-doc-block.php';

register_deactivation_hook( __FILE__, function() {
	delete_option( 'wpg-security-modules' );
	delete_option( 'wpg-security-data' );
});

/**
 * Class Scanner
 * @package WPGSecurity
 */
final class Scanner {

	/**
	 * @var Module[]
	 */
	private $_modules = [];

	/**
	 * Modules data
	 * @var null|array
	 */
	private $_data = null;

	/**
	 * Active modules paths
	 * @var array
	 */
	private $_paths = [];

	/**
	 * Scanner constructor.
	 */
	public function __construct() {

		// Ajax actions for logged in users.
		add_action( 'wp_ajax_wpg_security_save', [ $this, 'onAjaxSave' ] );
		add_action( 'wp_ajax_wpg_security_status', [ $this, 'onAjaxStatus' ] );

		// When AJAX call exit now.
		if( defined('DOING_AJAX') && DOING_AJAX ) return;

		// Load data.
		$this->_paths = get_option( 'wpg-security-modules', [] );
		$this->_data = get_option( 'wpg-security-data', [] );

		if( is_admin() ) {
			if( isset( $_GET['page'] ) && $_GET['page'] === 'security-scanner' ) {
				$this->loadAllModules();
			}

			$this->loadAdminModules();

			add_action( 'admin_menu', [ $this, 'addSettingsPage' ] );
			add_action( 'admin_enqueue_scripts', [ $this, 'enqueueMedia' ] );
		} else {
			// Load only active modules
			$this->loadModules();
		}
	}

	/**
	 * Load all modules from "modules" directory which is instance of "Module" class.
	 */
	public function loadAllModules() {
		foreach( glob( DIR . 'modules/*.php' ) as $module ) {
			$mod = include_once( $module );
			if( is_object( $mod ) && $mod instanceof Module ) {
				$this->_modules[ $mod->getId() ] = $mod;
			}
		}
	}

	/**
	 * Load only active modules (is on)
	 */
	public function loadModules() {
		$i = count( $this->_paths );
		while( $i-- ) {
			$mod = include( "modules/{$this->_paths[ $i ]}" );
			if( $mod instanceof Module ) {
				$data = isset( $this->_data[ $mod->getId() ]) ? $this->_data[ $mod->getId() ] : $mod->getDefaultSettings();
				$mod->protect( $data );
			}
		}
	}

	/**
	 * Load only active modules (is on)
	 */
	public function loadAdminModules() {
		$i = count( $this->_paths );
		while( $i-- ) {
			$mod = include_once( "modules/{$this->_paths[ $i ]}" );
			if( $mod === true && isset( $this->_modules[ $this->_paths[ $i ] ]) ) {
				$mod = $this->_modules[ $this->_paths[ $i ] ];
			}
			if( $mod instanceof Module && $mod instanceof RunOnAdmin ) {
				$data = isset( $this->_data[ $mod->getId() ]) ? $this->_data[ $mod->getId() ] : $mod->getDefaultSettings();
				$mod->protectAdmin( $data );
			}
		}
	}

	/**
	 * Load module by ID.
	 *
	 * @param string $id Module ID
	 * @return bool|Module
	 */
	public function loadModuleById( $id ) {
		if( is_file( __DIR__ . "/modules/{$id}" ) ) {
			$mod = include( __DIR__ . "/modules/{$id}" );
			if( $mod instanceof Module )
				return $mod;
		}
		return false;
	}

	/**
	 * Determine if module has active (is on)
	 * @param Module $module
	 *
	 * @return bool
	 */
	public function hasOn( Module $module ) {
		return in_array( $module->getId(), $this->_paths );
	}

	/**
	 * Get modules list.
	 * @return array
	 */
	public function getModules() {
		// Sort modules by name
		usort( $this->_modules, function( $a, $b ) {
			if ($a->getName() == $b->getName()) return 0;
			return ($a->getName() < $b->getName()) ? -1 : 1;
		});
		return $this->_modules;
	}

	/**
	 * @param Module $module
	 *
	 * @return string Settings HTML
	 */
	public function renderSettingsView( Module $module ) {
		if( $module instanceof ModuleSettings ) {
			$data = isset( $this->_data[ $module->getId() ]) ? $this->_data[ $module->getId() ] : $module->getDefaultSettings();
			if( $module instanceof DataModify ) {
				$data = $module->afterLoad( $data );
			}
			return $module->settingsView( $data );
		}
		return '';
	}

	/**
	 * Add admin settings page only for super admin.
	 * @admin admin_menu
	 */
	public function addSettingsPage() {
		if( is_super_admin() ) {
			add_options_page(
				'Security Manager',
				'Security Manager',
				'manage_options',
				'security-scanner',
				[ $this, 'settingsPage' ]
			);
		}
	}

	/**
	 * Register media for admin settings.
	 * @action admin_enqueue_scripts
	 * @param $hook
	 */
	public function enqueueMedia( $hook ) {
		if( $hook !== 'settings_page_security-scanner' ) return;
		wp_enqueue_script( 'jquery.switchButton', \WPGSecurity\URL . 'assets/jquery.switchButton.min.js', ['jquery-ui-widget', 'jquery-effects-core'], '1.0', true );
		wp_enqueue_style( 'jquery.switchButton', \WPGSecurity\URL . 'assets/jquery.switchButton.min.css' );
	}

	/**
	 * Ajax action when module data is saved.
	 * @action wp_ajax_wpg_security_save
	 */
	public function onAjaxSave() {
		$ID = stripslashes( $_POST['id'] );
		if( strlen( $ID ) ) {

			$postData = isset( $_POST['data'] ) && is_array( $_POST['data'] ) ? $_POST['data'] : [];

			// Update module data
			$data = get_option( 'wpg-security-data', [] );
			$module = $this->loadModuleById( $ID );
			if( $module !== false && $module instanceof DataModify ) {
				$data[ $ID ] = $module->beforeSave( $postData );
			} else {
				$data[ $ID ] = $postData;
			}
			update_option( 'wpg-security-data', $data );

		}
		wp_die();
	}

	/**
	 * Ajax action when module status is changed. (on, off)
	 * @action wp_ajax_wpg_security_status
	 */
	public function onAjaxStatus() {
		update_option( 'wpg-security-modules', is_array($_POST['modules']) ? $_POST['modules'] : [] );
		wp_die();
	}

	/**
	 * Show settings page HTML.
	 */
	public function settingsPage() {
		require 'partials/settings.php';
	}

}
new Scanner;