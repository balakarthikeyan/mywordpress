=== Simple Widget Plugin ===
Contributors: Balakarthikeyan
Donate link: [link]
Tags: Simple Plugin, WordPress Plugin
Requires at least: 4.5
Tested up to: 5.0
Stable tag: 3.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
Create your first plugin. Simple Plugin is the simplest WordPress plugin for beginner. 
 
== Description ==
 
Simple Plugin is the simplest WordPress plugin for beginner were widget that displays authors name.
 
== Installation ==
1. Unpack the `download-package`.
2. Upload the file to the `/wp-content/plugins/` directory.
3. Activate the plugin through the `Plugins` menu in WordPress.
4. Done and Ready.
 
== Frequently Asked Questions ==
 
= How to add FAQ question =
* just add your FAQ questions here
 
== Screenshots ==
1. This is a text label for your first screenshot
2. Add more screenshot labels as new line
 
== Changelog ==
 
= 3.0 =
* Initial release


function tutsplus_register_post_type() {
     
    // movies
    $labels = array( 
        'name' => __( 'Movies' , 'tutsplus' ),
        'singular_name' => __( 'Movie' , 'tutsplus' ),
        'add_new' => __( 'New Movie' , 'tutsplus' ),
        'add_new_item' => __( 'Add New Movie' , 'tutsplus' ),
        'edit_item' => __( 'Edit Movie' , 'tutsplus' ),
        'new_item' => __( 'New Movie' , 'tutsplus' ),
        'view_item' => __( 'View Movie' , 'tutsplus' ),
        'search_items' => __( 'Search Movies' , 'tutsplus' ),
        'not_found' =>  __( 'No Movies Found' , 'tutsplus' ),
        'not_found_in_trash' => __( 'No Movies found in Trash' , 'tutsplus' ),
    );
    $args = array(
        'labels' => $labels,
        'has_archive' => true,
        'public' => true,
        'hierarchical' => false,
        'supports' => array(
            'title', 
            'editor', 
            'excerpt', 
            'custom-fields', 
            'thumbnail',
            'page-attributes'
        ),
        'rewrite'   => array( 'slug' => 'movies' ),
        'show_in_rest' => true
 
    );
    register_post_type( 'tutsplus_movie', $args );     
}

add_action( 'init', 'tutsplus_register_post_type' );

function tutsplus_register_taxonomy() {    
     
    // books
    $labels = array(
        'name' => __( 'Genres' , 'tutsplus' ),
        'singular_name' => __( 'Genre', 'tutsplus' ),
        'search_items' => __( 'Search Genres' , 'tutsplus' ),
        'all_items' => __( 'All Genres' , 'tutsplus' ),
        'edit_item' => __( 'Edit Genre' , 'tutsplus' ),
        'update_item' => __( 'Update Genres' , 'tutsplus' ),
        'add_new_item' => __( 'Add New Genre' , 'tutsplus' ),
        'new_item_name' => __( 'New Genre Name' , 'tutsplus' ),
        'menu_name' => __( 'Genres' , 'tutsplus' ),
    );
     
    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'sort' => true,
        'args' => array( 'orderby' => 'term_order' ),
        'rewrite' => array( 'slug' => 'genres' ),
        'show_admin_column' => true,
        'show_in_rest' => true
 
    );
     
    register_taxonomy( 'tutsplus_genre', array( 'tutsplus_movie' ), $args);
     
}
add_action( 'init', 'tutsplus_register_taxonomy' );


<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://pro.crunchify.com/wp-content/themes/twentysixteen/js/typed.min.js" type="text/javascript"></script>
 
<script>
  $(function(){
      $(".element").typed({
        strings: ["App Shah...", " an Engineer (MS)...","a WordPress Lover...", "a Java Developer..."],
        typeSpeed:100,
        backDelay:3000,
        loop:true
      });
  });
</script>


I'm <span class="element"></span><span class="typed-cursor"></span>

What are Hooks?
WordPress Plugins interact with core code using hooks. There are two different types of hooks.

Action hooks (To add/remove functions)
Filter hooks (To modify data that is produced by functions)

To add a function to any action hook, your plugin must call the WordPress function named add_action(), with at least two parameters.
To remove an action from an action hook, you must write a new function that calls remove_action(), then call the function you have written using add_action().


A filter function allows you to modify the resulting data that is returned by existing functions and must be hooked to one of the filter hooks. 

To add a filter function to any filter hook, your plugin must call the WordPress function named add_filter(), with at least two parameters.

