<?php
/*
Plugin Name: No "New WordPress Site" E-mail
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftunlicht.com/
Description: Prevents the "New WordPress Site" e-mail from being sent out
Version: 1.0
*/
class CWS_No_New_WordPress_Site_Email {
    static $instance;
    public function __construct() {
        self::$instance = $this;
        add_action( 'phpmailer_init', array( $this,
                                             'maybe_kill_email' ) );
    }
    public function maybe_kill_email( $phpmailer ) {
        if ( 'New WordPress Site' === $phpmailer->Subject ) {
            $phpmailer->ClearAllRecipients();
        }
    }
}
new CWS_No_New_WordPress_Site_Email;
