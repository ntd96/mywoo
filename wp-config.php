<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mywoo' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'I-<*D(^|*X/p.x?_sIK,J;RvH#]1l*i0h3-A>e>ostXH|h%@WhsCSP2VBSoag`5&' );
define( 'SECURE_AUTH_KEY',  'lOC3i}{cq=EOy0Y5{</^^T.Y}QdnpAe5H&aU/^MLp=s<s`f8{b6<p9oWlQX]`QkS' );
define( 'LOGGED_IN_KEY',    'mXE!s8lUmB]ft.q}9*>^/%@sw4df:xv6KleNt|AB!-N`4?yzeo~%~;i9y- C_8>S' );
define( 'NONCE_KEY',        'Sncz$~;XIFUQe^V>kvOw!]m3e5n-P4(d8&G}-X[i`d@}ljAtyu%>)8SdXT6df/?k' );
define( 'AUTH_SALT',        '~m#Vfl{@{1m&sNqu j3pYx?(JKDc%oAZ[tp])i_$gl7~KI{#~`AXy <9IET|XJ_D' );
define( 'SECURE_AUTH_SALT', '7lFE#1v`zRBGw/g&}c* `TwOp]ZsdgcwIU/Af9L.2afYlOnn_UKbd~o6u5&nEDm>' );
define( 'LOGGED_IN_SALT',   '400Ra1*Q 9-;:$Iu@j>5X428BRQ2tR+Q4Vc}YRVmBu@6) j2R@U!um ,1ox(dU*z' );
define( 'NONCE_SALT',       '0-hVA>m|*V0 z8mi0*qSF4.#(XJD=9BXX-+lMyx@G2.{6CKZ;^5`yTV2rl9Ush(7' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
