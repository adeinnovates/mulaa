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
define( 'DB_NAME', 'mulaa' );

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
define( 'AUTH_KEY',         '%eWe^o~DsXfF2oP}7DU!m9pI? [`Sg[#9)!@4K|C5,(hQF-0NkgC;0Y5P0Yoh/?l' );
define( 'SECURE_AUTH_KEY',  'Mwqp^QC&PaX{[}hvF<#&Q:i|aK(]u1ca]7&rV}`?BH;(G4jl8WeLbK9GCG57R)}@' );
define( 'LOGGED_IN_KEY',    't:{~(j&f;czBZ:Z6~Y4E3?A2IF}|D4;#Q?KQ*aHry*2=e!I%.yrK}TsIf&$[lnN6' );
define( 'NONCE_KEY',        'rr=_{AF.^H|ih{!t2U@7eO*[xgKMwhEYokG!=6uq+1Cl<4Q.oU;?k]u*or4mIbmb' );
define( 'AUTH_SALT',        'WT++ 3V5&{4 3NTcg5$CQ:<A2M?8;$*$(.5}ZV}T@6fpT<,Vy}7|h)3w~!j%5]2=' );
define( 'SECURE_AUTH_SALT', '^z%r]EN@.asov-9(EUtD%K|b7kmRrfe%Z~iGq-LG}FA%V@iMuFSJzCk_io7>NukU' );
define( 'LOGGED_IN_SALT',   '1I=74Jc>a~t^K4JE(,?k@([[%>zPdg]F6i#W(@qT}e@;jdCs`3ygOOS%RBEkF.~t' );
define( 'NONCE_SALT',       'KTMu~Z!d*NQK(8s%{&#uCD{jS|@i}/MNRq?i!jkw,h1HohX~IIvvoBc414pkO_m5' );

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
