<?php
/**
 * Created by Tomasz Pach.
 * Date: 6.04.2017
 * Time: 3:00 AM
 */

/**
 * This requires script added into header to make correct redirects.
 * match = pathName.match(/^\/(?:(uk|ie|je|rw)\/)(?:(charities|private-client|financial-adviser|professional-advisers))?(.*)/i);
 * Variable 'match' have to be changed to used countries and investors below (data-country & data-profile)
 */

$accept = !empty (get_option('modal_accept')) ? (get_option('modal_accept')) : 'Accept Terms & Conditions';
$button = !empty (get_option('modal_button')) ? (get_option('modal_button')) : 'Accept and proceed';
$modalDisclaimer = !empty (get_option( 'modal_disclaimer' )) ? (get_option( 'modal_disclaimer' )) : 'Please fill modal disclaimer in WPX theme options';
?>

<div id="investor-modal" class="modal-container-overlay country-investor">
    <div class="modal-container">
        <div class="modal">
            <div class="col-lg-12 col-xs-12">
                <div class="close hidden-lg-up"></div>
                <img class="logo-image" src="<?php echo THEME_IMAGES_URI; ?>/QClogo.svg"
                     alt="Quilter Logo">
            </div>
            <form method="post">
                <div class="pull-left col-lg-4 col-md-4 col-sm-12 select-country">
                    <h2>Select Your Country</h2>
                    <ul>
                        <li><a href="#" data-country="uk">United Kingdom</a></li>
                        <li><a href="#" data-country="ie">Ireland</a></li>
                        <li><a href="#" data-country="je">Jersey</a></li>
                        <li><a href="#" data-country="uk">Other countries</a></li>
                    </ul>
                </div>
                <div class="pull-left col-lg-4 col-md-4 col-sm-12 select-profile">
                    <h2>Select Your Profile</h2>
                    <ul>
                        <li><a href="#" data-profile="private-client">Private Clients</a></li>
                        <li><a href="#" data-profile="financial-adviser">Financial Advisers</a></li>
                        <li><a href="#" data-profile="charities">Charities</a></li>
                        <li><a href="#" data-profile="professional-advisers">Professional Advisers</a></li>
                    </ul>
                </div>
                <div class="pull-left col-lg-4 col-md-4 col-sm-12 disclaimer">
                    <h2>Disclaimer</h2>
                    <p> <?= $modalDisclaimer ?></p>
                    <label>
                        <input type="checkbox" class="accept-terms"/>
                        <?= $accept; ?>

                    </label>
                    <input disabled="disabled" class="btn darken" value="<?= $button; ?>"/>
                </div>
            </form>
        </div>
    </div>
</div>