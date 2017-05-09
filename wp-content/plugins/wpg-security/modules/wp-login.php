<?php

namespace WPGSecurity\Modules;

use WPGSecurity\Module;
use WPGSecurity\ModuleSettings;
use WPGSecurity\RunOnAdmin;

/**
 * WordPress Authentication
 *
 * @name WordPress Authentication
 * @package WPGSecurity\Modules
 */
class WPAuthentication extends Module implements ModuleSettings, RunOnAdmin {

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

		// Log Out cache fix
		if( isset( $data['cache_fix'] )) {
			add_filter( 'nocache_headers', function ( $headers ) {
				$headers['Expires'] = 0;
				$headers['Cache-Control'] = 'no-cache, no-store, must-revalidate, max-age=0';
				$headers['Pragma'] = 'no-cache';
				return $headers;
			}, PHP_INT_MAX - 1 );
		}

		// Replace authentication messages.
		if( $GLOBALS['pagenow'] === 'wp-login.php' && isset( $data['replace'] )) {

			add_filter( 'shake_error_codes', function( $shake_error_codes ) {
				return array_diff( $shake_error_codes, array( 'invalid_email', 'invalidcombo', 'invalid_username', 'incorrect_password' ));
			}, PHP_INT_MAX - 1 );

			add_action( 'lostpassword_post', function ( \WP_Error $errors ) {

				// Hide red border for error.
				$errors->add_data( 'message', 'invalidcombo' );

				// Remove bad email error.
				if ( in_array( 'invalid_email', $errors->get_error_codes() ) ) {
					$errors->remove( 'invalid_email' );
				}
			} );

			add_filter( 'gettext', function ( $translated, $text, $domain ) use ( $data ) {
				if ( $domain === 'default' ) {

					// Always return the same message in login form.
					if ( $text === '<strong>ERROR</strong>: Invalid username.' && $translated === $text && isset( $data['invalid_credentials'] ) && strlen( $data['invalid_credentials'] ) ) {
						return "<strong>ERROR</strong>: {$data['invalid_credentials']}";
					}
					if ( $text === '<strong>ERROR</strong>: The password you entered for the username %s is incorrect.' && $translated === $text && isset( $data['invalid_credentials'] ) && strlen( $data['invalid_credentials'] ) ) {
						return "<strong>ERROR</strong>: {$data['invalid_credentials']}";
					}

					// Replace message for lost password, always return success.
					if ( $text === '<strong>ERROR</strong>: Invalid username or email.' && $translated === $text && isset( $data['lost_password'] ) && strlen( $data['lost_password'] ) ) {
						return $data['lost_password'];
					}
				}

				return $translated;
			}, 10, 3 );
		}

		if( isset( $data['custom_expiration'] )) {
			add_filter( 'auth_cookie', function ( $cookie, $user_id, $expiration, $scheme, $token ) use ( $data ) {
				$this->updateUserSession( $user_id, $token, $data );
				return $cookie;
			}, 20, 5 );
		}

