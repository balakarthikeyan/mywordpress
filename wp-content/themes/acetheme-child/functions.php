<?php
//Add child theme scripts
function acetheme_theme_scripts() {
	$parent_style = 'acetheme-base';
	// wp_enqueue_style( 'acetheme-child', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'acetheme-child', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'acetheme_theme_scripts' );

//Short thumbnail for vehicle
add_image_size( 'vehicle-thumb', 250, 150, true );

//Register custom query vars
function custom_register_query_vars( $vars ) {
    $vars[] = 'vno';
    $vars[] = 'vowner';
    return $vars;
} 
add_filter( 'query_vars', 'custom_register_query_vars' );

//Custom search filter
function custom_search_filter($query) {
	if ($query->is_search && !is_admin() ) {
		if ( !is_post_type_archive( 'vehicle' ) ){
			return;
		}

		$post_type = get_query_var('post_type');   
		if( $wp_query->is_search && $post_type == 'vehicle' ) {
			// add meta_query elements
			if( !empty( get_query_var( 'vno' ) ) ){
				$meta_query[] = array( 'key' => 'vehicle_number', 'value' => get_query_var( 'vno' ), 'compare' => 'LIKE' );
			}

			if( !empty( get_query_var( 'vowner' ) ) ){
				$meta_query[] = array( 'key' => 'vehicle_owner_name', 'value' => get_query_var( 'vowner' ), 'compare' => 'LIKE' );
			}
		
			if( count( $meta_query ) > 1 ){
				$meta_query['relation'] = 'AND';
			}

			if( count( $meta_query ) > 0 ){
				$query->set( 'meta_query', $meta_query );
			}

			$query->set('post_type', array($post_type));
		}     
	}
	return $query;
}
add_filter('pre_get_posts','custom_search_filter');

//Custom search template
function custom_search_template($template)   {    
	global $wp_query;   
	$post_type = get_query_var('post_type');   
	if( $wp_query->is_search && $post_type == 'vehicle' ) {
		//Note: you need to use full file name, in this case content.php and also false arguments to avoid loading the file and return the full path instead locate_template($template_names, $load = false, $require_once = true )
		return locate_template('search.php'); 
	}   
	return $template;   
}
add_filter('template_include', 'custom_search_template');

function custom_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function custom_excerpt_more($more) {
	global $post;
	return '<a class="more-link" href="'. get_permalink($post->ID) . '"> Read the full article...</a>';
}
add_filter('excerpt_more', 'custom_excerpt_more');

function custom_search_setup() {
    add_shortcode( 'vehiclesearchform', 'vehicle_search_form' );
}
add_action( 'init', 'custom_search_setup' );

function vehicle_search_form( $args ){
	$args = array( 'hide_empty' => false );
	$vehicle_terms = get_terms( 'vehicle_category', $args );
	$output = $select_vehicle  = '';
	if( is_array( $vehicle_terms ) ){
		$select_vehicle = '<select name="vehicle" style="width: 100%">';
		$select_vehicle .= '<option value="" selected="selected">' . __( 'Select vehicle', 'acetheme' ) . '</option>';
		foreach ( $vehicle_terms as $term ) {
			$select_vehicle .= '<option value="' . $term->slug . '">' . $term->name . '</option>';
		}
		$select_vehicle .= '</select>' . "\n";
	}
	$output .= '<div>' . esc_html( $select_vehicle ) . '</div>';
	ob_start();
	echo $output;
	return ob_get_clean();
}

add_action('wp_ajax_ajax-vehicles', 'vehicle_ajax_function');
add_action('wp_ajax_nopriv_ajax-vehicles', 'vehicle_ajax_function');
 
function vehicle_ajax_function(){
	$args = array(
		'orderby' => $_POST['filterBy'], 
		'order'	=> $_POST['orderBy'],
		'post_type' => array('vehicle'), 
	);
 
	if( isset( $_POST['category'] ) ) {		
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'vehicle_category',
				'field' => 'id',
				'terms' => $_POST['category']
			)
		);
	}

	if( isset( $_POST['price_min'] ) && $_POST['price_min'] || isset( $_POST['price_max'] ) && $_POST['price_max'] || isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' ) {
		$args['meta_query'] = array( 'relation'=>'AND' );
	}
	
	// if both minimum price and maximum price are specified we will use BETWEEN comparison
	if( isset( $_POST['price_min'] ) && $_POST['price_min'] && isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
		$args['meta_query'][] = array(
			'key' => 'vehicle_price',
			'value' => array( $_POST['price_min'], $_POST['price_max'] ),
			'type' => 'numeric',
			'compare' => 'between'
		);
	} else {
		// if only min price is set
		if( isset( $_POST['price_min'] ) && $_POST['price_min'] ) {
			$args['meta_query'][] = array(
				'key' => 'vehicle_price',
				'value' => $_POST['price_min'],
				'type' => 'numeric',
				'compare' => '>'
			);
		}
		// if only max price is set
		if( isset( $_POST['price_max'] ) && $_POST['price_max'] ) {
			$args['meta_query'][] = array(
				'key' => 'vehicle_price',
				'value' => $_POST['price_max'],
				'type' => 'numeric',
				'compare' => '<'
			);
		}
	}
 
	// if post thumbnail is set
	if( isset( $_POST['featured_image'] ) && $_POST['featured_image'] == 'on' ) {
		$args['meta_query'][] = array(
			'key' => '_thumbnail_id',
			'compare' => 'EXISTS'
		);
	}
	//echo "<pre>"; print_r( $args ); echo "</pre>"; 
	$query = new WP_Query( $args );
	//echo "<pre>"; print_r( $query); echo "</pre>";
 
	if( $query->have_posts() ) :
		echo "From Ajax";
		while( $query->have_posts() ): $query->the_post();
			echo '<strong>' . $query->post->post_title . '</strong>';
		endwhile;
		wp_reset_postdata();
	else :
		echo 'No posts found';
	endif;
 
	die();
}