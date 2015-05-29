<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'parallax', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'parallax' ) );

//* Add Image upload to WordPress Theme Customizer
add_action( 'customize_register', 'parallax_customizer' );
function parallax_customizer(){

	require_once( get_stylesheet_directory() . '/lib/customize.php' );

}

//* Include Section Image CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Parallax Pro Theme' );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/parallax/' );
define( 'CHILD_THEME_VERSION', '1.2' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'parallax_enqueue_scripts_styles' );
function parallax_enqueue_scripts_styles() {

	wp_enqueue_script( 'parallax-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'parallax-google-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Reposition the primary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_nav' );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'parallax_secondary_menu_args' );
function parallax_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

add_filter('genesis_pre_load_favicon', function () {
    return get_stylesheet_directory_uri().'/favicon.ico';
});

//* Edit Read More links
add_filter( 'get_the_content_more_link', 'sp_read_more_link' );
function sp_read_more_link() {
	return '... <a class="more-link" href="' . get_permalink() . '">Read More &raquo;</a>';
}

//* Remove the entry meta in the entry header
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

//* Customize some of the entry meta pre text
add_filter( 'genesis_post_meta', 'new_entry_meta_footer' );
function new_entry_meta_footer( $post_meta ) {
	$post_meta = '[post_categories before="Read other Articles on: "] [post_tags before="Tagged with: "]';
	return $post_meta;
}

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Add support for additional color styles
add_theme_support( 'genesis-style-selector', array(
	'parallax-pro-green'  => __( 'Parallax Pro Green', 'parallax' ),
) );

//* Unregister secondary sidebar
unregister_sidebar( 'sidebar-alt' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 310,
	'height'          => 85,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer',
) );

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'parallax_author_box_gravatar' );
function parallax_author_box_gravatar( $size ) {

	return 176;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'parallax_comments_gravatar' );
function parallax_comments_gravatar( $args ) {

	$args['avatar_size'] = 120;

	return $args;

}

//* Enable featured images on PAGES
/*
add_action( 'genesis_entry_header', 'single_post_featured_image', 5 );

function single_post_featured_image() {

	if ( ! is_singular( 'page' ) )
		return;

	$img = genesis_get_image( array( 'format' => 'html', 'size' => 'large', 'attr' => array( 'class' => 'post-image' ) ) );
	printf( '<a href="%s" title="%s">%s</a>', get_permalink(), the_title_attribute( 'echo=0' ), $img );

}
*/


//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 1 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-section-1',
	'name'        => __( 'Home Section 1', 'parallax' ),
	'description' => __( 'This is the home section 1 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-2',
	'name'        => __( 'Home Section 2', 'parallax' ),
	'description' => __( 'This is the home section 2 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-3',
	'name'        => __( 'Home Section 3', 'parallax' ),
	'description' => __( 'This is the home section 3 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-4',
	'name'        => __( 'Home Section 4', 'parallax' ),
	'description' => __( 'This is the home section 4 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-5',
	'name'        => __( 'Home Section 5', 'parallax' ),
	'description' => __( 'This is the home section 5 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-6',
	'name'        => __( 'Home Section 6', 'parallax' ),
	'description' => __( 'This is the home section 6 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-7',
	'name'        => __( 'Home Section 7', 'parallax' ),
	'description' => __( 'This is the home section 7 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-8',
	'name'        => __( 'Home Section 8', 'parallax' ),
	'description' => __( 'This is the home section 8 section.', 'parallax' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-9',
	'name'        => __( 'Home Section 9', 'parallax' ),
	'description' => __( 'This is the home section 9 section.', 'parallax' ),
) );


add_action( 'transition_post_status', 'child_maybe_notify_facebook_scraper', 0, 3 );

function child_maybe_notify_facebook_scraper($new_status, $old_status, $post)
{
    // No need to notify Facebook if this post hasn't been published.
    if ($new_status !== 'publish') {
        return;
    }

    $url = get_permalink($post);

    // Post went from "future" to "publish".  Time to immediately tell
    // Facebook to rescrape this post.
    if ('future' === $old_status) {
        child_facebook_rescrape_url($url);
    }
}

function child_facebook_rescrape_url($url)
{
    $endpoint = sprintf(
        'https://graph.facebook.com/?%s',
        http_build_query(array('scrape' => true, 'id' => $url))
    );

    $response = wp_remote_post($endpoint, array());

    // @TODO: There should really be some error handling here.  Maybe
    // even some notifications for when this is triggered?
}
