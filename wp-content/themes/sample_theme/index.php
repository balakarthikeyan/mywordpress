<?php // the index template file - the default template file WordPress uses to display content ?>
<?php get_header(); ?>

<div id="content" class="two-thirds">
    <?php // start the loop ?>
    <?php while ( have_posts() ) : the_post(); ?>
    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <h2 class="entry-title"> <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'compass' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php the_title(); ?>
            </a> </h2>
        <img src="images/featured-image.jpg" class="size-large">
        <section class="entry-meta">
            <p>Posted on
                <?php the_date(); ?>
                by
                <?php the_author(); ?>
            </p>
        </section>
        <!-- .entry-meta -->
        
        <section class="entry-content">
            <?php the_content(); ?>
        </section>
        <!-- .entry-content -->
        
        <section class="entry-meta">
            <?php if ( count( get_the_category() ) ) : ?>
            <span class="cat-links"> Categories: <?php echo get_the_category_list( ', ' ); ?> </span>
            <?php endif; ?>
        </section>
        <!-- .entry-meta --> 
        
    </article>
    <!-- #01-->
    
    <?php endwhile; ?>
    <?php // ends the loop ?>
</div>
<!-- #content-->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
