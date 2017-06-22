/**
 * Created by pgurdek on 15.06.17.
 */
'use strict';
(function ($) {

    /* TEMPORARY TO DO
     To keep data after mail (no page reloading) is sent keep commented out this:
     // if ( 'mail_sent' == data.status ) {
     // 	$form.each( function() {
     // 		this.reset();
     // 	} );
     // }
     from :
     wp-content/plugins/contact-form-7/includes/js/scripts.js

     */

    var $window = $(window),
        $thisModule = $(".wpx-m34105d4d");
    var $flipContainer = $thisModule.find('.flip-container');
    var failCounter = 0;
    var front = $thisModule.find('.front').height();
    var backMinWidthMobile = $window.width();
    var additionalHeight = 150;

    minFlipperHeight();
    // minBackMobileWidth();

    $window.resize(function () {
        front = $thisModule.find('.front').height();
        minFlipperHeight();

        // if
    });

    $(document).on('spam.wpcf7', function () {
        console.log('submit.wpcf7 was triggered!');
        addHeight();

    });

    $(document).on('invalid.wpcf7', function () {
        console.log('invalid.wpcf7 was triggered!');
        addHeight();

    });

    $(document).on('mailsent.wpcf7', function (data) {
        addHeight();
        flipContact();
    });


    $(document).on('mailfailed.wpcf7', function () {
        console.log('mailfailed.wpcf7 was triggered!');
        addHeight();

    });

    function minFlipperHeight() {
        $($thisModule).find('.flipper').css({
            'min-height': front
        });
    }
    function minBackMobileWidth() {
        $($thisModule).find('.back').css({
            'min-width': backMinWidthMobile
        });
    }
    function flipContact() {
        $flipContainer.addClass('hover').delay(5000).queue(function () {
            $(this).removeClass("hover").dequeue();
        });
    }

    function addHeight() {
        var $containerHeight = $flipContainer.height() + additionalHeight;
        if (failCounter === 0) {
            $thisModule.css({
                // 'min-height': $containerHeight + "px"
            })
        }
    }

})(jQuery);
