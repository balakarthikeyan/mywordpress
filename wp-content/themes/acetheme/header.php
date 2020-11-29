<?php
/*
Theme Name: Acqueon Theme for WordPress
Author: Balakarthikeyan
URI: http://www.acqueon.com/
Description: Acqueon Theme for WordPress
Version: 0.0.1
Email: balakarthikeya@gmail.com
License:
*/
?>
<!DOCTYPE html>
<!-- add a class to the html tag if the site is being viewed in IE, to allow for any big fixes -->
<!--[if lt IE 8]><html class="ie7"><![endif]-->
<!--[if IE 8]><html class="ie8"><![endif]-->
<!--[if IE 9]><html class="ie9"><![endif]-->
<!--[if gt IE 9]><html><![endif]-->
<!--[if !IE]><html <?php language_attributes(); ?>><![endif]-->
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <link rel="shortcut icon" type="image/png" sizes="32x32" href="<?php echo get_bloginfo('template_directory'); ?>/images/favicon-32x32.png">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
    <meta http-equiv="X-UA-Compatible" content="IE=9,10" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
    <title>
    <?php
        /*
        * Print the <title> tag based on what is being viewed.
        */
        global $page, $paged;
        wp_title( '|', true, 'right' );

        // Add the blog name.
        bloginfo( 'name' );

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo( 'description', 'display' );
        if ( $site_description && ( is_home() || is_front_page() ) )
            echo " | $site_description";
        ?>
    </title>
    <?php wp_head();?>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src='<?php echo get_bloginfo('template_directory'); ?>/scripts/bootstrap/js/html5shiv.min.js'></script>
        <script src='<?php echo get_bloginfo('template_directory'); ?>/scripts/bootstrap/js/respond.min.js'></script>
    <![endif]-->
</head>

<body <?php body_class(); ?>>
<div class="ace-wrapper">
    <div class="container">
        <div class="row"> 
            <header class="ace-header navbar-fixed-top clearfix">
                <!-- Top bar -->
                <div class="col-xs-12 hidden-xs hidden-sm ace-top-header clearfix">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="top-header-contact">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-phone"></i>
                                                <span>+1 888 946 6878</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-phone"></i>
                                                <span>+91 44 3089 4888</span>
                                            </a>
                                        </li>                                
                                    </ul>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <?php wp_nav_menu(array( 
                                    'menu' => 'primary', 
                                    'container_class' => 'top-header-menu', 
                                    'container' => 'div', 
                                    'theme_location' => 'header-menu')); ?>
                            </div>
                        </div>		
                    </div>
                </div>
                <!-- Menu & Logo bar -->
                <div class="col-xs-12 ace-bottom-header clearfix">
                    <div class="container">
                        <div class="row">
                            <!-- Logo -->
                            <div class="col-xs-12 col-sm-6 col-md-2 col-lg-2">
                                <div class="header-logo">
                                    <?php if ( get_header_image() ) : ?>
                                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php bloginfo( 'name' ); ?>">
                                            <img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
                                        </a>
                                    <?php else: ?>
                                        <h1 class="site-title">
                                            <a href="<?php echo get_bloginfo( 'wpurl' );?>" rel="home">
                                            <?php bloginfo( 'name' ); ?>
                                            </a>
                                        </h1>
                                        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Menu Navigation -->
                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
                                <div class="navbar main-header-menu" role="navigation">
                                    <!-- Brand and toggle get grouped for better mobile display -->
                                    <button type="button" class="btn navbar-toggle" data-toggle="collapse" data-target="#ace-navbar-collapse">
                                        <i class="fa fa-bars"></i>
                                        <span>&nbsp;</span>
                                    </button>
                                    <?php wp_nav_menu(array( 
                                        'menu' => 'main-menu', 
                                        'menu_class' => 'navbar-nav', 
                                        'menu_id' => 'ace-main-menu', 
                                        'container' => 'div', 
                                        'container_class' => 'collapse navbar-collapse',
                                        'container_id' => 'ace-navbar-collapse',
                                        'theme_location' => 'main-menu', 
                                        'show_home' => '1', 
                                        'depth' => 2,
                                        'walker'         => new Bootstrap_NavWalker(),
                                        'fallback_cb'    => 'Bootstrap_NavWalker::fallback',
                                        )); ?>
                                </div>
                            </div>
                            <!-- Custom Header widget-->
                            <div class="col-md-2 col-lg-2 hidden-xs hidden-sm">
                                <?php if ( is_active_sidebar( 'headerbar-widget' ) ) : ?>
                                <?php dynamic_sidebar( 'headerbar-widget' );?>
                                <?php endif; ?>
                            </div>
                        </div>		
                    </div>
                </div>
            </header>
        </div>
    </div>        
    