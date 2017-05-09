<?php

namespace WPGSecurity\Modules;

use WPGSecurity\Module;
use WPGSecurity\ModuleSettings;

/**
 * WordPress Cleanup. In default this plugin disable below WP options. If You can enable any option, select it.
 *
 * @name WordPress Cleanup
 * @package WPGSecurity\Modules
 */
class WPCleanup extends Module implements ModuleSettings {

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

		// Remove RSD link from header
		if( ! isset( $data['rsd'] )) {
			remove_action( 'wp_head', 'rsd_link' );
		}

		// Remove wlwmanifest link from header
		if( ! isset( $data['wlwmanifest'] )) {
			remove_action( 'wp_head', 'wlwmanifest_link' );
		}

		// Remove enhanced embeds
		if( ! isset( $data['embeds'] )) {
			add_action( 'init', [ $this, 'disableEmbeds' ], PHP_INT_MAX - 1 );
		}

		// Remove emojis
		if( ! isset( $data['emojis'] )) {
			add_action( 'init', [ $this, 'disableEmojis' ]);
		}

		// Move jQuery to the footer
		if( isset( $data['jquery_footer'] ) && ! is_admin() ) {
			$scripts = wp_scripts();
			$scripts->add_data( 'jquery', 'group', 1 );
			$scripts->add_data( 'jquery-core', 'group', 1 );
			$scripts->add_data( 'jquery-migrate', 'group', 1 );
		}

	}

	public function disableEmbeds() {
		/* @var \WP $wp */
		global $wp;

		// Remove the embed query var.
		$wp->public_query_vars = array_diff( $wp->public_query_vars, array(
			'embed',
		) );

		// Remove the REST API endpoint.
		remove_action( 'rest_api_init', 'wp_oembed_register_route' );

		// Turn off oEmbed auto discovery.
		add_filter( 'embed_oembed_discover', '__return_false' );

		// Don't filter oEmbed results.
		remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 );

		// Remove oEmbed discovery links.
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

		// Remove oEmbed-specific JavaScript from the front-end and back-end.
		remove_action( 'wp_head', 'wp_oembed_add_host_js' );
		add_filter( 'tiny_mce_plugins', [ $this, 'disableEmbedsTinyMce' ]);

		// Remove all embeds rewrite rules.
		//add_filter( 'rewrite_rules_array', 'disable_embeds_rewrites' );
	}

	function disableEmbedsTinyMce( $plugins ) {
		return array_diff( $plugins, array( 'wpembed' ) );
	}

	function disableEmojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', [ $this, 'disableEmojisTinymce' ]);
	}

	public function disableEmojisTinymce( $plugins ) {
		if ( is_array( $plugins ) ) {
			return array_diff( $plugins, array( 'wpemoji' ) );
		} else {
			return array();
		}
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
					<th scope="row"><label for="rsd">Really Simple Discovery</label></th>
					<td>
						<input type="checkbox" name="rsd" value="1" <?= checked(isset($data['rsd'])) ?>>
						<p class="description"><a title="Really Simple Discovery on Wiki" href="https://en.wikipedia.org/wiki/Really_Simple_Discovery">RSD</a> is an XML format and a publishing convention for making services exposed by a blog, or other web software, discoverable by client software.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="wlwmanifest">Wlwmanifest</label></th>
					<td>
						<input type="checkbox" name="wlwmanifest" value="1" <?= checked(isset($data['wlwmanifest'])) ?>>
						<p class="description">wlwmanifest.xml is the resource file needed to enable tagging support for Windows Live Writer.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="embeds">Enhanced embeds</label></th>
					<td>
						<input type="checkbox" name="embeds" value="1" <?= checked(isset($data['embeds'])) ?>>
						<p class="description">Don't like the <a href="https://make.wordpress.org/core/2015/10/28/new-embeds-feature-in-wordpress-4-4/">enhanced embeds in WordPress 4.4</a>? Easily disable the feature.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="emojis">Emojis</label></th>
					<td>
						<input type="checkbox" name="emojis" value="1" <?= checked(isset($data['emojis'])) ?>>
						<p class="description">Disables the new emoji functionality in WordPress 4.2.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="jquery_footer">jQuery in the footer</label></th>
					<td>
						<input type="checkbox" name="jquery_footer" value="1" <?= checked(isset($data['jquery_footer'])) ?>>
						<p class="description">Move jQuery to the footer on frontend ("jquery-core" and "jquery-migrate").</p>
					</td>
				</tr>
			</tbody>
		</table>
	<?php }

}
return new WPCleanup;