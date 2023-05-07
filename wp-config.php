<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp-template' );

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
define( 'AUTH_KEY',         'ivno)AGy2j0>FqCMnDpm7,,1?mi ,{n(uM {i<>@9MkaB`(Y8}3ty9MQWguS,QZU' );
define( 'SECURE_AUTH_KEY',  '2*6`xZI ceVf}qrI5N3f{l.S-a3)BC$={alw*mFI2uK P-(XM.W[-N]N|cL.f4v ' );
define( 'LOGGED_IN_KEY',    'fN,5_ +>64TcJ?|jT-~p6N/a5MSf97j*dRsU62~eU4i{qM].tfnIOIQ{8*_3S2j&' );
define( 'NONCE_KEY',        ',,jK@h%/pY,Q%oc`wuR@0*~COK}42^$dITiOiU*/MKd3s!Wh_ZoN{E(ttOmE=zaI' );
define( 'AUTH_SALT',        'O0]si;#z46_+w<3E@Nwu0.haq0:5;@xA]KYYS3[&WV{l-r/MxPBNqnXPdECdx6&b' );
define( 'SECURE_AUTH_SALT', '2el(OPJ^Wl`c2SdSzP>ti15<+FSW6hzgKd$k![OM~{H-U|}z&BUxZnxz=h+?A6sE' );
define( 'LOGGED_IN_SALT',   'CEAC`w*L*$pzGcMF_7}<?zbm`<fW<E/IBRG`yt&aR%C-:=@g-Gbj6zk~A{hRE2K(' );
define( 'NONCE_SALT',       'bM1m24rx@{!!,efP}$I1MKCk@oDsg[z4Xv?/g0<V2&RV|i&1@,D:q3p@<vT1{]z9' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wpt_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
