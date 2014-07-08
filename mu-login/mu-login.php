<?php
/*
Plugin Name: Login CSS
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftunlicht.com/
Description: Custom login CSS
Version: 1.0
*/
class CWS_Login_Logo_Custom_CSS_Plugin {
    static $instance;
    const HANDLE  = 'wp-login-css';
    const VERSION = 1;
    public function __construct() {
        self::$instance = $this;
        add_action( 'login_head', array( $this,
                                         'login_head' ), 1 );
    }
    public function login_head() {
        wp_register_style( self::HANDLE, plugin_dir_url( __FILE__ ) . 'wp-login.css', array(), self::VERSION );
        wp_print_styles( self::HANDLE );
    }
}
new CWS_Login_Logo_Custom_CSS_Plugin;
