<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'eventshares' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*Scj|4ul|n|l*)xvag!S9;Xq;W/}3|Tg=d`4&S>%Q]q<vzXXMf8qfMt!9PgfDX>b');
define('SECURE_AUTH_KEY',  '-u Fd6R &!T;ZP-+q*q[0yZe-VR(|/}Ii+`.~Np<sGv+-yD]Bn^`+06}okm5Vs7P');
define('LOGGED_IN_KEY',    '>,6[b#Yz+D7Cr>1Pm{R00}rbjS?864mh}V,b9Ig0}0OGE*(MavQ.#p|cjZF|AK>O');
define('NONCE_KEY',        'JHi<YcB@?NeF/OzC$J_0<xi$%N@_TGMyr*|l9@2X+yc65PGr<;-#DHej@]Lp;u4b');
define('AUTH_SALT',        'VH*jnEF|DP6DP/XGiw|?z|Ouu%#Ia475v{2| ]) i(9_zkxA|$00a8IpH}=3Y7B-');
define('SECURE_AUTH_SALT', 'bGRn|D7O@N(5TExX!^^MZP#.Y#:.-+AzODN-#=&P%4y+bij:Goxd=B4=/@IOTmr9');
define('LOGGED_IN_SALT',   'nWEs7jMcn,ZRT~!D5;kv7$y%!ld]92nKA!^4?xq3&H]xc<{/1z%BfF}^k|/8gK1T');
define('NONCE_SALT',       '-j^HLb~33&T*|DR&v3rZm-dC{-pJ:<:He^{Xl/xX(BEdN^2%8=3L)l1&fFEt2Hk=');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define( 'WP_DEBUG', true );
define( 'WP_ENVIRONMENT', 'DEV' );
define( 'PAGEBOX_AUTOCOMPILE', true );
define( 'WP_POST_REVISIONS', 10 );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
