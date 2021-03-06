<?php

// Customer Header & Logo
function acetheme_custom_header_setup() {
    add_theme_support( 'custom-header', apply_filters( 'acetheme_custom_header_args', array(
        'default-image' => '',
        'header-text' => true,
        'default-text-color' => '000',
        'width' => 200,
        'height' => 90,
        'flex-width' => true,
        'flex-height' => true,
        'wp-head-callback' => false,
    ) ) );
    add_theme_support( 'custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
        'header-text' => array( 'site-title', 'site-description' ),
    ) );    
}
add_action( 'after_setup_theme', 'acetheme_custom_header_setup' );

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    if ( ! file_exists( get_template_directory() . '/lib/bootstrap-navwalker.php' ) ) {
        return new WP_Error( 'bootstrap-navwalker-missing', __( 'It appears the bootstrap-navwalker.php file may be missing.', 'bootstrap-navwalker' ) );
    } else {
        require_once get_template_directory() . '/lib/bootstrap-navwalker.php';
    }    
}
add_action( 'after_setup_theme', 'register_navwalker' );

// for <title> load from Wordpress
add_theme_support( 'title-tag' );

// Enqueue scripts and styles.
function acetheme_scripts() {
    $query_args = array( 'family' => 'Open+Sans:400,600,700,800' );
    // wp_register_style('OpenSans', 'http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800');
    // wp_enqueue_style( 'OpenSans');
    wp_enqueue_style( 'google-fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ) );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/scripts/bootstrap/css/bootstrap.min.css', array(), '3.3.7' );
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/scripts/bootstrap/css/bootstrap-theme.min.css', array(), '3.3.7' );
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/scripts/bootstrap/js/bootstrap.min.js', array("jquery"), '3.3.7', true );
    wp_enqueue_script( 'jq', get_template_directory_uri() . '/scripts/jquery/jquery.min.js', array(), '2.2.4', true );
    wp_enqueue_script( 'jq', get_template_directory_uri() . '/scripts/jquery/jquery-migrate.js', array(), '1.4.1', true );
    wp_enqueue_script( 'jq', get_template_directory_uri() . '/scripts/jquery/jquery/jquery-noconflict.js', array(), '', true );
    wp_enqueue_script( 'scrollify', get_template_directory_uri() . '/scripts/jquery/jquery.scrollify.js', array(), '1.0.20', true );
    // Custom styles & script for this template
    wp_enqueue_script( 'theme-js', get_template_directory_uri() . '/scripts/theme.js', array(), '', true );
    wp_enqueue_style( 'acetheme-base', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'acetheme-theme', get_template_directory_uri() . '/css/theme.css' );
}
add_action( 'wp_enqueue_scripts', 'acetheme_scripts' );

// Custom Settings for Social Media
function custom_settings_add_menu() {
    add_menu_page( 
        'Custom Settings', // Title of the page 
        'Custom Settings', // Text to show on the menu link 
        'manage_options', // Capability requirement to see the link 
        'custom-settings', // The 'slug' - file to display when clicking the link 
        'custom_settings_page', null, 99 );
}
add_action( 'admin_menu', 'custom_settings_add_menu' );

// Create Custom Global Settings
function custom_settings_page() { ?>
	<div class="wrap">
		<h1>Custom Settings</h1>
		<form method="post" action="options.php">
            <?php
                settings_fields( 'section' );
                do_settings_sections( 'theme-options' );
                submit_button();
            ?>
		</form>
	</div>
<?php }

function setting_facebook_url() { ?>
    <input type="text" name="facebook" id="facebook" value="<?php echo get_option('facebook'); ?>" />
<?php }

function setting_twitter_url() { ?>
	<input type="text" name="twitter" id="twitter" value="<?php echo get_option( 'twitter' ); ?>" />
<?php }

function setting_linkedin_url() { ?>
	<input type="text" name="linkedin" id="linkedin" value="<?php echo get_option( 'linkedin' ); ?>" />
<?php }

function custom_settings_page_setup() {
	add_settings_section( 'section', 'All Settings', null, 'theme-options' );
    add_settings_field( 'twitter', 'Twitter URL', 'setting_twitter_url', 'theme-options', 'section' );
    add_settings_field( 'facebook', 'Facebook URL', 'setting_facebook_url', 'theme-options', 'section' );
    add_settings_field( 'linkedin', 'Linkedin URL', 'setting_linkedin_url', 'theme-options', 'section' );
    register_setting('section', 'twitter');
    register_setting( 'section', 'facebook' );
    register_setting( 'section', 'linkedin' );
}
add_action( 'admin_init', 'custom_settings_page_setup' );

//Remove Widget title
function remove_widget_title( $widget_title ) {
    return $widget_title == '&nbsp;' ? '' : $widget_title;
}
add_filter( 'widget_title', 'remove_widget_title' );

// Register a new sidebar for Header Widget
function add_headerbar_widget() {
    register_sidebar(
      array(
        'name'          => __( 'Header Content', 'acetheme' ),
        'description'   => __( 'Widget for Header Content', 'acetheme' ),
        'id'            => 'headerbar-widget',
        'before_widget' => '<div class="ace_custom_header_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<span>',
        'after_title'   => '</span>',
      )
    );
}

// Hook the widget initiation and run our function
add_action( 'widgets_init', 'add_headerbar_widget' );

// register sidebar widgets
function acetheme_widgets_init() {
	
	// Sidebar widget area, located in the sidebar. Empty by default.
	register_sidebar( array(
		'name' => 'Sidebar Widget Area',
		'id' => 'sidebar-widget-area',
		'description' => 'The sidebar widget area',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// First footer widget area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'compass' ),
		'id' => 'first-footer-widget-area',
		'description' => __( 'The first footer widget area', 'compass' ),
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Second Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => 'Second Footer Widget Area',
		'id' => 'second-footer-widget-area',
		'description' => 'The second footer widget area',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Third Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => 'Third Footer Widget Area',
		'id' => 'third-footer-widget-area',
		'description' => 'The third footer widget area',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	// Fourth Footer Widget Area, located in the footer. Empty by default.
	register_sidebar( array(
		'name' => 'Fourth Footer Widget Area',
		'id' => 'fourth-footer-widget-area',
		'description' => 'The fourth footer widget area',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'widgets_init', 'acetheme_widgets_init' );

// Register a new Navigation menu
function add_theme_menu_navigation() {
    register_nav_menu( 'side-menu', __( 'Side Menu', 'acetheme' ) );
    register_nav_menu( 'header-menu', __( 'Header Menu', 'acetheme' ) );
    register_nav_menu( 'main-menu', __( 'Main Menu', 'acetheme' ) );
}

// Hook to the init action hook, run our function
add_action( 'init', 'add_theme_menu_navigation' );

function hide_admin_bar() { return false; }
add_filter( 'show_admin_bar', 'hide_admin_bar' );

function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );