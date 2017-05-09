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

<header>
    header placeholder

    <nav>
		<?= wp_nav_menu([
			'menu' => 'header',
			'container' => false
		]);
		?>
    </nav>
</header>