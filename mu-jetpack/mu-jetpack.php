<?php
/*
Plugin Name: Jetpack
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftunlicht.com/
Description: Default Jetpack modules
Version: 1.0
*/
class CWS_Jetpack_Modules {
    function __construct() {
        add_filter( 'option_jetpack_active_modules', array( $this,
                                                            'active_modules' ) );
    }
    function active_modules( $modules ) {
        $allowed_modules       = array( 'enhanced-distribution',
                                        'mobile-push',
                                        'publicize',
                                        'stats', );
        $forced_active_modules = array( 'enhanced-distribution',
                                        'mobile-push',
                                        'publicize',
                                        'stats', );
        $modules               = array_intersect( (array)$modules, $allowed_modules );
        $modules               = array_merge( $modules, $forced_active_modules );
        $modules               = array_unique( $modules );
        return $modules;
    }
}
new CWS_Jetpack_Modules;
