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
define('DB_NAME', 'dev01_wp');

/** MySQL database username */
define('DB_USER', 'dev01_wp');

/** MySQL database password */
define('DB_PASSWORD', 'J~rP6xTrTF4Q');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         '1o=zZO~o!z$h9;hZW LteEZW^Sjs%yt/owTUCW#r<F&S2A*Wm}21G_+R;dL>H<X2');
define('SECURE_AUTH_KEY',  'GtpRVf:o/M[8t5a-Qm)5|>*`;FkoE)V(uS|R~M,;!aMu>c!,R9LgVLok(M/JY@<c');
define('LOGGED_IN_KEY',    '+WHSv+a~9unU![rsbjEwM$vypkK3x:/4r4nr_qDs[t_=$f=d4V?0cHTS2!GE)Aan');
define('NONCE_KEY',        'e&jXrRnE]w?_j(]T6W%cgb#?.6[bz0Iv1xd&n*np^=j-OAFI[O4|n;<p}j+V6N`*');
define('AUTH_SALT',        'Z;!, D e=ux[]5`RQ`~l-h;XvRi}tZ``<.X &NKS2LW_[AZjyS,ft%VSpc39SMQ-');
define('SECURE_AUTH_SALT', 'j:i08hw!h,PoG?U8,)G1$OSPq+uVl`DD1%%|A_>Q{V`NpgVf7vE=Z;fqyA/[S9@h');
define('LOGGED_IN_SALT',   '4xV^PH#Amm/]f9[#Gt:m646rDl~jc?whD?U3Z.n:b@w,Z?Q]ZeExUW87AF=H]~d+');
define('NONCE_SALT',       '/Z0R/^V[O8/?O`j0fn$&i;e:`IPpJkcJaQSf3$Tj~VbXNu4N65OE$b&I9Ly).Q<S');

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
