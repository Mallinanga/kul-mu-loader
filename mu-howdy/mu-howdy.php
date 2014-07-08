<?php
/*
Plugin Name: No Howdy
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftunlicht.com/
Description: Removes "Howdy, " from the toolbar
Version: 1.0
*/
class CWS_No_Howdy {
    const howdy    = 'Howdy, %1$s';
    const no_howdy = '%s';
    public function __construct() {
        add_action( 'admin_bar_menu', array( $this,
                                             'hook_in' ), 0 );
        add_action( 'admin_bar_menu', array( $this,
                                             'hook_out' ), 9999 );
    }
    public function hook_in() {
        add_filter( 'gettext', array( $this,
                                      'kill_howdy' ) );
    }
    public function hook_out() {
        remove_filter( 'gettext', array( $this,
                                         'kill_howdy' ) );
    }
    public function kill_howdy( $text ) {
        if ( self::howdy === $text ) {
            $this->hook_out(); // We're done, so let's remove ourselves.
            return self::no_howdy;
        }
        return $text;
    }
}
new CWS_No_Howdy;
