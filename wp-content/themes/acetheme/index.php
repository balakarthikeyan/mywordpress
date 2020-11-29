<?php
/*
Theme Name: Custom Theme
Theme URI: https://www.github.com/balakarthikeyan/wp-themes
Author: Balakarthikeyan
Author URI: https://www.github.com/balakarthikeyan
Email: balakarthikeya@gmail.com
Description: Custom Theme for WordPress
Version: 0.0.1
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Template Name: Custom Theme
Text Domain: acetheme
Tags: one-column, two-columns, right-sidebar, flexible-header
*/
?>
<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <h1 class="blog-title">From Index</h1>
            <?php
                if ( have_posts() ) : 
                    while ( have_posts() ) : 
                        the_post();
                        get_template_part( 'content', get_post_format() );
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    endwhile; 
                endif;
            ?>
            <?php if ( $wp_query->max_num_pages > 1 ) : ?>
            <nav>
                <ul class="pager">
                    <li><?php next_posts_link( 'Previous' ); ?></li>
                    <li><?php previous_posts_link( 'Next' ); ?></li>
                </ul>
            </nav>
            <?php else: ?>
                <div>No newer/older posts</div>
            <?php endif; ?>
        </div>
        <div class="col-sm-4 blog-sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>