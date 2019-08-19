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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mulaaco' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'dev.mulaa.co' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );


define('JWT_AUTH_SECRET_KEY', '661b206b2d000c506f962443a4c65d5f');
define('SIMPLE_JWT_AUTHENTICATION_SECRET_KEY', '661b206b2d000c506f962443a4c65d5f');

define('JWT_AUTH_CORS_ENABLE', true);
define('SIMPLE_JWT_AUTHENTICATION_CORS_ENABLE', true);

/** remove on production **/
define('FS_METHOD', 'direct');
/*remove above***/

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '<f+ 9pn!|g89QIJKk{$R$.}aC<{TnM?_c9jaWuC+.bu&Vw259#,[kK|*E/PD1#Hd' );
define( 'SECURE_AUTH_KEY',  'oS%=Oz3tW/6<vaom$v/]q}_J& i2?Ub%mm-BY}SpVUvQ}-KJ[a]QS(R@AkuZ{{*%' );
define( 'LOGGED_IN_KEY',    'Z*~i xvY$w~[GTzJ6M&~k ,#@jPS)Qce8;S^xV;u0A,[MLYYU+^n8:b3_3Bv2%5L' );
define( 'NONCE_KEY',        '9/:PtS<kQ//dwS5FW!bn)%q#WI|p>.gf7f&LH {qQ6A_KSiI$a3x4}PS=:iX|0xf' );
define( 'AUTH_SALT',        'd?K*2JqxldIq0MSn5]++ tbVW/TXh_=;YI8D-!_ZtZ.vHB_MI`1eG.rP9|6Y#dw`' );
define( 'SECURE_AUTH_SALT', 'Amydz<mw3+C~p6qy+kZ[7.q<:#c<p#Vd6g4m-/hTamQusP!6}_Y.La4D0bgMI^_n' );
define( 'LOGGED_IN_SALT',   'N.v`0{=Hd43T!.2L>guOa3OoW^MK:L:0R,R/ZC&Y{y{(Wpl<cqSV._k2Y/m%Y!.,' );
define( 'NONCE_SALT',       'b}D@~Lpe#`6YO>uAw;?M!lbFjD4~om{|qfn:tgQ2@Y$s0YNWUAw6ca?agqDk];8_' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
