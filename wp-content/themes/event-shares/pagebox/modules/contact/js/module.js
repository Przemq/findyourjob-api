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

    $window.resize(function () {
        front = $thisModule.find('.front').height();
    });


    $(document).on('spam.wpcf7', function () {
        console.log('submit.wpcf7 was triggered!');

    });

    $(document).on('invalid.wpcf7', function () {
        console.log('invalid.wpcf7 was triggered!');

    });

    $(document).on('mailsent.wpcf7', function (data) {
        if ($(window).width() < 960) {
            flipContactMobile();
        }
        else {
            flipContact();
        }
    });


    $(document).on('mailfailed.wpcf7', function () {
        console.log('mailfailed.wpcf7 was triggered!');

    });

    function flipContact() {
        $flipContainer.addClass('hover').delay(5000).queue(function () {
            $(this).removeClass("hover").dequeue();
        });
    }

    function flipContactMobile() {
        var tempHeight = $flipContainer.outerHeight();
        var $backFlipModule = $flipContainer.find('.back');
        var backFlipModuleHeight = $backFlipModule.outerHeight();
        console.log(tempHeight);
        $flipContainer
            .addClass('hover')
            .css({
                'height': backFlipModuleHeight
            }).scrollTop(function () {
            $('body').animate({
                    scrollTop: $($backFlipModule).offset().top - 50
                },
                'slow')
        }).delay(5000).queue(function () {
            $(this).removeClass("hover").dequeue();
            $(this).css({
                'height': 'auto'
            })
        });
    }


    function minFlipperHeight() {
        $($thisModule).find('.flip-container').css({
            'min-height': front
        });
    }

    function minBackMobileWidth() {
        $($thisModule).find('.back').css({
            'min-width': backMinWidthMobile
        });
    }


    function addHeight() {
        var $containerHeight = $flipContainer.height() + additionalHeight;
        if (failCounter === 0) {
            $thisModule.css({
                'min-height': $containerHeight + "px"
            })
        }
    }

})(jQuery);
