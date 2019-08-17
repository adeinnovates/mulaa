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
define( 'DB_NAME', 'kultureboom' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         '{94E 0&w4751qz5!%;/7]i5YJ1tA?sd^a]8ZU8Pj2tVRRR,vA{FN]-hFe7$gD{B@' );
define( 'SECURE_AUTH_KEY',  'A!Q+K9>=-`!K $6:59:`$E_4EZFt(GvZN$[;5h]os)iuueDB8~!I+i}:J+hcZGN7' );
define( 'LOGGED_IN_KEY',    'T3+-h4tc hiDkaT37~gCBkO}CR+ :QiR++]9utuh,=!_^s17Ev05@ZBQQ^-m1{@ ' );
define( 'NONCE_KEY',        '=AJB*]*y:,%u[n:R`e/^X$Z].@DGFYDLc$p`^G%H9k80<Y|vo~Q5K/UqS+v6Pgeb' );
define( 'AUTH_SALT',        '=)aQ.&+SJ5qXWTrR[oj {srms%aDMXaRdwqBH:JJA4RzkRW*T{F!yz(_^Wn{7B;P' );
define( 'SECURE_AUTH_SALT', '^]Z3(~OI/t@wMh<g1ei*&;nK@tDdvnYz#msC+Ti.hcBmMm,{i;&oCvz1,GbBiw8H' );
define( 'LOGGED_IN_SALT',   'J%N(tVg+ecSV$1:?5[|Syj_`ffWDSh|SX0n:3CG74e1rwcQl?FZ7W#pv *@H3Ggg' );
define( 'NONCE_SALT',       'Gka+{%w7=PY/#splIAkVB&%ifK2-jE%Kzo=3?+PKM34qWGjg,V%~zKJZzhtP,!0n' );

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
