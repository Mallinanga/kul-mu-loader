<?php
/*
Plugin Name: Fail2Ban
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftundlicht.com/
Description: Change response status header for failed logins
Version: 1.0
*/
add_action( 'wp_login_failed', 'nanga_fail2ban' );
function nanga_fail2ban() {
    status_header( 403 );
}
