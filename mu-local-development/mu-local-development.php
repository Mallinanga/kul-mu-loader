<?php
/*
Plugin Name: Local Development
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftundlicht.com/
Description: Disable plugins when doing local development
Version: 1.0
*/
class CWS_Disable_Plugins_When_Local_Dev {
    static $instance;
    private $disabled = array();
    public function __construct( Array $disables = null ) {
        if ( is_array( $disables ) ) {
            foreach ( $disables as $disable )
                $this->disable( $disable );
        }
        add_filter( 'option_active_plugins', array( $this,
                                                    'do_disabling' ) );
        self::$instance = $this;
    }
    public function disable( $file ) {
        $this->disabled[ ] = $file;
    }
    public function do_disabling( $plugins ) {
        if ( count( $this->disabled ) ) {
            foreach ( (array)$this->disabled as $plugin ) {
                $key = array_search( $plugin, $plugins );
                if ( false !== $key ) {
                    unset( $plugins[ $key ] );
                }
            }
        }
        return $plugins;
    }
}
if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
    new CWS_Disable_Plugins_When_Local_Dev( array( 'core-control.php, vaultpress.php, w3-total-cache.php, batcache.php, jetpack.php, wp-db-backup.php, wp-smushit.php, object-cache.php' ) );
}
