<?php
// register navigation menu
function wptutsplus_register_theme_menu() {
	register_nav_menu( 'primary', 'Main Navigation Menu' );
}
add_action( 'init', 'wptutsplus_register_theme_menu' );

// register sidebar widgets
function wptutsplus_widgets_init() {
	
	// In header widget area, located to the right hand side of the header, next to the site title and description. Empty by default.
	register_sidebar( array(
		'name' => 'In Header Widget Area',
		'id' => 'in-header-widget-area',
		'description' => 'A widget area located to the right hand side of the header, next to the site title and description.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
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
add_action( 'widgets_init', 'wptutsplus_widgets_init' );

// "More from This Category" list by Barış Ünver @ Wptuts+
function wptuts_more_from_cat( $title = "More From This Category:" ) {
    global $post;
    // We should get the first category of the post
    $categories = get_the_category( $post->ID );
    $first_cat = $categories[0]->cat_ID;
    // Let's start the $output by displaying the title and opening the <ul>
    $output = '<div id="more-from-cat"><h3>' . $title . '</h3>';
    // The arguments of the post list!
    $args = array(
        // It should be in the first category of our post:
        'category__in' => array( $first_cat ),
        // Our post should NOT be in the list:
        'post__not_in' => array( $post->ID ),
        // ...And it should fetch 5 posts - you can change this number if you like:
        'posts_per_page' => 5
    );
    // The get_posts() function
    $posts = get_posts( $args );
    if( $posts ) {
        $output .= '<ul>';
        // Let's start the loop!
        foreach( $posts as $post ) {
            setup_postdata( $post );
            $post_title = get_the_title();
            $permalink = get_permalink();
            $output .= '<li><a href="' . $permalink . '" title="' . esc_attr( $post_title ) . '">' . $post_title . '</a></li>';
        }
        $output .= '</ul>';
    } else {
        // If there are no posts, we should return something, too!
        $output .= '<p>Sorry, this category has just one post and you just read it!</p>';
    }
    // Let's close the <div> and return the $output:
    $output .= '</div>';
    return $output;
}
function wpb_related_post_tags() { 
	$orig_post = $post;
	global $post;
	$tags = wp_get_post_tags($post->ID);
	if ($tags) {
		$tag_ids = array();
		foreach($tags as $individual_tag) {
			$tag_ids[] = $individual_tag->term_id;
		}
		$args=array(
			'post_type' => 'page',
			'tag__in' => $tag_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=>5
		);
		$my_query = new WP_Query( $args );
		if( $my_query->have_posts() ) {
			echo '<div id="relatedpages"><h3>Related Pages</h3><ul>';
			while( $my_query->have_posts() ) {
			$my_query->the_post();
		?>
			<li>
                <div class="relatedthumb">
                    <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('thumb'); ?></a>
                </div>
                <div class="relatedcontent">
                    <h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_time('M j, Y') ?>
                </div>
			</li>
			<?php }
			echo '</ul></div>';
		} else { 
			echo "No Related Pages Found:";
		}
	}
	$post = $orig_post;
	wp_reset_query(); 
}
function wpb_related_post_categories() { 
	$orig_post = $post;
	global $post;
    $categories = get_the_category($post->ID);
    if ($categories) {
    	$category_ids = array();
    	foreach($categories as $individual_category) {
			$category_ids[] = $individual_category->term_id;
		}

		$args=array(
			'category__in' => $category_ids,
			'post__not_in' => array($post->ID),
			'posts_per_page'=> 2, // Number of related posts that will be shown.
			'caller_get_posts'=>1
		);

    	$my_query = new wp_query( $args );
    	if( $my_query->have_posts() ) {
			echo '<div id="relatedpages"><h3>Related Pages</h3><ul>';
			while( $my_query->have_posts() ) {
			$my_query->the_post();
		?>
			<li>
                <div class="relatedthumb">
                    <a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_post_thumbnail('thumb'); ?></a>
                </div>
                <div class="relatedcontent">
                    <h3><a href="<?php the_permalink()?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
                    <?php the_time('M j, Y') ?>
                </div>
			</li>
			<?php }
			echo '</ul></div>';
		} else { 
			echo "No Related Pages Found:";
		}
	}
	$post = $orig_post;
	wp_reset_query(); 
}
// remove unwanted dashboard widgets for relevant users


require_once( 'wptuts-options/wptuts-options.php' );