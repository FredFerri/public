<?php

// This setting is required to make sure that WordPress updates can be properly managed in WordPress Toolkit. Remove this line if this WordPress website is not managed by WordPress Toolkit anymore.

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
define('DB_NAME', 'bx1_prod');

/** MySQL database username */
define('DB_USER', 'bx1_prod');

/** MySQL database password */
define('DB_PASSWORD', '.}sVc6.EThtE7pp');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');
#define('DB_HOST', '192.168.0.105:3306');

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
define('AUTH_KEY',       'epAs@BqeHhh8TSFB(zCt90OX0AkeDFO259N06fqB7O*m^Vu9v&gS!)szLkoC9rn0');
define('SECURE_AUTH_KEY',       'n9MW84IJll25YXE)5Xc5L@tX^H6zyEFLS%J9gs6XL3P#Q53SvZ*flOjckm1Cm%Gc');
define('LOGGED_IN_KEY',       '3EHhOT6p*B%JbY9ksvfwC@bdV&aO^URM@#FgHdEto!6MkVcBkuyu0Fqgy@ruCe@*');
define('NONCE_KEY',       'c4FrzMFWuMm(67Ht%AzMgW%66EK8oV(*93i%gP!(Vlf98fCH8ngQdfg9XOdW5N0y');
define('AUTH_SALT',       'VK^#A!yY6tRb*PO&4)PWER1E!Pf2G%Xx(7#Je%1(9s)M(WCitNd%aN^k0Z6f)wYe');
define('SECURE_AUTH_SALT',       '3)vqjc!UP&C8K9EAAn@ui7CDNo13&A%6UlzU2h4nIdLvlwGWBo6%IeX#qb&4cBY#');
define('LOGGED_IN_SALT',       '#*atTjenB&AD7nHgxEe1M^N*lsfOsqVPBRC(VmT)aDZuHp*AZmN8ZpSts42^DHWl');
define('NONCE_SALT',       'rixvUizM%1(YVKMw)YaAdt%tI77LirWDm1Gg6Lk8ArVmXUS!3U!Gc1DUuvJckjG8');
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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
//--- disable WPCron to use crontab in place
//define('DISABLE_WP_CRON', true);
//--- disable auto upgrade
define( 'AUTOMATIC_UPDATER_DISABLED', true );
?>
