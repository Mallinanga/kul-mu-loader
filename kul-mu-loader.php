<?php
/*
Plugin Name: Proxy Must-Use Plugin Loader
Plugin URI: https://github.com/Mallinanga/kul-mu-loader
GitHub Plugin URI: https://github.com/Mallinanga/kul-mu-loader
Author: Kraft und Licht
Author URI: http://www.kraftundlicht.com/
Description: Proxy Must-Use Plugin Loader
Version: 1.0
*/
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-backend-language/mu-backend-language.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-backend-language/mu-backend-language.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-cache-busting-magic/mu-cache-busting-magic.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-cache-busting-magic/mu-cache-busting-magic.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-doyouloveme/mu-doyouloveme.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-doyouloveme/mu-doyouloveme.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-fail2ban/mu-fail2ban.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-fail2ban/mu-fail2ban.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-howdy/mu-howdy.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-howdy/mu-howdy.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-jetpack/mu-jetpack.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-jetpack/mu-jetpack.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-local-development/mu-local-development.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-local-development/mu-local-development.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-login/mu-login.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-login/mu-login.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-nginx/mu-nginx.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-nginx/mu-nginx.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-no-new-site-notification/mu-no-new-site-notification.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-no-new-site-notification/mu-no-new-site-notification.php';
}
if ( file_exists( WPMU_PLUGIN_DIR . '/mu-theme-directory/mu-theme-directory.php' ) ) {
    require WPMU_PLUGIN_DIR . '/mu-theme-directory/mu-theme-directory.php';
}
