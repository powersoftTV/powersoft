<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>" >
    <meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' >
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <?php wp_head(); ?>
    
</head>
<body <?php body_class(); ?>>


<header>

    <div class="container header_content padding_zero">
        <div class="inside">
            <div class="col-lg-4 col-md-4 col-sm-3 padding_zero padding_norm logo" title="Caragago">
                <a href="/" ><img src="<?php echo get_template_directory_uri().'/imgs/logo.png'; ?>" alt="<?php echo $_SERVER['HTTP_HOST'] ?>"></a>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-9 padding_zero padding_norm">
                <div class="right_wrapper">
                    <div class="apply_now_wrapper"><a href="/apply" class="apply_now pull-right">APPLY NOW</a></div>
                    <nav class="navbar" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <?php
                        wp_nav_menu( array(
                                'menu'              => 'primary',
                                'theme_location' => 'top-menu',
                                'depth'             => 2,
                                'container'         => 'div',
                                'container_class'   => 'navbar-collapse collapse',
                                'menu_class'        => 'nav navbar-nav',
                                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                                'walker'            => new wp_bootstrap_navwalker())
                        );
                        ?>

                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>

