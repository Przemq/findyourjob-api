/**
 * Created by pgurdek on 27.06.17.
 */
'use strict';

(function ($) {
    let moduleClass = '.wpx-m082d6957';
    let $thisModule = $(moduleClass);
    if ($(window).width() < 992) {
        mobileActiveLink();
    }

    function mobileActiveLink() {
        $thisModule.find('.main-link').click(function (e) {
            e.preventDefault();
            let liContainer = $(this).parent();
            if ($(liContainer).hasClass('sub-on')){
                $(liContainer).removeClass('sub-on');
            }else{
                $(liContainer).addClass('sub-on');
            }
        });
    }
})(jQuery);
