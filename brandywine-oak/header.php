<?php
/**
 * The header for our theme
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package Wyeth
 */
?>
<!doctype html>
<html <?php language_attributes(); ?> class="_no_js">
	<head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="preconnect" href="https://fonts.gstatic.com">
		<link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital@1&display=swap" rel="stylesheet"> 
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="stylesheet" type="text/css" href="https://cloud.typography.com/6221256/7810392/css/fonts.css"/>
		<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri().'/custom.css'; ?>"/>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-127788318-1"></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag(){dataLayer.push(arguments);}
			gtag('js', new Date());
			gtag('config', 'UA-127788318-1');
		</script>
        <?php if ( is_front_page() ) : ?>
            <link href="https://vjs.zencdn.net/7.5.5/video-js.css" rel="stylesheet"/>
		<?php endif; ?>
		<?php wp_head(); ?>
	</head>
    <body <?php body_class(); ?>>
        <div id="page" class="site off-canvas-content">
            <a class="skip-link show-for-sr" href="#content">
                <?php esc_html_e( 'Skip to content', 'wyeth' ); ?>
            </a>

            <header class="globalHeader" data-js-component="stickyHeader">
                <div class="row column">
                    <button 
                        class="menu-toggle"
                        type="button"
                        data-toggle="offCanvasRight"
                        aria-expanded="false"
                        aria-controls="offCanvasRight"
                    >
                    </button>
                    <?php
                        $twitter  = get_field( 'twitter_url', 'options' );
                        $linkedin = get_field( 'linkedin_url', 'options' );
                    ?>
                    <div 
                        class="globalNav_wrap multilevel-offcanvas off-canvas in-canvas-for-large position-right clearfix"
						style="float: right"
                        id="offCanvasRight"
                        data-js-component="globalNav"
                        data-off-canvas
                    >
                        <button class="close-button" aria-label="Close menu" type="button" data-close>
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <nav class="globalNav">
                            <!-- Menu -->
                            <ul class="globalMenu">
                                <!-- Logo -->
                                <div class="logo" style="float: left">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" style="border-bottom: none;" rel="home">
                                        <?php include 'logo.svg'; ?>
                                    </a>
                                </div>
                                <!-- Pages -->
                                <?php
                                    wp_nav_menu( array(
                                        'container'      => '',
                                        'items_wrap'     => '%3$s',
                                        'theme_location' => 'primary',
                                    ) );
                                ?>
                                <?php if ( $twitter ): ?>
                                    <li class="hide-for-large social social--twitter">
                                        <a href="<?php $twitter ?>">
                                            <span>Twitter</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                                <?php if ( $linkedin ): ?>
                                    <li class="hide-for-large social social--linkedin">
                                        <a href="<?php $linkedin ?>">
                                            <span>Linkedin</span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <!-- Menu End -->
                        </nav><!-- .globalNav -->
                    </div>
                </div>
            </header><!-- #masthead -->
            <ul style="z-index: 999" class="socialMenu show-for-large">
                <?php if ( $twitter ): ?>
                    <li style="text-align: center;" class="social social--twitter">
                        <a href="<?php $twitter ?>">
                            <span>Twitter</span>
                        </a>
                    </li>
                <?php endif; ?>
                <?php if ( $linkedin ): ?>
                    <li style="text-align: center;" class="social social--linkedin">
                        <a href="<?php $linkedin ?>">
                            <span>Linkedin</span>
                        </a>
                    </li>
                <?php endif; ?>
                <li class="social" style="line-height: 0;text-align: center;">
                    <a
                        target="_blank"
                        style="text-align: center; font-weight: bold;line-height: 18px!important;font-size: 0.85em;"
                        href="https://brokercheck.finra.org/"
                    >
                        Broker<br>Check
                    </a>
                </li>
            </ul>
            <div id="content" class="content">
                <div id="primary" class="content-area">
                    <main id="main" class="site-main">
