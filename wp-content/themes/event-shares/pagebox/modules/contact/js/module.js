/**
 * Created by pgurdek on 15.06.17.
 */
'use strict';
(function ($) {
    var $window = $(window),
        $thisModule = $(".wpx-m34105d4d");
    var $flipContainer = $thisModule.find('.flip-container');
    var failCounter = 0;
    var additionalHeight = 150;

    function flipContact() {
        $flipContainer.addClass('hover').delay(3000).queue(function () {
            $(this).removeClass("hover").dequeue();
        });
    }

    function addHeight() {
        var $containerHeight = $flipContainer.height()+additionalHeight;
        if (failCounter===0){
            console.log('dodaje');
            $thisModule.css({
                'min-height':$containerHeight+"px"
            })
        }
    }

    $(document).on('spam.wpcf7', function () {
        console.log('submit.wpcf7 was triggered!');
        addHeight();

    });

    $(document).on('invalid.wpcf7', function () {
        console.log('invalid.wpcf7 was triggered!');
        addHeight();

    });

    $(document).on('mailsent.wpcf7', function () {
        console.log('mailsent.wpcf7 was triggered!');
        addHeight();
        flipContact();

    });


    $(document).on('mailfailed.wpcf7', function () {
        console.log('mailfailed.wpcf7 was triggered!');
        addHeight();

        // flipContact();
    });

    // flipContact();


})(jQuery);