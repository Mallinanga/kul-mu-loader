<?php
/*
Plugin Name: Do You Love Me?
Plugin URI: http://www.kraftundlicht.com/
Author: Kraft und Licht
Author URI: http://www.kraftundlicht.com/
Description: "Must Use" functions for new WordPress installations
Version: 1.0
*/
if ( !function_exists( 'nanga_new_user_notification' ) ) {
    function wp_new_user_notification() {
    }
}
if ( !function_exists( 'nanga_password_change_notification' ) ) {
    function wp_password_change_notification() {
    }
}
remove_action( 'wp_head', 'feed_links_extra' );
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10 );
remove_action( 'wp_head', 'start_post_rel_link', 10 );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
add_action( 'admin_init', 'nanga_imagelink_setup', 10 );
function nanga_imagelink_setup() {
    $image_set = get_option( 'image_default_link_type' );
    if ( $image_set !== 'none' ) {
        update_option( 'image_default_link_type', 'none' );
    }
}

add_action( 'init', 'nanga_remove_features' );
function nanga_remove_features() {
    /* title editor author thumbnail excerpt trackbacks custom-fields comments revisions page-attributes */
    remove_post_type_support( 'page', 'comments' );
    remove_post_type_support( 'attachment', 'comments' );
    remove_post_type_support( 'page', 'custom-fields' );
    remove_post_type_support( 'post', 'custom-fields' );
}

//add_filter( 'admin_bar_menu', 'nanga_replace_howdy', 25 );
function nanga_replace_howdy( $wp_admin_bar ) {
    $my_account = $wp_admin_bar->get_node( 'my-account' );
    $newtitle   = str_replace( 'Howdy,', 'Logged in as', $my_account->title );
    $wp_admin_bar->add_node( array( 'id'    => 'my-account',
                                    'title' => $newtitle,
                                    'href'  => false ) );
}

add_action( 'admin_menu', 'nanga_disable_menus', 9999 );
function nanga_disable_menus() {
    remove_submenu_page( 'index.php', 'wpmandrill-reports' );
    if ( !current_user_can( 'manage_options' ) ) {
        remove_menu_page( 'jetpack' );
        remove_menu_page( 'users.php' );
        remove_menu_page( 'tools.php' );
        remove_menu_page( 'profile.php' );
        remove_menu_page( 'edit-comments.php' );
    }
}

add_action( 'login_head', 'nanga_login_css' );
function nanga_login_css() {
    echo '<style>.login #nav,.login #backtoblog{display:none!important;}.login h1 a{}</style>';
}

add_filter( 'the_excerpt_rss', 'rss_post_thumbnail' );
add_filter( 'the_content_feed', 'rss_post_thumbnail' );
function rss_post_thumbnail( $content ) {
    global $post;
    if ( has_post_thumbnail( $post->ID ) ) {
        $content = '<p>' . get_the_post_thumbnail( $post->ID, 'large' ) . '</p>' . get_the_content();
    }
    return $content;
}

add_filter( 'login_headerurl', 'nanga_login_logo_url' );
function nanga_login_logo_url() {
    return get_site_url();
}

add_filter( 'login_headertitle', 'nanga_login_logo_title' );
function nanga_login_logo_title() {
    return get_option( 'blogname' );
}

