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

    <?php endif; ?>

    header nav ul > li > a {
        color: <?=$menu_text_color?>;
    }

    header nav .wpx-search .hidden-before-hover {
        background: <?= wpx_theme_get_option('wpx_theme_search_input_background') ?>;
    }

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

    /* Styles for search */

    <?php
  if (!empty($isBackgroundImageID) && $isBackgroundImageID ==!"" ) :
  $backgroundID = (int) $isBackgroundImageID;
  $backgroundUrl = wp_get_attachment_image_url($backgroundID,'full');

  $isBackgroundImageID = wpx_theme_get_option( 'wpx_theme_search_results_background_image_id' );
  $opacity = wpx_theme_get_option( 'wpx_theme_search_results_background_opacity' );
  ?>
    .search-results .large-header:before {
        background-size: cover;
        background: url("<?=$backgroundUrl?>") center;
        opacity: <?=$opacity?>;
    }

    <?php else: ?>
    .search-results .large-header {
        background-color: <?=wpx_theme_get_option( 'wpx_theme_search_results_background_color' )?>;
    }

    <?php
    endif;

         ?>
    .search-results .large-header .large-header-inner .large-header-content h1 {
        font-size: <?=wpx_theme_get_option( 'wpx_theme_search_results_title_size' )?>;
        color: <?=wpx_theme_get_option( 'wpx_theme_search_results_title_color' )?>;
    }

    .search-results .large-header .large-header-inner .large-header-content h4 {
        font-size: <?=wpx_theme_get_option( 'wpx_theme_search_results_none_size' )?>;
        color: <?=wpx_theme_get_option( 'wpx_theme_search_results_none_color' )?>;
    }

    .search-results .large-header .large-header-inner .large-header-content p {
        font-size: <?=wpx_theme_get_option( 'wpx_theme_search_results_text_size' )?>;
        color: <?=wpx_theme_get_option( 'wpx_theme_search_results_text_color' )?>;
    }

    .search-results .large-header .large-header-inner .large-header-content p strong, .highlight {
        color: <?=wpx_theme_get_option( 'wpx_theme_search_results_highlight' )?>;
    }

    /* End styles for search */

</style>