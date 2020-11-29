<aside id="primary-sidebar" class="primary-sidebar widget-area" role="complementary">
    <div class="sidebar-module">
        <h4>About</h4>
        <p><?php the_author_meta( 'description' ); ?> </p>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol>
            <?php wp_get_archives( 'type=monthly' ); ?>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Follow us</h4>
        <ul>    
            <li><a href="<?php echo get_option('facebook'); ?>">Facebook</a></li>
            <li><a href="<?php echo get_option('twitter'); ?>">Twitter</a></li>
        </ul>
    </div>
</aside>

<?php if ( is_active_sidebar( 'sidebar-widget-area' ) ) { ?>
    <aside class="secondary-sidebar widget-area" role="complementary">
        <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>
    </aside>
<?php } ?> 