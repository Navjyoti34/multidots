<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '~S}Fg;Un4R%scGWcS2Y58SE6)nY9acVzAB&&y]hd7zt?BW0f218s)}:)2xqGb,<c' );
define( 'SECURE_AUTH_KEY',  'Hn/v69$Xw;F>-]fL:z<Woqa,]mkM~dTJ2)SFQR[_n)oik3}~])JtgRqp|5RGh%8D' );
define( 'LOGGED_IN_KEY',    '(<99F!5uQYzeKTaI<N@@$/KvW! Yt*bt/Qq=P(}ov5Z)6rY(tIvzgR;.ZAdcT28c' );
define( 'NONCE_KEY',        'fnXKW:9zLCmRuzdX^OBt>.6no=x1]h~VDi|(Ug0myCv[k5owcEO:PcHafbIUiH);' );
define( 'AUTH_SALT',        '&CVSTI0<~8aeNX?~BjtAo&{ng<qla4QznbSj_DAqa8+C_<-1}h3T]T--,Ix.165v' );
define( 'SECURE_AUTH_SALT', 'dLs:qC @6SHH@8+0aJ0uVm+vDV;(> q>xK1Z5Z#hAw%Sa,9Bb-`tAi#4%W6{be3v' );
define( 'LOGGED_IN_SALT',   'I8*p4Jxw#q~X1;plc]~`2o`C)WRai0]B]#|[RQ{(9E=??%OrO.!o{K3V$]M*)mZU' );
define( 'NONCE_SALT',       'S/eda~tJ2oM1#~Q  EKZjg+kw_3wx^BmIQ7L?+JlR8&JgViGJ @*&Mz/Yq}FKBAp' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
