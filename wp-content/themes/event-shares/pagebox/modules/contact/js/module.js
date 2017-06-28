/**
 * Created by pgurdek on 15.06.17.
 */
'use strict';
(function ($) {

    let $window = $(window),
        $thisModule = $(".wpx-m34105d4d");
    let $flipContainer = $thisModule.find('.flip-container');
    let front = $thisModule.find('.front').height();

    $window.resize(function () {
        front = $thisModule.find('.front').height();
    });

    $($thisModule).find('.wpcf7-submit').on('click', function (e) {
        let form = $($thisModule).find('form');
        let formSearialized = $(form).serializeArray();
        console.log(formSearialized);
        $(document).on('mailsent.wpcf7', function () {
            if ($(window).width() < 960) {

                flipContactMobile();
            }
            else {
                flipContact();
            }
            setTimeout(
                function () {
                    $(formSearialized).each(function (index, input) {
                        if (typeof input.name !== 'undefined' && typeof input.value !== 'undefined') {
                            $('input[name="' + input.name + '"]').val(input.value);
                            $('select[name="' + input.name + '"]').find('option[value="'+input.value+'"]').prop('selected',true);
                        }
                    });
                }, 500);
        });
    });


    function flipContact() {
        $flipContainer.addClass('hover').delay(5000).queue(function () {
            $(this).removeClass("hover").dequeue();
        });
    }

    function flipContactMobile() {
        let tempHeight = $flipContainer.outerHeight();
        let $backFlipModule = $flipContainer.find('.back');
        let backFlipModuleHeight = $backFlipModule.outerHeight();
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

})(jQuery);
