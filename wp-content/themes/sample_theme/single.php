<?php get_header(); ?>

<div id="blog">
    <?php if(have_posts()) : ?>
    <?php while(have_posts()) : the_post(); ?>
    <div class="post">
        <h3><a href="<?php the_permalink(); ?>">
            <?php the_title(); ?>
            </a></h3>
        <div class="entry">
            <?php the_post_thumbnail(); ?>
            <?php the_content(); ?>
            <p class="postmetadata">
                <?php _e('Filed under&#58;'); ?>
                <?php the_category(', ') ?>
                <?php _e('by'); ?>
                <?php  the_author(); ?>
                <br />
                <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?>
                <?php edit_post_link('Edit', ' &#124; ', ''); ?>
            </p>
        </div>
        <?php
		// Let's find out if we have taxonomy information to display
		$taxo_text = "";
		$category_list = get_the_term_list( $post->ID, 'event_category', '<strong>Categories:</strong> ', ', ', '' );
        $location_list = get_the_term_list( $post->ID, 'location', '<strong>Location(s):</strong> ', ', ', '' );
		// Add Categories list if this post was so tagged
		if ( '' != $category_list ) {
			$taxo_text .= "$category_list<br />\n";
		}
		// Add Location list if this post was so tagged
		if ( '' != $location_list ) {
			$taxo_text .= "$location_list<br />\n";
		}
		?>
        <?php if ( '' != $taxo_text ) {	?>
		<div class="entry-utility"><?php echo $taxo_text;?></div>
		<?php } ?> 
        <?php echo wpb_related_post_categories(); ?>       
        <div class="comments-template">
            <h2>What do you think?</h2>
            <?php comments_template(); ?>
        </div>
    </div>
    <?php endwhile; ?>
    <?php echo wptuts_more_from_cat( 'More From This Category:' ); ?>
    <div class="navigation">
        <?php previous_post_link('< %link') ?>
        <?php next_post_link(' %link >') ?>
    </div>
    <?php endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
