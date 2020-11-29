<?php
/**
 * @package Vehicle Configuration
 * @author Balakarthikeyan
 * @license GPL-2.0+
 * @link https://www.github.com/balakarthikeyan/wp-plugins
 * @copyright 2020. All rights reserved.
 * Plugin Name: Vehicle Configuration
 * Plugin URI: https://www.github.com/balakarthikeyan/wp-plugins
 * Description: Vehicle Plugin is the simplest WordPress plugin for Custom post.
 * Version: 1.0.0
 * Author: Balakarthikeyan
 * Author URI: https://www.github.com/balakarthikeyan
 * Text Domain: vehicle-plugin
 * Contributors: 
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */
 
/**
 * Adding Submenu under Settings Tab
 *
 * @since 1.0
 */
function vehicle_plugin_add_menu() {
	add_submenu_page ( "options-general.php", "Vehicle Configuration", "Vehicle Configuration", "manage_options", "vehicle-plugin", "vehicle_plugin_page" );
}
add_action ( "admin_menu", "vehicle_plugin_add_menu" );

/**
 * Setting Page Options
 * - add setting page
 * - save setting page
 *
 * @since 1.0
 */
function vehicle_plugin_page() {
?>
<div class="wrap">
	<h1> Vehicle Configuration </h1>
	<form method="post" action="options.php">
		<?php
		settings_fields ( "vehicle_plugin_config" );
		do_settings_sections ( "vehicle_plugin" );
		submit_button ();
		?>
    </form>
</div>
<?php
}
 
/**
 * Init setting section, Init setting field and register settings page
 *
 * @since 1.0
 */
function vehicle_plugin_settings() {
	add_settings_section ( "vehicle_plugin_config", "", null, "vehicle_plugin" );
	add_settings_field ( "vehicle-post-perpage", "No of Pages", "vehicle_plugin_options", "vehicle_plugin", "vehicle_plugin_config" );
	register_setting ( "vehicle_plugin_config", "vehicle-post-perpage" );
}
add_action ( "admin_init", "vehicle_plugin_settings" );
 
/**
 * Add simple textfield value to setting page
 *
 * @since 1.0
 */
function vehicle_plugin_options() {
?>
<div class="postbox">
	<input type="text" name="vehicle-post-perpage" value="<?php echo stripslashes_deep ( esc_attr ( get_option ( 'vehicle-post-perpage' ) ) );?>" /><br />
</div>
<?php
}
 
/**
 * Append saved textfield value to each post
 *
 * @since 1.0
 */
function vehicle_plugin_content($content) {
	return $content;
}
// add_filter ( 'the_content', 'vehicle_plugin_content' );

//Custom post type of vehicle
function my_custom_post_vehicle() {
	$labels = array(
	  'name'               => _x( 'Vehicles', 'Post type general name', 'acetheme' ),
	  'singular_name'      => _x( 'Vehicle', 'Post type singular name', 'acetheme' ),
	  'menu_name'          => __( 'Vehicles', 'acetheme' ),
	  'name_admin_bar'     => __( 'Vehicles', 'acetheme' ),
	  'archives'           => __( 'Vehicles Archives', 'acetheme' ),
	  'attributes'         => __( 'Vehicles Attributes', 'acetheme' ),	  
	  'add_new'            => __( 'Add New', 'acetheme' ),
	  'add_new_item'       => __( 'Add New Vehicle', 'acetheme' ),
	  'edit_item'          => __( 'Edit Vehicle', 'acetheme' ),
	  'new_item'           => __( 'New Vehicle', 'acetheme' ),
	  'all_items'          => __( 'All Vehicles', 'acetheme' ),
	  'view_item'          => __( 'View Vehicle', 'acetheme' ),
	  'search_items'       => __( 'Search Vehicles', 'acetheme' ),
	  'not_found'          => __( 'No vehicles found', 'acetheme' ),
	  'not_found_in_trash' => __( 'No vehicles found in the Trash', 'acetheme' ), 
	  'parent_item_colon'  => __( 'Parent Vehicle', 'acetheme' ),
	  'featured_image'        => __( 'Featured Image', 'acetheme' ),
	  'set_featured_image'    => __( 'Set featured image', 'acetheme' ),
	  'remove_featured_image' => __( 'Remove featured image', 'acetheme' ),
	  'use_featured_image'    => __( 'Use as featured image', 'acetheme' ),
	  'insert_into_item'      => __( 'Insert into vehicle', 'acetheme' ),
	  'uploaded_to_this_item' => __( 'Uploaded to this vehicle', 'acetheme' ),
	  'items_list'            => __( 'Vehicles list', 'acetheme' ),
	  'items_list_navigation' => __( 'Vehicles list navigation', 'acetheme' ),
	  'filter_items_list'     => __( 'Filter vehicles list', 'acetheme' ),	  
	);

	$args = array(
	  'label'         => __( 'Vehicles', 'acetheme' ),
	  'description'   => __( 'Holds our vehicles and vehicle specific data', 'acetheme' ),
	  'labels'        => $labels,
	  'supports'      => array( 'title', 'editor', 'thumbnail', 'author', 'excerpt', 'comments', 'revisions', 'custom-fields', 'page-attributes', ), 
	  'hierarchical'        => false, //it means we cannot have parent and sub pages
	  'public'              => true,
	  'show_ui'             => true,
	  'show_in_menu'        => true,
	  'show_in_nav_menus'   => true,
	  'show_in_admin_bar'   => true,
	  'menu_position'       => 5,
	//   'menu_icon'           => 'img/admin/theme-icon.png',
	  'can_export'          => true,
	  'has_archive'         => true,
	  'exclude_from_search' => true,
	  'publicly_queryable'  => true,
	  'capability_type'     => 'post', //will act like a normal post
	  'show_in_rest'        => true,
	  'rewrite'   			=> array( 'slug' => 'vehicle' ), //this is used for rewriting the permalinks
	  'taxonomies'          => array( 'vehicle_category' ),
	);
	register_post_type( 'vehicle', $args );
}
add_action( 'init', 'my_custom_post_vehicle' );
add_theme_support( 'post-thumbnails');

