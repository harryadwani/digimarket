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
define( 'DB_NAME', 'digimarkDB6kmyb');

/** MySQL database username */
define( 'DB_USER', 'digimarkDB6kmyb');

/** MySQL database password */
define( 'DB_PASSWORD', 'xXju5GPaYj');

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1');

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
define( 'AUTH_KEY', 'a11Gs_-:Zps!NCo@thxDWOh:DGW_1#~1dtw|RldSh:GGV|4:Gs!wTi2HET*22#6i+');
define( 'SECURE_AUTH_KEY', 'Ur3IFIu,<7m$u<UjX4N-[|5k-oo@NR@0[8o@@0cRgcr8Rt#SiWPi;DHW#5;_1hxw]');
define( 'LOGGED_IN_KEY', 'l_p<3br$YXjQEUy<Iu*u.MmyALf<2v!ocs4FFUB0Fn@zff>BQy,GS~1Gp--|shw8O');
define( 'NONCE_KEY', '~9ht:VhWCOOd[81Gs~AP+<a.;Hq+xetiIUMY^BQy,$>uqyfUf{7-CNCR54Go!VJZG');
define( 'AUTH_SALT', 'b2IAP${o!NcVo4J88N@}|8kz@}YncUk4JMc>B4>7j@9O-:#5l--p~KdWp5KOd[~:|');
define( 'SECURE_AUTH_SALT', 'yTTi;DAPWmaQf{E7Q${E2eyq*PfeuETHAT*;2Hx#*t.Pec>4}7kvvcgv7Jj{7}v,');
define( 'LOGGED_IN_SALT', 'm^jbITE{62E{.bmFVB4Fs@z>}^nyn$FU1Zpdt5KKd[85Kw|[8kZoh-GRR8NCNwmP');
define( 'NONCE_SALT', '+cFMg}4F}^}vr$EYbIIQy{3fq:w!-|Rs@GRk:84!@kVgN#;xlxeep1D5_;[5_w_K');

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
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
