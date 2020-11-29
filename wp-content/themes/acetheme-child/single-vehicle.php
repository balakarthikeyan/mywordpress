<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <?php
                if ( have_posts() ) : 
                    while ( have_posts() ) : 
                        the_post();
						get_template_part( 'page-vehicle', get_post_format() );           
                    endwhile; 
                endif;
            ?>
        </div>
        <div class="col-sm-4 blog-sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>