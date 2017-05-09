<?php

namespace WPGSecurity\Modules;

use WPGSecurity\DataModify;
use WPGSecurity\Module;
use WPGSecurity\ModuleSettings;

/**
 * <p>The application implements an HTML5 cross-origin resource sharing (CORS) policy which allows access from any domain. Permitting access from any origin could present a security risk unless the affected application hosts only unprotected public content</p>
 * <p>This vulnerability check works by submitting a custom Origin header to the target server to determine if all requested origins are permitted. The submitted value is based on the current server domain with an appended parent domain.</p>
 *
 * ###Remediation###
 * Review the domains which are allowed by the CORS policy in relation to any sensitive content within the application.
 *
 * @name WP-JSON Cross-Origin Resource Sharing
 * @package WPGSecurity\Modules
 */
class WPJsonCORS extends Module implements ModuleSettings, DataModify {

	private $_data = [];

	/**
	 * Return module ID from module file name.
	 * @return string
	 */
	public function getId() {
		return basename( __FILE__ );
	}

	public function protect( $data ) {
		$this->_data = $data;

		add_action( 'rest_enabled', [ $this, 'isRestEnabled' ] );
		add_action( 'rest_jsonp_enabled', [ $this, 'isJsonpEnabled' ] );

		if( ! isset( $this->_data['restapi'] )) {
			// Remove api link from RSD
			remove_action( 'xmlrpc_rsd_apis', 'rest_output_rsd' );
			// Remove api link from header <link rel='https://api.w.org/' href="..." />
			remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
			remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
			// Remove api link from headers: Link: <...>; rel="https://api.w.org/"
			remove_action( 'template_redirect', 'rest_output_link_header', 11 );
		}

		// Overwrite WP "rest_pre_serve_request" filter.
		add_action( 'rest_api_init', [ $this, 'removeSendCorsHeaders' ], PHP_INT_MAX - 1, 0 );
		add_filter( 'rest_pre_serve_request', [ $this, 'addCorsHeaders' ] );
	}

	public function removeSendCorsHeaders() {
		// This is a default WP filter which add Access-Control-Allow-Origin.
		// To modify headers we must remove them before.
		remove_filter( 'rest_pre_serve_request', 'rest_send_cors_headers' );
	}

	public function isRestEnabled() {
		return isset( $this->_data['restapi'] );
	}

	public function isJsonpEnabled() {
		return isset( $this->_data['jsonp'] );
	}

	/**
	 * Filter data before save in database.
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function beforeSave( $data ) {
		if( isset( $data['origins'] )) {

			// Split data from textarea by end line to array.
			$data['origins'] = preg_split( "/\\r\\n|\\r|\\n/", $data['origins'] );

			// Return only "*" and correctly parsed urls.
			$data['origins'] = array_filter( $data['origins'], function( $origin ) {
				if( strlen( $origin ) === 0 ) return false;
				if( trim( $origin ) === '*' ) return true;
				$url = parse_url( esc_url_raw( $origin ));
				return ( $url !== false && in_array( $url['scheme'], [ 'http', 'https' ] ) );
			});

			// Parse url to (scheme)://(host), this is Origin header format.
			$data['origins'] = array_map( function( $origin ) {
				if( trim( $origin ) === '*' ) return '*';
				$url = parse_url( esc_url_raw( $origin ));
				return $url['scheme'] . '://' . $url['host'];
			}, $data['origins'] );

			// If "*" exists in array return it only, wildcard.
			if( in_array( '*', $data['origins'] )) {
				$data['origins'] = ['*'];
			}
		}
		return $data;
	}

	/**
	 * Filter data after load from database.
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function afterLoad( $data ) {
		if( isset( $data['origins'] ) && is_array( $data['origins'] )) {
			// Split array to string for textarea field.
			$data['origins'] = implode( "\n", $data['origins'] );
		}
		return $data;
	}

	public function addCorsHeaders( $value ) {
		$origin = get_http_origin();

		if( $origin !== '' && is_array( $this->_data['origins'] ) ) {
			if( $this->_data['origins'][0] === '*' || in_array( $origin, $this->_data['origins'] )) {
				header( 'Access-Control-Allow-Origin: *' );
				header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
				header( 'Access-Control-Allow-Credentials: true' );
			} else {
				error_log("Security Plugin: Origin: {$origin} is not allowed host, for request {$_SERVER['HTTP_REFERER']}\n");
			}
		}

		return $value;
	}

	/**
	 * Return default setting for module.
	 * @return array
	 */
	public function getDefaultSettings() {
		return [
			'restapi'   => true,
			'jsonp'     => true,
			'origins'   => ''
		];
	}

	/**
	 * Return settings HTML for module.
	 * @param mixed $data Data from database.
	 * @return mixed
	 */
	public function settingsView( $data ) { ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row"><label for="credentials">REST API</label></th>
					<td>
						<input type="checkbox" name="restapi" value="1" <?= checked(isset($data['restapi'])) ?>>
						<p class="description">Filter whether the REST API is enabled.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="credentials">JSONP</label></th>
					<td>
						<input type="checkbox" name="jsonp" value="1" <?= checked(isset($data['jsonp'])) ?>>
						<p class="description">Filter whether jsonp is enabled (<a href="https://en.wikipedia.org/wiki/JSONP">JSONP</a>).</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="origins">Allowed hosts</label></th>
					<td>
						<textarea name="origins" id="origins" cols="50" rows="6"><?= isset($data['origins']) ? $data['origins'] : '' ?></textarea>
						<p class="description">One url per line or * which means that the resource can be accessed by any domain in a cross-site manner.</p>
					</td>
				</tr>
			</tbody>
		</table>
	<?php }

}
return new WPJsonCORS;