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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'db_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'db_user' );

/** MySQL database password */
define( 'DB_PASSWORD', 'db_password' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Ly>k5iDG8e6*Y4C@x|D6m&~jAY~L54]~.Cp|R+Snl9Q`-=WU[1hL~g>9m-d2=cN@');
define('SECURE_AUTH_KEY',  'ULK@xG#L%?L:e=w>B=`}S{Paj+UX)S3SvICKFas*P~MwzFRDSmCl%c`57k;wqoB&');
define('LOGGED_IN_KEY',    'd~DxhLb{!`+vB#~AK ],H:|vd?*|yz.9Ect+3I6dh6pE 5pWfd~TFm+qu<4aU3k-');
define('NONCE_KEY',        '_x|AZ?iv+|<^cX,ux^Xf=@ls)Czmo|PUD d|WC5Y``HEFHbt7c}+{I&Fhji%#I1#');
define('AUTH_SALT',        'ZBfUHN${/b0.PWRpAL9eoRw229O;L`2Ny+*cqjU-N}oM]E%Ic&eN!#:l_SO.S<-#');
define('SECURE_AUTH_SALT', '::oA=st{gtc:xAS2~Oj@uk/;$]h-aG|#./6SIpwtgP/XiOOko.8GdNGR&>S8e=}j');
define('LOGGED_IN_SALT',   'IZD|Ijk(1v>uTHh$Dn]#/rU1apBqEl*BF]?6H{W<>)Y7[5. -+uw<B$pT~d1Y>CU');
define('NONCE_SALT',       'O9aFMNd97Xjgi-|+,WL:ad(<vV,|Z|#*.{t+)qx .HMExiH,[eE&RJmf-^mSEXxf');

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
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
