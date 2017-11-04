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
define('DB_NAME', 'wp-test');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'Sr0r|{81J>RYqSBKyH5-Se B)5O;;Fy:?UJaZNbXb+XygD)&x&6Ok{YD|x?#Diy]');
define('SECURE_AUTH_KEY',  '6_ceCckQ0xB]=-6Pc%$w,DKJ Ns^UMwWG ?z!7<77Xt {!!2Y$,`5&1r%=KF*BG8');
define('LOGGED_IN_KEY',    'gGYZi{HW6$xR79Y+g3t=Fl7|}OpXE$/Z3KQ|nmYrEI}7]w]FZ?Qi3Ao(kkFSiX^A');
define('NONCE_KEY',        '[LAf:DH~6khRziO.Qx+u+VRM4K*$5FT4V2{Eta*,_M$2`iI`4`3dM0|7mpQ_fhEl');
define('AUTH_SALT',        'jGc&`q<btx~Dh52OMjrw#_b(Hl6BXCz%J(8a-F?G]k<l}y$3-*Qk9jt~VkLnHYje');
define('SECURE_AUTH_SALT', 'x&ia5|g{5>+%>b/mi(&)~YrB,H/0=zc>m[Ydm)QBWuX7VG?f|(cKYX0Ik6MJYS,h');
define('LOGGED_IN_SALT',   '12SyF[3*(Na=^`7=LF::BtQ2*`/+|4]Ds_}Gd86BLlv ])P#jg=croqZ9)!Q41UM');
define('NONCE_SALT',       '.,o)MV~%t;rtREw1pf+;v1Qu$q1C~+r<hHSh2dpdR-s1kIw6rq}b!=3P[N6NFW4y');

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
