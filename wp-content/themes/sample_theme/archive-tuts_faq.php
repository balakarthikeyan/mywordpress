<?php
/**
 * The template for displaying the FAQ archive.
 *
 */
get_header(); ?>
<div id="main-content" class="main-content">
    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">
            <?php // first loop - titles with link to detailed answers ?>
            <h2>Frequently Asked Questions - click for answers</h2>
            <ul class="faq-list">
                <?php while ( have_posts() ) : the_post(); /* start the loop */ ?>
                <li class="post-<?php the_ID(); ?>" <?php post_class(); ?>><a href="#post-<?php the_ID(); ?>" title="<?php printf( esc_attr__( 'Link to %s', 'compass' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                    <?php the_title(); ?>
                    </a></li>
                <?php endwhile; /* end the loop*/ ?>
            </ul>
            <?php // second loop - rewind and run again ?>
            <?php rewind_posts() ; ?>
            <?php while ( have_posts() ) : the_post(); /* start the loop */ ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <h3><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'compass' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
                    <?php the_title(); ?>
                    </a></h3>
                <section class="entry-content">
                    <?php the_content(); ?>
                </section>
                <!-- .entry-content --> 
            </article>
            <?php endwhile; /* end the loop*/ ?>
        </div>
        <!-- #content --> 
    </div>
    <!-- #primary -->
    <?php get_sidebar( 'content' ); ?>
</div>
<!-- #main-content -->
<?php
get_sidebar();
get_footer();
