<?php
/*
Plugin Name: Backend Language
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftundlicht.com/
Description: WordPress backend language regardless of WPLANG constant
Version: 1.0
*/
add_filter( 'locale', 'backendlocale', 10 );
function backendlocale( $locale ) {
  if ( is_admin() ) {
    return 'en_US';
  } else {
    return $locale;
  }
}
