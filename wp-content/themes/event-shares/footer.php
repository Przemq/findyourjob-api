<footer>
    <?= createTaskLink('EV-21') ?>
    <style>

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

        /*  End Footer Copyrights styles   */

    </style>
    <div class="container">
        <div class="row" id="footer">
            <div class="col-md-3 col-sm-10"
                 id="left-column"><?= wpx_theme_get_option('wpx_theme_footer_small_text'); ?></div>
            <div class="col-md-9 col-sm-12"
                 id="right-column">
                <?php
                $content = wpx_theme_get_option('wpx_theme_footer_big_text');
                echo apply_filters('the_content', $content);
                ?>
            </div>
        </div>
        <div class="row" id="footer-nav">
            <div class="col-lg-4 col-md-5 col-sm-8 col-6" id="social-wrapper">
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_facebook') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Facebook%20Green%20Icon-01-01.svg">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_twitter') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Twitter%20Green%20Icon-01-01.svg">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_linkedin') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Linkedin%20Green%20Icon-01-01.svg">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_instagram') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/instagram.svg">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_medium') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/mediumIcon.svg">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_seeking_alpha') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Linkedin%20Green%20Icon-01-01.svg">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_stock_twits') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Twitter%20Green%20Icon-01-01.svg">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_google_plus') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/google-plus.svg">
                </a>
            </div>
            <div class="col-lg-8 col-md-7 col-sm-4 col-6" id="menu-items">
                <?php
                if (has_nav_menu('footer')) {
                    wp_nav_menu(array(
                            'theme_location' => 'footer',
                            'container' => false,
                            'depth' => 1
                        )
                    );
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-12" id="copyright"><?= wpx_theme_get_option('wpx_theme_footer_copyright_text') ?></div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
<?php
/**
 * Google Analytics
 */
include_once 'includes/analyticstracking.php';
?>
</html>