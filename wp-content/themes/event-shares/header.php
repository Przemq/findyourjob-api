<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php
	/**
	 * Script for redirects while using country & investor modal (country-modal.php)
	 * It uses cookies created in script.js
	 * match = pathName.match(/^\/(?:(uk|ie|je|rw)\/)(?:(charities|private-client|financial-adviser|professional-advisers))?(.*)/i);
	 * match have to be changed to used countries and investors in country-investor.php (data-country & data-profile)
	 */
	?>
    <!--    <script>-->
    <!--        (function () {-->
    <!--            /**-->
    <!--             * Script redirect you to selected country and investor. You are redirected to UK when 'Other country' selected-->
    <!--             * If you want to set redirect to 'rw' (Rest of World) you have to change data-country in country-investor.php-->
    <!--             */-->
    <!--            var countryCookie = document.cookie.match(/country=([a-z]+);/),-->
    <!--                profileCookie = document.cookie.match(/profile=([a-z, -]+)/),-->
    <!--                windowLocation = window.location,-->
    <!--                pathName = windowLocation.pathname,-->
    <!--                match = pathName.match(/^\/(?:(uk|ie|je|rw)\/)(?:(charities|private-client|financial-adviser|professional-advisers))?(.*)/i);-->
    <!---->
    <!--            // If cookie exist and cookie char number >=2-->
    <!--            if (countryCookie !== null && countryCookie[1] && countryCookie[1].length >= 2) {-->
    <!--                // If we are not on homepage (empty match mean homepage)-->
    <!--                if (match !== null) {-->
    <!--                    // If match[1] (country) is undefined or match[1] (country) != country cookie or match[2] (investor) != profile cookie-->
    <!--                    if (match[1] === undefined || match[1] != countryCookie[1] || match[2] != profileCookie[1]) {-->
    <!--                        windowLocation.replace('/' + countryCookie[1] + '/' + profileCookie[1] + '/' + match[3]);-->
    <!--                    }-->
    <!--                    // If we are on homepage and cookie set then redirect to country/investor-->
    <!--                } else if (pathName == '/' && countryCookie[1].length >= 2 && profileCookie[1]) {-->
    <!--                    windowLocation.replace('/' + countryCookie[1] + '/' + profileCookie[1] + '/');-->
    <!--                }-->
    <!--            } else if (pathName != '/' && pathName != '' && countryCookie[1] == 0) {-->
    <!--                windowLocation.replace('/');-->
    <!--            }-->
    <!--        })();-->
    <!--    </script>-->














	<?php wp_head(); ?>
</head>
<body class="<?= wpx_body_class() ?>">
<?php
/**
 * Include needed parts
 * Country & investor modal - simply uncomment this if you want to use modal on your site.
 */
// include 'includes/modal/country-investor.php'; ?>

<header id="wpx-eventshare-header">
	<?php require_once( 'pageContent.php' ); ?>
    <div class="container-fluid">
        <div class="container">
            <div class="wpx-name-module-header">
                <div class="row" id="top-menu">
                    <div class="col-lg-2 image-wrapper">

                        <a href="<?= HOME_URL ?>"><img src="<?= THEME_IMAGES_URI; ?>/logo.jpg"></a>
                        <a class="wpx-button-hamburger" href="#"><span></span><span></span><span></span></a>
                    </div>
                    <nav class="nav col row">
						<div class="wpx-search-mobile">
                            <div class="mobile-search">
                                <form role="search" method="get" class="search-form-mobile"
                                      action="<?php echo home_url( '/' ); ?>">
                                    <input type="search" class="search-field"
                                           placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder' ) ?>"
                                           value="<?php echo get_search_query() ?>" name="s"
                                           title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"/>
                                    <button type="submit" class="search-submit search-mobile-button "
                                            value=""><img src="<?= THEME_IMAGES_URI; ?>/white-cheveron-right.svg"></button>
                                </form>
                            </div>

                        </div>
                        <?php
						if ( has_nav_menu( 'header' ) ) {
							wp_nav_menu( array(
								'theme_location'  => 'header',
								'container'       => false,
								'container_class' => 'nav col',
								'menu_class'      => 'menu nav',
								'walker'          => new Menu_With_Description()
							) );

						};
						?>

                        <div class="wpx-search">
                            <div class="desktop-search">
                                <form role="search" method="get" class="search-form"
                                      action="<?php echo home_url( '/' ); ?>">
                                    <input type="search" class="hidden-before-hover search-field"
                                           placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder' ) ?>"
                                           value="<?php echo get_search_query() ?>" name="s"
                                           title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>"/>
                                    <button type="submit" class="search-submit"
                                            value=""><img class="style-svg" id="search-icon"
                                                          src="<?= THEME_IMAGES_URI; ?>/Magnifying%20Glass-01-01.svg"
                                                          alt="search"></button>
                                </form>
                            </div>

                    </nav>

                </div>
                <div class="row noDisplay" id="about-sub-menu">
                    <div class="col-lg-4 col-sm-12">
                        <h4><?php echo $pageContent['about-us-sub1']; ?></h4>
                        <p><?php echo $pageContent['lorem']; ?></p>
                        <a href=""><?php echo $pageContent['learn-more']; ?></a>
                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <h4><?php echo $pageContent['about-us-sub2']; ?></h4>
                        <p><?php echo $pageContent['lorem']; ?></p>
                        <a href=""><?php echo $pageContent['learn-more']; ?></a>

                    </div>
                    <div class="col-lg-4 col-sm-12">
                        <h4><?php echo $pageContent['about-us-sub3']; ?></h4>
                        <p><?php echo $pageContent['lorem']; ?></p>
                        <a href=""><?php echo $pageContent['learn-more']; ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--nav>

    </nav-->
</header>