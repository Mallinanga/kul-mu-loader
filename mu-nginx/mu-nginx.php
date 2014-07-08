<?php
/*
Plugin Name: NGINX Pretty Permalinks
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftundlicht.com/
Description: Add environment plugin to remove index.php from pretty permalinks
Version: 1.0
*/
add_filter( 'got_rewrite', '__return_true', 999 );
