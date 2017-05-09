<?php

namespace WPGSecurity\Modules;

use WPGSecurity\Module;

/**
 * <p>It as possible to enumerate Wordpress usernames by cycling the numeric value passed via the `?author=1` query string parameter. This form of username enumeration is considered particularly dangerous since it allows all users to be extracted rather than a smaller subset common with less powerful techniques. Unmaintained user accounts that are not actively used to post content may be configured with a weak or default password.</p>
 * <p>A common strategy employed by hackers is to enumerate valid usernames and then perform a password guessing attack in an attempt to gain unauthorised access. If the compromised user account has author or administrator privileges it is possible to gain complete control of the affected Wordpress system. In most cases it is also possible to execute malicious code on the server by editing and existing PHP file or by uploading a file designed to take control of the web server host.</p>
 *
 * ###Enable this module to prevent enumeration or add .htaccess rules###
 * The following `.htaccess` rule can be applied to prevent username enumeration via the `?author=X` method:
 *
 * > RewriteCond %{QUERY_STRING} author=\d
 * > RewriteRule ^ /? [L,R=301]
 *
 * @name Stop User Enumeration
 * @package WPGSecurity\Modules
 */
class StopUserEnumeration extends Module {

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
		if ( isset( $_GET[ 'author' ]) && !empty( $_GET[ 'author' ]) && ! is_admin() ) {
			if( preg_match( '/(wp-comments-post)/', $_SERVER[ 'REQUEST_URI'] ) === 0 ) {
				openlog( "wordpress({$_SERVER['HTTP_HOST']})", LOG_NDELAY | LOG_PID, LOG_AUTH );
				syslog( LOG_INFO, "Attempted user enumeration from {$_SERVER['REMOTE_ADDR']}" );
				closelog();
				wp_die('Forbidden');
			}
		}
	}

}
return new StopUserEnumeration;