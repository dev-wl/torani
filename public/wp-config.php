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
define('DB_NAME', 'db606687222');

/** MySQL database username */
define('DB_USER', 'dbo606687222');

/** MySQL database password */
define('DB_PASSWORD', 'k)bf4F4_TO');

/** MySQL hostname */
define('DB_HOST', 'db606687222.db.1and1.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_HOME', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);

// define('WP_HOME', 'http://ak.torani/');
// define('WP_SITEURL', 'http://ak.torani/');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '_um6K|V>Fr| sw*>&q[186S>T}XF]-oJR3`4-O4|I7E)G m09d_o{qTP}@ZT@E^=');
define('SECURE_AUTH_KEY',  '7ufX&;c[3hX}?IQwrx9`?Nq):dQ9XDUKB,3Tq4]u}wo8Y$@?+u@&Of0VqErU|MU:');
define('LOGGED_IN_KEY',    'rT+>foXa}%j-Ddr/1$,Zt.39?`tun.S3b&Frj[.2f-W|X2_+5}-D)t^I&Bm:cYyU');
define('NONCE_KEY',        'Z}|!BC`HsjfdL#R&2$$L}j&fQ90z8Xm?yb1@~--:Ltp`*~O`gP?uDMh(-M._4.Jr');
define('AUTH_SALT',        'yjzyLW~>T+3{/>V8-_WM}^:<DvVXlhT|gkiIh]$}%+wk8=gwkDYx9;:./<Lku-e#');
define('SECURE_AUTH_SALT', 'q7Sai_x@y<BU(^&:kK+p+E(3SrPp0?Id?R ^+jInx-{)C*_?Ne|.$s}tmbC|QNPj');
define('LOGGED_IN_SALT',   ';e|E?+hW#OPKeU<KFX>-pB>pr$}ompj<Vq%[6u|/yw`l]jH}{t>u|Q,o I>>:lI<');
define('NONCE_SALT',       'a!c.YE1{z#Ci6{|Y8.%1Yhw`/F$Jp0}Q[44:#67bRp8/k.(_3&dv#L|y_,_94VA+');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