		add_action( 'init', function() use ( $data )  {
			if( ! is_user_logged_in() ) return;

			if( isset( $data['custom_expiration'] ) || isset( $data['multiple'] )) {
				$userID = get_current_user_id();
				if ( $userID > 0 ) {
					$sessions = \WP_Session_Tokens::get_instance( $userID );

					if( $sessions instanceof \WP_Session_Tokens ) {

						$token = wp_get_session_token();

						// Enable custom user session expiration.
						if ( isset( $data['custom_expiration'] )) {
							$this->updateUserSession( $userID, $token, $data, $sessions );
						}

						// Log out multiple user sessions
						if ( isset( $data['multiple'] ) && count( $sessions->get_all() ) > 1 ) {
							$sessions->destroy_others( $token );
						}

						// Disable session hijacking
						if( isset( $data['session_hijack'] )) {
							$session = $sessions->get( $token );
							// Compare session login IP and current client IP, and user agent.
							if( strcmp( $session['ip'], $_SERVER['REMOTE_ADDR'] ) !== 0 || strcmp( $session['ua'], wp_unslash( $_SERVER['HTTP_USER_AGENT'] ))) {
								$sessions->destroy( $token );
								wp_die('Session Hijacking attack!');
							}
						}
					}
				}
			}
		});
	}

	public function updateUserSession( $userID, $token, $data, \WP_Session_Tokens $sessions = null ) {
		if( $userID <= 0 ) return;
		if( $sessions === null ) {
			$sessions = \WP_Session_Tokens::get_instance( $userID );
			if ( ! $sessions instanceof \WP_Session_Tokens ) return;
		}

		if( $token !== '' ) {
			$expiration = isset( $data['expiration'] ) ? (int) $data['expiration'] : 0;
			if( $expiration > 0 && isset( $data['expiration_period'] )) {
				switch( $data['expiration_period'] ) {
					case '2': $expiration *= 60; break;    // minutes
					case '3': $expiration *= 3600; break;  // hours
				}
				$session = $sessions->get( $token );
				$session['expiration'] = time() + $expiration;
				$sessions->update( $token, $session );
			}
		}
	}

	/**
	 * Protect admin.
	 *
	 * @param $data
	 *
	 * @return mixed
	 */
	public function protectAdmin( $data ) {
		$this->protect( $data );
	}

	/**
	 * Return default setting for module.
	 * @return array
	 */
	public function getDefaultSettings() {
		return array(
			'expiration'            => 15,
			'expiration_period'     => 2,   // 15 minutes
			'cache_fix'             => '1',
			'invalid_credentials'   => 'Invalid username or password.',
			'lost_password'         => 'Check your email for the confirmation link.'
		);
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
					<th scope="row"><label for="custom_expiration">User session expiration</label></th>
					<td>
						<input type="checkbox" name="custom_expiration" value="1" <?= checked(isset($data['custom_expiration'])) ?>>
						<p class="description">Enable custom user session expiration.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"></th>
					<td>
						<input type="number" class="small-text" name="expiration" min="1" value="<?= isset($data['expiration']) ? $data['expiration'] : '' ?>">
						<select name="expiration_period">
							<option <?= selected(isset($data['expiration_period']) && $data['expiration_period'] === '1') ?> value="1">seconds</option>
							<option <?= selected(isset($data['expiration_period']) && $data['expiration_period'] === '2') ?> value="2">minutes</option>
							<option <?= selected(isset($data['expiration_period']) && $data['expiration_period'] === '3') ?> value="3">hours</option>
						</select>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="session_hijack">Disable session hijacking (by&nbsp;client&nbsp;IP and User Agent)</label></th>
					<td>
						<input type="checkbox" name="session_hijack" value="1" <?= checked(isset($data['session_hijack'])) ?>>
						<p class="description">The <a href="https://www.owasp.org/index.php/Session_hijacking_attack">Session Hijacking attack</a> compromises the session token by stealing or predicting a valid session token to gain unauthorized access to the Web Server.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="cache_fix">Log Out cache fix</label></th>
					<td>
						<input type="checkbox" name="cache_fix" value="1" <?= checked(isset($data['cache_fix'])) ?>>
						<p class="description">Prevent load admin page from cache when user log out and go history back.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="multiple">Log out multiple user sessions</label></th>
					<td>
						<input type="checkbox" name="multiple" value="1" <?= checked(isset($data['multiple'])) ?>>
						<p class="description">Is that a single user could be logged in only one device at the same time.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="replace">Replace authentication messages</label></th>
					<td>
						<input type="checkbox" name="replace" value="1" <?= checked(isset($data['replace'])) ?>>
						<p class="description">Protect to determine if user or email is registered on page. Always return positive messages.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="invalid_credentials">Invalid username or password message</label></th>
					<td>
						<input type="text" class="large-text" name="invalid_credentials" value="<?= isset($data['invalid_credentials']) ? $data['invalid_credentials'] : '' ?>">
						<p class="description">Replace login messages:</p>
						<p class="description"><code>Invalid username.</code> and <code>The password you entered for the username %s is incorrect.</code> on <strong>wp-login.php</strong> page.</p>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="lost_password">Invalid username or email in lost password page</label></th>
					<td>
						<input type="text" class="large-text" name="lost_password" value="<?= isset($data['lost_password']) ? $data['lost_password'] : '' ?>">
						<p class="description">Replace login messages:</p>
						<p class="description"><code>Invalid username or email.</code> on <strong>wp-login.php?action=lostpassword</strong> page.</p>
					</td>
				</tr>
			</tbody>
		</table>
	<?php }

}
return new WPAuthentication;