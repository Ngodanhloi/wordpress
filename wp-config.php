<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

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
define( 'AUTH_KEY',         '[f^QCW2Q]3rVb$g3e1`ZQ+A?lTY_BvXp;vK.W*t}n)s(+b-nz[jGPJ?8e~.:ae+3' );
define( 'SECURE_AUTH_KEY',  '>FOTlqM/8<MRiF?~DB6~q9_h5>)CQ# nji)j^lCQ4+vmRG>Yok@MwD5umGNWP,-X' );
define( 'LOGGED_IN_KEY',    'fPH$`D[#hl6)~/L%W~h^1o.<duUG4>Q3h67.@!jF=eG@gHw_rWGbRj0+&X;Hh5/J' );
define( 'NONCE_KEY',        '>!4Kfg!&vjsgR1&@i9=j<vMdBpOzd#B?g}).-&D@DP7HI*dF<[Q&<x113RtUbT##' );
define( 'AUTH_SALT',        'UQZG_4U{<Rix.v|Yr@=79|7-jVd~?*EuAxq{RRELAAhD:~}8;>jcCVK&Nmlg  *|' );
define( 'SECURE_AUTH_SALT', 'I20f2^Mr0b /=5]cd~xXeyhk?mC&sOY_IfQwd!|T_.]?)yPXhGn9Cr,,cL)ih{3o' );
define( 'LOGGED_IN_SALT',   '1y#{!NwJMW:4GSjZ;pj+7nn;>w&(z|v]+]IZf!;f>S(vy^Xfl(p|=et.K`PZZU4F' );
define( 'NONCE_SALT',       'g/J48xa(^1>;kMp}3(g>A>_Am_qudbEB)Q 4-(pUscN/.=C}vt=y/0::Ur93kQQg' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
