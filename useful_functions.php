<?php
function custom_polylang_languages( $class = '' ) {

    if ( ! function_exists( 'pll_the_languages' ) ) return;
  
    // Gets the pll_the_languages() raw code
    $languages = pll_the_languages( array(
      'hide_if_no_translation' => 1,
      'raw'                    => true
    ) ); 
  
    $output = '';
  
    // Checks if the $languages is not empty
    if ( ! empty( $languages ) ) {
  
        // Creates the $output variable with languages container
        $current_language = '';
        $dropdown = '<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">';

        // Runs the loop through all languages
        foreach ( $languages as $language ) {

            // Variables containing language data
            $id             = $language['id'];
            $name           = $language['name'];
            $url            = $language['url'];
            $current        = $language['current_lang'] ? 'current' : '';
            $no_translation = $language['no_translation'];

            // Checks if the page has translation in this language
            if ( ! $no_translation ) {
                // Check if it's current language
                $dropdown .= "<li><a href=\"$url\" class=\"dropdown-item $current\">$name</a>";
            }
            //Current language
            if($language['current_lang']) {
                $current_language = $name;
            }

        }
        $dropdown .= '</ul>';

        $output  = '<div class="languages' . ( $class ? ' ' . $class : '' ) . '">';
        $output .= '<button class="btn btn-default dropdown-toggle shadow-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    <span>'.$current_language.'</span>
                    </button>';
        $output .= $dropdown.'</div>';
  
    }
  
    return $output;
}

function switcher_shortcode($atts) {
    // Make sure pll_the_languages() is defined
    if (function_exists('pll_the_languages')) {
        // Extract attributes
        extract(shortcode_atts(array('dropdown' => false, 'show_flags' => true, 'show_names' => false, 'classes' => '', 'hide_if_empty' => true, 'force_home' => false, 'hide_if_no_translation' => false, 'hide_current' => false, 'post_id' => null, 'raw' => false), $atts));
        // Args
        $dropdown = 'true' == $dropdown ? true : false;
        $show_flags = 'true' == $show_flags ? true : false;
        $show_names = 'true' == $show_names ? true : false;
        // Dropdown args
        if ($dropdown) {
            $show_flags = $show_names = false;
        }
        // Classes
        $classes = 'polylang-switcher-shortcode clr';
        if ($show_names && !$dropdown) {
            $classes .= ' flags-and-names';
        }
        // Display Switcher
        if (!$dropdown) {
            echo '<ul class="' . $classes . '">';
        }
        // Display the switcher
        pll_the_languages(array('dropdown' => $dropdown, 'show_flags' => $show_flags, 'show_names' => $show_names, 'hide_if_empty' => $hide_if_empty, 'force_home' => $force_home, 'hide_if_no_translation' => $hide_if_no_translation, 'hide_current' => $hide_current, 'post_id' => $post_id, 'raw' => $raw));
        if (!$dropdown) {
            echo '</ul>';
        }
    }
}
add_shortcode( 'polylang_switcher', 'switcher_shortcode' );

// Register a new Navigation menu
function add_theme_menu_navigation() {
    register_nav_menu( 'side-menu', __( 'Side Menu', 'forsan' ) );
    register_nav_menu( 'header-menu', __( 'Header Menu', 'forsan' ) );
    register_nav_menu( 'footer-menu', __( 'Footer Menu', 'forsan' ) );
    register_nav_menu( 'main-menu', __( 'Main Menu', 'forsan' ) );
}

// Hook to the init action hook, run our function
add_action( 'init', 'add_theme_menu_navigation' );

// for <title> load from Wordpress
add_theme_support( 'title-tag' );

function hide_admin_bar() { return false; }
add_filter( 'show_admin_bar', 'hide_admin_bar' );

function remove_wp_logo( $wp_admin_bar ) {
    $wp_admin_bar->remove_node( 'wp-logo' );
}
add_action( 'admin_bar_menu', 'remove_wp_logo', 999 );

/**
 * Register Custom Navigation Walker
 */
function register_navwalker(){
    if ( ! file_exists( get_template_directory() . '/includes/bootstrap-navwalker.php' ) ) {
        return new WP_Error( 'bootstrap-navwalker-missing', __( 'It appears the bootstrap-navwalker.php file may be missing.', 'bootstrap-navwalker' ) );
    } else {
        require_once get_template_directory() . '/includes/bootstrap-navwalker.php';
    }    
}
add_action( 'after_setup_theme', 'register_navwalker' );

function get_breadcrumb() {
    $content = '<li class="breadcrumb-item"><a href="'.home_url().'" rel="nofollow">Home</a></li>';
    $separator = '<span class="separator"> &nbsp;&nbsp;&#187;&nbsp;&nbsp; </span>';
    if (is_category() || is_single()) {
        // $content .=  $separator;
        $content .=  get_the_category(' &bull; ');
        if (is_single()) {
            // $content .=  "  ";
            $content .=  '<li class="breadcrumb-item active" aria-current="page">'.get_the_title().'</li>';
        }
    } elseif (is_page()) {
        // $content .=  $separator;
        $content .=  '<li class="breadcrumb-item active" aria-current="page">'.get_the_title().'</li>';
    } elseif (is_search()) {
        // $content .=  $separator;
        $content .=  '<li class="breadcrumb-item active" aria-current="page">'.the_search_query().'</li>';
    }
    return $content;
}

add_filter( 'autoptimize_filter_imgopt_normalized_url', 'fix_quot' );
function fix_quot( $url_in ) {
    return str_replace( '&quot;', '', $url_in );
}
