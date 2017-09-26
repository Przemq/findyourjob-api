<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php wp_title(''); ?></title>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="<?php echo THEME_IMAGES_URI ?>/Eventshares-Fav.ico">
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
    <?php
    //  Get all style options from wpx_theme
    $searchBackground = !empty(wpx_theme_get_option('wpx_theme_search_background')) ? wpx_theme_get_option('wpx_theme_search_background') : '#da8b00';
    $searchBackgroundHover = !empty(wpx_theme_get_option('wpx_theme_search_background_hover')) ? wpx_theme_get_option('wpx_theme_search_background_hover') : '#c17b01';
    $menu_text_color = !empty(wpx_theme_get_option('wpx_theme_navigation_menu_text_color')) ? wpx_theme_get_option('wpx_theme_navigation_menu_text_color') : '#004a85';
    $menu_text_color_hover = !empty(wpx_theme_get_option('wpx_theme_navigation_menu_text_color_hover')) ? wpx_theme_get_option('wpx_theme_navigation_menu_text_color_hover') : '';
    $menu_font_family = !empty(wpx_theme_get_option('wpx_theme_navigation_font_family')) ? wpx_theme_get_option('wpx_theme_navigation_font_family') : "";
    $menu_text_color_mobile = !empty(wpx_theme_get_option('wpx_theme_navigation_menu_text_color_mobile')) ? wpx_theme_get_option('wpx_theme_navigation_menu_text_color_mobile') : '';
    $menu_background_search_color_mobile = !empty(wpx_theme_get_option('wpx_theme_navigation_menu_mobile_search_background')) ? wpx_theme_get_option('wpx_theme_navigation_menu_mobile_search_background') : '';

    //	Get available font family and assign it correct value
    if ($menu_font_family === "standard") {
        $menu_font_family = '"Merriweather", serif';
    } else if ($menu_font_family === 'standard_italic') {
        $menu_font_family = '"Merriweather Italic",serif';
    } else if ($menu_font_family === 'roboto') {
        $menu_font_family = "'Roboto Condensed', sans-serif";
    }


    ?>

    <style>
        header nav .wpx-search .desktop-search .search-submit svg path {
            fill: <?=$searchBackground?>;
        }

        header nav .wpx-search .desktop-search .search-submit:hover svg path {
            fill: <?=$searchBackgroundHover?>;
        }

        header nav > ul.menu > li:after {
            background: <?=$menu_text_color?>;
        }

        <?php
            if ($menu_font_family !=='none') :?>

        header nav ul li a {
            font-family: <?=$menu_font_family?>;
        }

        <?php endif;
        ?>

        header nav ul > li > a {
            color: <?=$menu_text_color?>;
        }

        header nav .wpx-search .hidden-before-hover {
            background: <?= wpx_theme_get_option('wpx_theme_search_input_background') ?>;
        }

        /**/
        .wpg-mobile header nav ul li .sub-menu-flex li a h4 {
            color: #292b2c;
        }

        header nav > ul.menu > li:after,
        {
            background-color: <?=$menu_text_color?>;
        }

        header nav > ul.menu > li > a:hover {
            color: <?=$menu_text_color_hover?>;

        }

        body.wpx-desktop .wpx-main-header nav > ul > li:hover a {
            color: <?=$menu_text_color_hover?>;
        }

        .wpg-mobile header nav ul.menu li a {
            color: <?=$menu_text_color_mobile?>;
        }

        header nav .wpx-search-mobile .mobile-search .search-mobile-button {
            background: <?= $menu_background_search_color_mobile?>;
        }


        /*  CUSTOM STYLES FROM WPX_THEME_OPTIONS */

        /*  Footer left/right editor   */

        footer #footer #left-column {
            font-size: <?=wpx_theme_get_option('wpx_theme_footer_small_text_size')?>;
            color: <?=wpx_theme_get_option('wpx_theme_footer_small_text_color')?>;
        }

        footer #footer #right-column {
            font-size: <?=wpx_theme_get_option('wpx_theme_footer_big_text_size')?>;
            color: <?=wpx_theme_get_option('wpx_theme_footer_big_text_color')?>;
        }

        /*End Footer left/right enditor*/

        /*  Footer menu links   */
        footer #menu-items ul li a {
            -webkit-transition: 300ms all;
            -moz-transition: 300ms all;
            -ms-transition: 300ms all;
            -o-transition: 300ms all;
            transition: 300ms all;
            color: <?=wpx_theme_get_option('wpx_theme_footer_link_color')?>;
        }

        footer #menu-items ul li a:hover {
            color: <?=wpx_theme_get_option('wpx_theme_footer_link_color_hover')?>;
        }

        /*  End Footer menu links   */

        /* Footer icon custom color*/
        footer #footer-nav svg path, footer #footer-nav svg rect {
            fill: <?=wpx_theme_get_option('wpx_theme_footer_icon_color')?>;

        }

        footer #footer-nav svg:hover path, footer #footer-nav svg:hover rect {
            fill: <?=wpx_theme_get_option('wpx_theme_footer_icon_color_hover')?>;

        }

        /*End Footer icon custom color*/

        /*  Footer Copyrights styles   */
        footer #copyright {
            color: <?=wpx_theme_get_option('wpx_theme_footer_copyright_color')?>;
            font-size: <?=wpx_theme_get_option('wpx_theme_footer_copyright_size')?>;

        }
        footer #bottom-footer-background {
            background-color: <?=wpx_theme_get_option('wpx_theme_footer_bottom_footer_background_color')?>;

        }
        footer #bottom-footer-background p {
            font-size: <?=wpx_theme_get_option('wpx_theme_footer_bottom_footer_font_size')?>;
            color: <?=wpx_theme_get_option('wpx_theme_footer_bottom_footer_text_color')?>;
        }
        /*  End Footer Copyrights styles   */


    </style>