add_action( 'widgets_init', 'nanga_remove_default_widgets', 1 );
function nanga_remove_default_widgets() {
    unregister_widget( 'WP_Nav_Menu_Widget' );
    unregister_widget( 'WP_Widget_Archives' );
    unregister_widget( 'WP_Widget_Categories' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Tag_Cloud' );
    unregister_widget( 'WP_Widget_Text' );
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_RSS' );
}

add_filter( 'get_user_option_admin_color', 'change_admin_color' );
function change_admin_color( $result ) {
    return 'light';
}

if ( is_admin() ) {
    remove_action( 'admin_color_scheme_picker', 'admin_color_scheme_picker' );
}
add_action( 'admin_menu', 'remove_metaboxes' );
function remove_metaboxes() {
    remove_meta_box( 'authordiv', 'post', 'normal' );
    remove_meta_box( 'slugdiv', 'page', 'normal' );
    remove_meta_box( 'slugdiv', 'post', 'normal' );
}

//add_action( 'post_submitbox_misc_actions', 'move_author_to_publish_metabox' );
function move_author_to_publish_metabox() {
    if ( current_user_can( 'manage_options' ) ) {
        global $post_ID;
        $post = get_post( $post_ID );
        echo '<div id="author" class="misc-pub-section">';
        post_author_meta_box( $post );
        echo '</div>';
    }
}

add_action( 'admin_bar_menu', 'nanga_change_toolbar', 999 );
function nanga_change_toolbar( $wp_toolbar ) {
    $wp_toolbar->remove_node( 'wp-logo' );
    $wp_toolbar->remove_node( 'new-content' );
    $wp_toolbar->remove_node( 'updates' );
    $wp_toolbar->remove_node( 'comments' );
    $wp_toolbar->remove_node( 'view-site' );
    $wp_toolbar->remove_node( 'wpseo-menu' );
    $wp_toolbar->remove_node( 'edit-profile' );
    $wp_toolbar->remove_node( 'user-info' );
    $wp_toolbar->remove_node( 'view' );
    $wp_toolbar->remove_node( 'edit' );
    $wp_toolbar->remove_node( 'search' );
}

add_action( 'template_redirect', 'nanga_nice_search_redirect' );
function nanga_nice_search_redirect() {
    global $wp_rewrite;
    if ( !isset( $wp_rewrite ) || !is_object( $wp_rewrite ) || !$wp_rewrite->using_permalinks() ) {
        return;
    }
    $search_base = $wp_rewrite->search_base;
    if ( is_search() && !is_admin() && strpos( $_SERVER[ 'REQUEST_URI' ], "/{$search_base}/" ) === false ) {
        wp_redirect( home_url( "/{$search_base}/" . urlencode( get_query_var( 's' ) ) ) );
        exit();
    }
}

add_filter( 'request', 'nanga_empty_search' );
function nanga_empty_search( $query_vars ) {
    if ( isset( $_GET[ 's' ] ) && empty( $_GET[ 's' ] ) ) {
        $query_vars[ 's' ] = ' ';
    }
    return $query_vars;
}

add_filter( 'get_avatar', 'nanga_remove_self_closing_tags' );
add_filter( 'comment_id_fields', 'nanga_remove_self_closing_tags' );
add_filter( 'post_thumbnail_html', 'nanga_remove_self_closing_tags' );
function nanga_remove_self_closing_tags( $input ) {
    return str_replace( ' />', '>', $input );
}

add_filter( 'style_loader_tag', 'nanga_clean_style_tag' );
function nanga_clean_style_tag( $input ) {
    preg_match_all( "!<link rel='stylesheet'\s?(id='[^']+')?\s+href='(.*)' type='text/css' media='(.*)' />!", $input, $matches );
    $media = $matches[ 3 ][ 0 ] !== '' && $matches[ 3 ][ 0 ] !== 'all' ? ' media="' . $matches[ 3 ][ 0 ] . '"' : '';
    return '<link rel="stylesheet" href="' . $matches[ 2 ][ 0 ] . '"' . $media . '>' . "\n";
}

add_filter( 'style_loader_src', 'nanga_remove_ver_css_js', 15, 1 );
add_filter( 'script_loader_src', 'nanga_remove_ver_css_js', 15, 1 );
//add_filter( 'style_loader_src', 'nanga_remove_ver_css_js', 9999 );
//add_filter( 'script_loader_src', 'nanga_remove_ver_css_js', 9999 );
function nanga_remove_ver_css_js( $src ) {
    //if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) ) { $src = remove_query_arg( 'ver', $src ); }
    $src = remove_query_arg( 'ver', $src );
    return $src;
}

add_action( 'init', 'login_checked_remember_me' );
function login_checked_remember_me() {
    add_filter( 'login_footer', 'remember_me_checked' );
}

function remember_me_checked() {
    echo "<script>document.getElementById('rememberme').checked = true;</script>";
}

add_action( 'login_head', 'nanga_login_error' );
function nanga_login_error() {
    remove_action( 'login_head', 'wp_shake_js', 12 );
}

add_filter( 'body_class', 'nanga_body_class' );
function nanga_body_class( $classes ) {
    global $wp_query;
    $no_classes = '';
    if ( is_page() ) {
        $page_id    = $wp_query->get_queried_object_id();
        $no_classes = 'page-id-' . $page_id;
    }
    if ( is_single() ) {
        $post_id    = $wp_query->get_queried_object_id();
        $no_classes = 'postid-' . $post_id;
    }
    if ( is_author() ) {
        $author_id  = $wp_query->get_queried_object_id();
        $no_classes = 'author-' . $author_id;
    }
    if ( is_category() ) {
        $cat_id     = $wp_query->get_queried_object_id();
        $no_classes = 'category-' . $cat_id;
    }
    if ( is_tax() ) {
        $ancestors = get_ancestors( get_queried_object_id(), get_queried_object()->taxonomy );
        if ( !empty( $ancestors ) ) {
            foreach ( $ancestors as $ancestor ) {
                $term       = get_term( $ancestor, get_queried_object()->taxonomy );
                $classes[ ] = esc_attr( "parent-$term->taxonomy-$term->term_id" );
            }
        }
    }
    if ( is_single() || is_page() && !is_front_page() ) {
        $classes[ ] = basename( get_permalink() );
    }
    $home_id_class  = 'page-id-' . get_option( 'page_on_front' );
    $remove_classes = array( 'page-template-default',
                             $home_id_class,
                             $no_classes );
    $classes        = array_diff( $classes, $remove_classes );
    return $classes;
}

add_filter( 'embed_oembed_html', 'nanga_embed_wrap', 10, 4 );
function nanga_embed_wrap( $cache, $url, $attr = '', $post_ID = '' ) {
    return '<div class="entry-content-asset">' . $cache . '</div>';
}
