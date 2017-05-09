<?php

namespace WPGSecurity\Modules;

use WPGSecurity\Module;
use WPGSecurity\ModuleSettings;

/**
 * <p>By default WordPress leaves it’s footprints on your site for the sake of tracking. That is how we know that WordPress is the World’s largest Blogging platform. But sometimes this footprint might be a security leak on your site if you are not running the most updated version of WordPress. Because you are providing the hacker with the useful information by telling them which version you are running.</p>
 *
 * ###This plugin can:###
 * - Remove generator meta from header `<meta name="generator" content="WordPress 4.5" />`
 * - Remove generator attribute from feeds `<generator>http://wordpress.org/?v=4.5</generator>`
 * - Remove version from scripts __ver__ attribute `subscriptions.css?ver=4.5`
 *
 * @name Hide WordPress version
 * @package WPGSecurity\Modules
 */
class HideWpVersion extends Module implements ModuleSettings {

	/**
	 * Return module ID from module file name.
	 * @return string
	 */
	public function getId() {
		return basename( __FILE__ );
	}

	/**
	 * Protect site
	 *
	 * @param $data
	 *
	 * @return void
	 */
	public function protect( $data ) {
		global $wp_version;

		define( 'HIDE_WP_VERSION', 'ver=' . $wp_version );

		// Remove generator meta from header.
		remove_action( 'wp_head', 'wp_generator' );

		// Remove generator attribute from feed xml.
		add_filter('the_generator', '__return_empty_string' );

		// Remove version from scripts.
		if( isset( $data['scripts'] )) {
			add_filter( 'script_loader_src', [ $this, 'clean_media_ver_arg' ] );
			add_filter( 'style_loader_src', [ $this, 'clean_media_ver_arg' ] );
		}
	}

	public function clean_media_ver_arg( $src ) {
		if( strpos( $src, HIDE_WP_VERSION ) !== false ) {
			error_log("Security Plugin: Script has wordpress version in url ver attribute!\n- {$src}\n");
			$src = str_replace( HIDE_WP_VERSION, 'ver=10', $src );
		}
		return $src;
	}

	/**
	 * Return settings HTML for module.
	 *
	 * @param mixed $data Data from database.
	 *
	 * @return mixed
	 */
	public function settingsView( $data ) { ?>
		<table class="form-table">
			<tbody>
			<tr>
				<th scope="row"><label for="credentials">Remove version from scripts and styles</label></th>
				<td>
					<input type="checkbox" name="scripts" value="1" <?= checked(isset($data['scripts'])) ?>>
					<p class="description"><code>wp_enqueue_script( string $handle, string $src = false, array $deps = [], <strong>string|bool|null <u>$ver</u> = false</strong>, bool $in_footer = false );</code></p>
					<p class="description"><code>wp_enqueue_style ( string $handle, string $src = false, array $deps = [], <strong>string|bool|null <u>$ver</u> = false</strong>, string $media = 'all' );</code></p>
					<p class="description">If <code>$ver</code> is set to false, a version number is automatically added equal to current installed WordPress version. If set to null, no version is added.</p>
					<p class="description">For better performance always define <code>$ver</code> as string or null.</p>
					<p class="description">This scanner report fixed urls in PHP error log.</p>
				</td>
			</tr>
			</tbody>
		</table>
	<?php }


}
return new HideWpVersion;