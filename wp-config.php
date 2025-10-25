<?php
//Begin Really Simple Security session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple Security cookie settings
//Begin Really Simple Security key
define('RSSSL_KEY', 'y45ureWLap3idPnRD1dLUnywr9WcwIv27o443SayU9MvGwLRqgOeX4xLb4njaJyn');
//END Really Simple Security key

/** Enable W3 Total Cache */
define('WP_CACHE', false); // Temporarily disabled


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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', '39190440_31025ae9' );

/** Database username */
define( 'DB_USER', '39190440_31025ae9' );

/** Database password */
define( 'DB_PASSWORD', 'l2nFn1v9' );

/** Database hostname */
define( 'DB_HOST', 'mysql8' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'oXx4XeqJ2(_jPVBTm)XrZ0Y+^a&((b&}?X#ViS,1$Shl?,_1G#L/*?Y?}]i%aytb' );
define( 'SECURE_AUTH_KEY',   'bw$SZai#K|9JMIB5;[WSbs+4K-.AI#E%XShEA%h.xWNR+;o^atmit AWbQ)e-1yZ' );
define( 'LOGGED_IN_KEY',     'C*VK:sU.9IYI+w_l*E[{+uMb%V?9o+63-W-1p)1?7^p}j0S{y+N(3g*DZLv~GA r' );
define( 'NONCE_KEY',         'RWO1g@[&.&#~nwA%j3;8NK.A=y.V1v*T~[tbI~X/WWI4m9C;!i:kUsYricPf=d~f' );
define( 'AUTH_SALT',         'R<%D(If<_jPz8n6qG|{T&2B2^Wx7Mnk+} ,|J.Y>{~_@yk6}k!:&OR}ylvo|YNw$' );
define( 'SECURE_AUTH_SALT',  'e_x.ccwZFQRdx~QQKPBE6|jS$Qs3@(pDP7DGc&65S&5A&[ucH>V0ZpC5,b/!+5tU' );
define( 'LOGGED_IN_SALT',    '/3}_iIiaq3:v*#S=_AR,={QOgAWSAAITm;b/KQ%qwi~^j*:0vH9?QhKx9[,y?2)4' );
define( 'NONCE_SALT',        ':E*5!KR1hZ`u@h%t9|)CAxpA</I}M|_>Y_# K;;XbQki r{VP(M?RSwsr+sy%v)@' );
define( 'WP_CACHE_KEY_SALT', '8Ih1LM+E6}.ctE4E+q]An=,OQ2t3W2;:`/;ec2BKn(z_bGf-!H)X&6*K9vx!9gS0' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
