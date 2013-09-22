<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'the_market');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'S<<#34:XV&HrU jxnfSf2wK~9T8-?*lgr<PW%BI@lSC$Vj10f(|Zeb[c:qTP1f9o');
define('SECURE_AUTH_KEY',  'bVCr;Jr;h6G@.2]Q=w--m3tKVr^HClSp]=F0c+-b6=e|uVlMu(vtG8%[+nb$(Kh}');
define('LOGGED_IN_KEY',    'e_eq+nu&+-: {3d[ #M4z6lhmRGT.|R[g?17;v A(sS4@v@rc#]M5H|L|oZ*gNu:');
define('NONCE_KEY',        '{j1[~dn-/&JKa2sZVMS^$||_%7U:p[dC-]i2-:Y:7oqc<wG|<Q}WQ_`[qf*G{+Kq');
define('AUTH_SALT',        '*os_?R8bZ/^_b#2HH32,>$~bf57yA)J:r@|ee 5v_Y`!3h1Il;x,^f=PwgO/!x[]');
define('SECURE_AUTH_SALT', 'U5JCbvpc|=1{Ojj,,|/+^T_,W~qag$]xlR!cRPur 4^Mxb7t8-GT/VC}+D->GJ*t');
define('LOGGED_IN_SALT',   'C6|m5MASZ<Lg|{t;S-1;nrlT*1:W4cZi/+ p!v-.kWTOWxe*JoK5LFfbdxB,D=6S');
define('NONCE_SALT',       '?oWBN`i/j$(ZO$~_3%$n)NTXG-d_/!kZO(vr P+F7N5*4cs<=@RD0  `u0B|Szo6');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