</head>
<body class="<?= wpx_body_class() ?>">
<?php
/**
 * Include needed parts
 * Country & investor modal - simply uncomment this if you want to use modal on your site.
 */
// include 'includes/modal/country-investor.php'; ?>

<?= createTaskLink('EV-15') ?>
<?= createTaskLink('EV-36') ?>
<div id="subscribe-modal" class="modal fade ">
    <div class="modal-dialog">
        <div class="container">
            <div class="row">
                <div class="modal-content col-12">
                    <div class="box col-12">
                        <p>Subscribe to Future Updates from EventShares</p>
                        <form>
                            <div class="form-group">
                                <label for="subscribe-email">Email address*</label>
                                <input type="email" class="form-control" id="subscribe-email"
                                       aria-describedby="subscribe-email" placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <label for="subscribe-select">How would you describe yourself?</label>
                                <select class="form-control" id="subscribe-select">
                                    <option value="Individual Investor">Individual Investor</option>
                                    <option value="Financial Advisor">Financial Advisor</option>
                                    <option value="Family Office">Family Office</option>
                                    <option value="Institutional Investor">Institutional Investor</option>
                                    <option value="Non-US Investor">Non-US Investor</option>
                                </select>
                            </div>
                            <button id="subscribe-submit" type="submit" class="btn btn-primary button">send</button>
                            <p class="subscribe-info"></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<header id="wpx-eventshare-header">
    <div class="container-fluid">
        <div class="container">
            <div class="ps-logo-for-printing">
                <img
                     src="<?= THEME_IMAGES_URI; ?>/EventSharesLogo.svg"
                     alt="logo eventShares">
            </div>
            <div class="wpx-name-module-header">
                <div class="row" id="top-menu">
                    <div class="col-lg-2 image-wrapper">

                        <a class="logo-link" href="<?= HOME_URL ?>"><img
                                    src="<?= THEME_IMAGES_URI; ?>/EventSharesLogo.svg" alt="logo eventShares"></a>
                        <a class="wpx-button-hamburger" href="#"><span></span><span></span><span></span></a>
                    </div>
                    <nav id="main-nav" class="nav col row">
                        <div class="wpx-search-mobile">
                            <div class="mobile-search">
                                <form role="search" method="get" class="search-form-mobile"
                                      action="<?php echo home_url('/'); ?>">
                                    <input type="search" class="search-field"
                                           placeholder="<?php echo esc_attr_x('Search...', 'placeholder') ?>"
                                           value="<?php echo get_search_query() ?>" name="s"
                                           title="<?php echo esc_attr_x('Search for:', 'label') ?>"/>
                                    <button type="submit" class="search-submit search-mobile-button "
                                            value=""><img src="<?= THEME_IMAGES_URI; ?>/white-cheveron-right.svg"
                                                          alt="chevron">
                                    </button>
                                </form>
                            </div>

                        </div>


                        <?php
                        if (function_exists('wpx_pagebox')) {
                            foreach (get_posts(['post_type' => 'header_nav']) as $headerPost) {
                                /** @var WP_Post $headerPost */
                                wpx_pagebox($headerPost->ID);
                            }
                        }
                        ?>


                        <div class="wpx-search">
                            <div class="desktop-search">
                                <form role="search" method="get" class="search-form"
                                      action="<?php echo home_url('/'); ?>">
                                    <input id="search-input" type="search" class="hidden-before-hover search-field"
                                           placeholder="<?php echo esc_attr_x('Search...', 'placeholder') ?>"
                                           value="<?php echo get_search_query() ?>" name="s"
                                           title="<?php echo esc_attr_x('Search for:', 'label') ?>"/>
                                    <button type="submit" class="search-submit"
                                            value=""><img class="style-svg" id="search-icon"
                                                          src="<?= THEME_IMAGES_URI; ?>/Magnifying%20Glass-01-01.svg"
                                                          alt="search"></button>
                                </form>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</header>

