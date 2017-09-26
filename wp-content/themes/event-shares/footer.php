<footer>
    <?= createTaskLink('EV-21') ?>
<!--   footer styles in header.php - moved because of w3 validator-->
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
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Facebook%20Green%20Icon-01-01.svg"
                         alt="facebook icon">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_twitter') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Twitter%20Green%20Icon-01-01.svg"
                         alt="twitter icon">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_linkedin') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Linkedin%20Green%20Icon-01-01.svg"
                         alt="linkedIn icon">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_instagram') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/instagram.svg" alt="instagram icon">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_medium') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/mediumIcon.svg" alt="medium icon">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_seeking_alpha') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/Seeking-Alpha-Logo.svg"
                         alt="seekinh-alpha-logo">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_stock_twits') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/StockTwits-Logo.svg" alt="stock-twits icon">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_google_plus') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/google-plus.svg" alt="google plus icon">
                </a>
                <a target="_blank" href="<?= wpx_theme_get_option('wpx_theme_footer_youtube') ?>">
                    <img class="style-svg" src="<?= THEME_IMAGES_URI; ?>/youTube.svg" alt="youTube icon">
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
    <div class="container-fluid" id="bottom-footer-background">
        <div class="container">
            <div class="row">
                <div class="col-12" id="bottom-footer">
                    <?php
                    $bottomText = wpx_theme_get_option('wpx_theme_footer_bottom_footer_text');
                    echo apply_filters('the_content', $bottomText);
                    ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<?php
/**
 * Google Analytics
 */
include_once 'includes/analyticstracking.php';
?>
</body>
</html>