//Custom interaction messages
function my_updated_messages( $messages ) {
	global $post, $post_ID;
	$messages['vehicle'] = array(
	  0 => "", // Unused. Messages start at index 1.
	  1 => sprintf( __('Vehicle updated. <a href="%s">View vehicle</a>'), esc_url( get_permalink($post_ID) ) ),
	  2 => __('Custom field updated.'),
	  3 => __('Custom field deleted.'),
	  4 => __('Vehicle updated.'),
	  5 => isset($_GET['revision']) ? sprintf( __('Vehicle restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
	  6 => sprintf( __('Vehicle published. <a href="%s">View vehicle</a>'), esc_url( get_permalink($post_ID) ) ),
	  7 => __('Vehicle saved.'),
	  8 => sprintf( __('Vehicle submitted. <a target="_blank" href="%s">Preview vehicle</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  9 => sprintf( __('Vehicle scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview vehicle</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
	  10 => sprintf( __('Vehicle draft updated. <a target="_blank" href="%s">Preview vehicle</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	);
	return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' ); 

function my_contextual_help( $contextual_help, $screen_id, $screen ) { 
	if ( 'vehicle' == $screen->id ) {  
		$contextual_help = '<h2>Vehicles</h2>
		<p>Vehicles show the details of the items that we sell on the website. You can see a list of them on this page in reverse chronological order - the latest one we added is first.</p> 
		<p>You can view/edit the details of each vehicle by clicking on its name, or you can perform bulk actions using the dropdown menu and selecting multiple items.</p>';
	} elseif ( 'edit-vehicle' == $screen->id ) {
		$contextual_help = '<h2>Editing Vehicles</h2>
		<p>This page allows you to view/modify vehicle details. Please make sure to fill out the available boxes with the appropriate details (owner name, price, image, description)</p>';
	}
	return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help', 10, 3 );

//Custom post type vehicle category
function my_taxonomies_vehicle() {
	$labels = array(
	  'name'              => _x( 'Vehicle Categories', 'taxonomy general name' ),
	  'singular_name'     => _x( 'Vehicle Category', 'taxonomy singular name' ),
	  'search_items'      => __( 'Search Vehicle Categories' ),
	  'all_items'         => __( 'All Vehicle Categories' ),
	  'parent_item'       => __( 'Parent Vehicle Category' ),
	  'parent_item_colon' => __( 'Parent Vehicle Category:' ),
	  'edit_item'         => __( 'Edit Vehicle Category' ), 
	  'update_item'       => __( 'Update Vehicle Category' ),
	  'add_new_item'      => __( 'Add New Vehicle Category' ),
	  'new_item_name'     => __( 'New Vehicle Category' ),
	  'menu_name'         => __( 'Vehicle Categories' ),
	);
	$args = array(
	  'labels' 				=> $labels,
	  'hierarchical' 		=> true,
	  'show_ui' 			=> true,
	  'show_admin_column' 	=> true,
	  'query_var' 			=> true,
	  'rewrite' 			=> array( 'slug' => 'vehicle' ),	  
	);
	register_taxonomy( 'vehicle_category', 'vehicle', $args );
}
add_action( 'init', 'my_taxonomies_vehicle', 0 );

//Add custom fields
function vehicle_meta_box() {
	add_meta_box( 
		'vehicle_meta_box', // $id
		__( 'Vehicle Details', 'acetheme' ), // $title
		'vehicle__meta_box_callback', // $callback
		'vehicle', // $screen
		'side', // $context
		'high' // $priority
	);
}
add_action( 'add_meta_boxes', 'vehicle_meta_box' );

//Metabox fields
function vehicle__meta_box_callback( $post ) {
	wp_nonce_field( 'vehicle_meta_box_nonce', 'vehicle_meta_box_nonce' );

	$vehicle_number = get_post_meta( $post->ID, 'vehicle_number', true );
	$vehicle_owner_name = get_post_meta( $post->ID, 'vehicle_owner_name', true );
	$vehicle_price = get_post_meta( $post->ID, 'vehicle_price', true );

	$vehicle_notes = get_post_meta( $post->ID, 'vehicle_notes', true );
	$vehicle_used = get_post_meta( $post->ID, 'vehicle_used', true );
	$vehicle_year = get_post_meta( $post->ID, 'vehicle_year', true );
	$vehicle_image = get_post_meta( $post->ID, 'vehicle_image', true );

?>
	<p>
    	<label for="vehicle_number">Vehicle Number :</label>
    	<br>
    	<input placeholder="Vehicle Number" name="vehicle_number" id="vehicle_number" type="text" value="<?php echo esc_attr( $vehicle_number ); ?>" />
    </p>
	<p>
    	<label for="vehicle_owner_name">Owner name :</label>
    	<br>
    	<input placeholder="Owner name" name="vehicle_owner_name" id="vehicle_owner_name" type="text" value="<?php echo esc_attr( $vehicle_owner_name ); ?>" />
    </p>
	<p>
    	<label for="vehicle_price">Price :</label>
    	<br>
    	<input placeholder="Price" name="vehicle_price" id="vehicle_price" type="text" value="<?php echo esc_attr( $vehicle_price ); ?>" />
    </p>		
	<p>
    	<label for="vehicle_notes">Additional Notes</label>
    	<br>
    	<textarea name="vehicle_notes" id="vehicle_notes" rows="5" cols="30"><?php echo esc_attr( $vehicle_notes ); ?></textarea>
    </p>
	<p>
    	<label for="vehicle_used">Used
    		<input type="checkbox" name="vehicle_used" value="yes" <?php if ( esc_attr( $vehicle_used ) === 'yes' ) echo 'checked'; ?>>
    	</label>
    </p>
	<p>
		<label for="vehicle_year">Year</label>
		<br>
		<select name="vehicle_year" id="vehicle_year">
			<?php 
			for($i = 2000; $i <= date('Y'); $i++){
				echo '<option value="'.$i.'" '. selected( esc_attr( $vehicle_year ), $i ) .'>'.$i.'</option>';
			}
			?>
		</select>
	</p>
	<p>
		<label for="vehicle_image">Image</label><br>
		<input type="text" name="vehicle_image" id="vehicle_image" class="meta-image" value="<?php echo esc_attr ($vehicle_image); ?>">
		<input type="button" class="button image-upload" value="Browse">
	</p>
	<div class="image-preview"><img src="<?php echo esc_attr ($vehicle_image); ?>" width="200"></div>
	<script>
		jQuery(document).ready(function ($) {
		// Instantiates the variable that holds the media library frame.
		var meta_image_frame
		// Runs when the image button is clicked.
		$('.image-upload').click(function (e) {
			// Get preview pane
			var meta_image_preview = $(this).parent().parent().children('.image-preview')
			// Prevents the default action from occuring.
			e.preventDefault()
			var meta_image = $(this).parent().children('.meta-image')
			// If the frame already exists, re-open it.
			if (meta_image_frame) {
				meta_image_frame.open()
				return;
			}
			// Sets up the media library frame
			meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
				title: meta_image.title,
				button: {
					text: meta_image.button,
				},
			})
			// Runs when an image is selected.
			meta_image_frame.on('select', function () {
				// Grabs the attachment selection and creates a JSON representation of the model.
				var media_attachment = meta_image_frame
					.state()
					.get('selection')
					.first()
					.toJSON()
				// Sends the attachment URL to our custom image input field.
				meta_image.val(media_attachment.url)
				meta_image_preview.children('img').attr('src', media_attachment.url).attr('width', 200)
			})
			// Opens the media library frame.
			meta_image_frame.open()
		})
		})
		</script>			
<?php	
}

//Post
function vehicle_price_box_save( $post_id ) {
	
	//For autosave
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
  
	// Check if our nonce is set.
	if ( ! isset( $_POST['vehicle_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['vehicle_meta_box_nonce'], 'vehicle_meta_box_nonce' ) ) {
		return;
	}
	
	//Permissions
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }
    } else {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

	//Sanitize fields and save 
	$vehicle_number = esc_attr(stripslashes_deep($_POST['vehicle_number']));
	$vehicle_owner_name = esc_attr(stripslashes_deep($_POST['vehicle_owner_name']));
	$vehicle_price = sanitize_text_field($_POST['vehicle_price']);
	$vehicle_notes = esc_attr(stripslashes_deep( $_POST['vehicle_notes']));
	$vehicle_used = sanitize_text_field( $_POST['vehicle_used'] );
	$vehicle_year = sanitize_text_field( $_POST['vehicle_year'] );
	$vehicle_image = sanitize_text_field( $_POST['vehicle_image'] );

	//Save data
	update_post_meta( $post_id, 'vehicle_number', $vehicle_number );
	update_post_meta( $post_id, 'vehicle_owner_name', $vehicle_owner_name );
	update_post_meta( $post_id, 'vehicle_price', $vehicle_price );
	update_post_meta( $post_id, 'vehicle_notes', $vehicle_notes );
	update_post_meta( $post_id, 'vehicle_used', $vehicle_used );
	update_post_meta( $post_id, 'vehicle_year', $vehicle_year );
	update_post_meta( $post_id, 'vehicle_image', $vehicle_image );
}
add_action( 'save_post', 'vehicle_price_box_save' );

add_filter( 'intermediate_image_sizes', 'custom_intermediate_image_sizes', 999 );
function custom_intermediate_image_sizes( $image_sizes ){
	if ( isset( $_REQUEST['post_id'] ) && 'vehicle' === get_post_type( $_REQUEST['post_id'] ) ) {
		return array();
	}
	return $image_sizes;
}

function edit_vehicle_columns( $columns ) {
	$columns = array(
		'cb' => '',
		'title' => __( 'Title' ),						
		'category' => __( 'Categories' ),
		'thumbnail' => __( 'Thumbnail' ),
		'author' => __( 'Author' ),
		'date' => __( 'Date' )
	);
	return $columns;
}
add_filter( 'manage_edit-vehicle_columns', 'edit_vehicle_columns' );

function manage_vehicle_columns( $column, $post_id ) {
	global $post;

	switch($column) {
		case 'category' :
			$terms = get_the_terms( $post_id, 'vehicle_category' );
			if ( !empty( $terms ) ) {
				$out = array();
				foreach ( $terms as $term ) {
					$out[] = sprintf( '<a target="_blank" href="%1$s">%2$s</a>',
						esc_url( add_query_arg( array( 'post_type' => $post->post_type, 'vehicle_category' => $term->slug ), 'edit.php' ) ),
						esc_html( sanitize_term_field( 'name', $term->name, $term->term_id, 'vehicle_category', 'display' ) )
					);
				}
				echo join( ', ', $out );
			}				
			else { _e( 'No Categories' ); }
			break;
		case 'thumbnail' :
			the_post_thumbnail( 'admin-vehicle-thumb' );
		break;
		default :
			break;
	}
}
add_action( 'manage_vehicle_posts_custom_column', 'manage_vehicle_columns', 10, 2 );

//Short thumbnail for vehicle
add_image_size( 'admin-vehicle-thumb', 50, 50, true );

function test_vehicle_posts() {

	$args = array(
		'posts_per_page' => get_option ( 'vehicle-post-perpage' ),
		'post_type' => 'any',
		'post_status' => 'publish',
		'date_query' => array(
			//'after' => array(
				'year' => date( 'Y' ),
				'month' => date( 'm' ),
			//),
			'day' => date ('d'),
		),
		'orderby' => 'date',
		'order' => 'DESC',
	);
	// var_dump( $args );
	$query = new WP_Query( $args );
	// var_dump( $query );
	ob_start();

	while( $query->have_posts() ) :
		$query->the_post(); 
	?>
		<h2><?php the_title(); ?></h2> By <?php the_author(); ?> on <?php the_date(); ?>
	<?php endwhile;	
	wp_reset_postdata();
		
	return ob_get_clean();
}