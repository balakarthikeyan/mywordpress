<?php get_header(); ?>
<div class="container">
    <div class="row">
        <div class="col-sm-8 blog-main">
            <h1 class="blog-title">Search</h1>
            <?php                
                if ( have_posts() ) : 
                    while ( have_posts() ) : 
                        the_post();
                        get_template_part( 'content-vehicle', get_post_format() );
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
                <div class="row">
                    <h2 class="center">No newer/older vehicles</h2>
                    <p class="center">Sorry, but you are looking for something that isn't here.</p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-sm-4 blog-sidebar">
        <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>