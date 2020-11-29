<?php
/*
Template Name: Vehicle Page
Theme Name: Custom Theme Child
Author: Balakarthikeyan
Version: 0.0.1
Email: balakarthikeya@gmail.com
License:
*/
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <h1 class="blog-title">Search</h1>
            <!-- <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>"> -->
            <form role="search" method="post" class="search-form" id="search-form" action="<?php echo admin_url( 'admin-ajax.php' ); ?>">
                <label>
                    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label' ) ?></span>
                    <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Search', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
                    <input type="hidden" name="post_type" value="vehicle" />
                </label>
                <?php 
                //echo do_shortcode("[vehiclesearchform]");
                ?>
                <?php
                if( $terms = get_terms( array( 'taxonomy' => 'vehicle_category', 'orderby' => 'name' ) ) ) : 
                    echo '<select name="category"><option value="">Select category...</option>';
                    foreach ( $terms as $term ) :
                        echo '<option value="' . $term->term_id . '">' . $term->name . '</option>'; 
                    endforeach;
                    echo '</select>';
                endif;
                ?>
                <input type="text" name="price_min" placeholder="Min price" />
                <input type="text" name="price_max" placeholder="Max price" />
                <select name="filterBy">
                  <option value="date" selected="selected">Date</option>
                  <option value="title">Title</option>
                </select>
                <select name="orderBy">
                  <option value="ASC">Ascending</option>
                  <option value="DESC" selected="selected">Descending</option>
                </select>                
                <label>
                    <input type="checkbox" name="featured_image" value="on" /> Only posts with featured images
                </label>                
                <input type="submit" class="search-submit" value="<?php echo esc_attr_x( 'Search', 'submit button' ) ?>" />
                <a href="<?php echo get_post_type_archive_link('vehicle'); ?>">Reset</a>
                <input type="hidden" name="action" value="ajax-vehicles">
                <input type="button" class="ajax-filter" value="Filter" />
            </form>
            <div id="response"></div>            
            <?php
                $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
                $args = array(
                    'orderby'           => 'date',
                    'order'             => 'DESC',
                    'post_status'       => 'publish',
                    'posts_per_page'    => get_option('vehicle-post-perpage'),
                    'paged'             => $paged,
                    'post_type'         => array('vehicle'), 
                );                
                $vehicles = new WP_Query( $args ); 

                if ( $vehicles->have_posts() ) : 
                    while ( $vehicles->have_posts() ) : 
                        $vehicles->the_post();
                        get_template_part( 'content-vehicle', get_post_format() );
                    endwhile;
                endif;
            ?>
            <?php if ( $vehicles->max_num_pages > 1 ) : ?>
            <nav>
                <ul class="pager">
                    <li><?php next_posts_link( 'Previous', $vehicles->max_num_pages ); ?></li>
                    <li><?php previous_posts_link( 'Next', $vehicles->max_num_pages ); ?></li>
                </ul>
            </nav>
            <?php else: ?>
                <div>No newer/older vehicles</div>                
            <?php endif; ?>
        </div>
        <?php wp_reset_postdata(); ?>
        <div class="col-sm-4 blog-sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<script>
jQuery(function($){
	$('.ajax-filter').click(function(){
		var filter = $('#search-form');
		$.ajax({
			url:filter.attr('action'),
			data:filter.serialize(),
			type:filter.attr('method'),
			beforeSend:function(xhr){
				filter.find('.ajax-filter').text('Processing...');
			},
			success:function(data){
				filter.find('.ajax-filter').text('Applied filter');
				$('#response').html(data);
			}
		});
		return false;
	});
});
</script>

<?php get_footer(); ?>