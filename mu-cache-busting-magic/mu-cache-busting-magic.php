<?php
/*
Plugin Name: Cache Busting Magic
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftundlicht.com/
Description: This automagically busts cache whenever there is a change in a file
Version: 1.0
*/
add_action( 'wp_enqueue_scripts', function () {
    global $wp_styles, $wp_scripts;
    $wp_dir         = str_replace( home_url(), '', site_url() );
    $site_root_path = str_replace( $wp_dir, '', ABSPATH );
    foreach ( array( 'wp_styles',
                     'wp_scripts' ) as $resource ) {
        foreach ( (array)$$resource->queue as $name ) {
            if ( empty( $$resource->registered[ $name ] ) ) {
                continue;
            }
            $src = $$resource->registered[ $name ]->src;
            if ( 0 === strpos( $src, '/' ) ) {
                $src = site_url( $src );
            }
            if ( false === strpos( $src, home_url() ) ) {
                continue;
            }
            $file = str_replace( home_url( '/' ), $site_root_path, $src );
            if ( !file_exists( $file ) ) {
                continue;
            }
            $mtime                               = filectime( $file );
            $$resource->registered[ $name ]->ver = $$resource->registered[ $name ]->ver . '-' . $mtime;
        }
    }
}, 100 );