// Creating a Deals Custom Post Type
function crunchify_deals_custom_post_type() {
	$labels = array(
		'name'                => __( 'Deals' ),
		'singular_name'       => __( 'Deal'),
		'menu_name'           => __( 'Deals'),
		'parent_item_colon'   => __( 'Parent Deal'),
		'all_items'           => __( 'All Deals'),
		'view_item'           => __( 'View Deal'),
		'add_new_item'        => __( 'Add New Deal'),
		'add_new'             => __( 'Add New'),
		'edit_item'           => __( 'Edit Deal'),
		'update_item'         => __( 'Update Deal'),
		'search_items'        => __( 'Search Deal'),
		'not_found'           => __( 'Not Found'),
		'not_found_in_trash'  => __( 'Not found in Trash')
	);
	$args = array(
		'label'               => __( 'deals'),
		'description'         => __( 'Best Crunchify Deals'),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'revisions', 'custom-fields'),
		'public'              => true,
		'hierarchical'        => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'has_archive'         => true,
		'can_export'          => true,
		'exclude_from_search' => false,
	        'yarpp_support'       => true,
		'taxonomies' 	      => array('post_tag'),
		'publicly_queryable'  => true,
		'capability_type'     => 'page'
);
	register_post_type( 'deals', $args );
}
add_action( 'init', 'crunchify_deals_custom_post_type', 0 );


// Let us create Taxonomy for Custom Post Type
add_action( 'init', 'crunchify_create_deals_custom_taxonomy', 0 );
 
//create a custom taxonomy name it "type" for your posts
function crunchify_create_deals_custom_taxonomy() {
 
  $labels = array(
    'name' => _x( 'Types', 'taxonomy general name' ),
    'singular_name' => _x( 'Type', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Types' ),
    'all_items' => __( 'All Types' ),
    'parent_item' => __( 'Parent Type' ),
    'parent_item_colon' => __( 'Parent Type:' ),
    'edit_item' => __( 'Edit Type' ), 
    'update_item' => __( 'Update Type' ),
    'add_new_item' => __( 'Add New Type' ),
    'new_item_name' => __( 'New Type Name' ),
    'menu_name' => __( 'Types' ),
  ); 	
 
  register_taxonomy('types',array('deals'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'type' ),
  ));
}

// ================================= Create Attraction Custom Post Type =================================
function crunchify_create_the_attaction_posttype() {
	$labels = array(
		'name'                => _x( 'Attraction', 'Post Type General Name', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'singular_name'       => _x( 'Attraction', 'Post Type Singular Name', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'menu_name'           => esc_html__( 'Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'parent_item_colon'   => esc_html__( 'Parent Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'all_items'           => esc_html__( 'All Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'view_item'           => esc_html__( 'View Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'add_new_item'        => esc_html__( 'Add New Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'add_new'             => esc_html__( 'Add New', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'edit_item'           => esc_html__( 'Edit Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'update_item'         => esc_html__( 'Update Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'search_items'        => esc_html__( 'Search Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'not_found'           => esc_html__( 'Not Found', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'not_found_in_trash'  => esc_html__( 'Not found in Trash', 'CRUNCHIFY_TEXT_DOMAIN' ),
	);	
	$args = array(
		'label'               => esc_html__( 'attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'description'         => esc_html__( 'Attraction', 'CRUNCHIFY_TEXT_DOMAIN' ),
		'labels'              => $labels,
		'supports'            => array( 'title','editor','thumbnail'),
		'taxonomies'          => array( 'genres' ),
	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 100,
		'can_export'          => true,
		'has_archive'         => __( 'attraction' ),
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var' 		  => true,
		'show_admin_column'   => true,
		'capability_type'     => 'post',
        'rewrite' => array('slug' => 'attraction/%tourist%'),
	);
	register_post_type( 'attraction', $args );
}
add_action( 'init', 'crunchify_create_the_attaction_posttype', 0 );

// ================================= Custom Post Type Taxonomies =================================
function crunchify_create_the_attaction_taxonomy() {  
    register_taxonomy(  
        'tourist',  					// This is a name of the taxonomy. Make sure it's not a capital letter and no space in between
        'attraction',        			//post type name
        array(  
            'hierarchical' => true,  
            'label' => 'Attractions',  	//Display name
            'query_var' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'attraction')
        )  
    );  
}  
add_action( 'init', 'crunchify_create_the_attaction_taxonomy');

function crunchify_create_post_link( $post_link, $id = 0 ){
    $post = get_post($id);  
    if ( is_object( $post ) ){
        $terms = wp_get_object_terms( $post->ID, 'tourist' );
        if( $terms ){
            return str_replace( '%tourist%' , $terms[0]->slug , $post_link );
        }
    }
    return $post_link;  
}
add_filter( 'post_type_link', 'crunchify_create_post_link', 1, 3 );