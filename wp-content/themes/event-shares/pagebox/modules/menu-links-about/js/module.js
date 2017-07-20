/**
 * Created by pgurdek on 27.06.17.
 */
'use strict';

(function ($) {
    let moduleClass = '.wpx-m082d6957';
    let $thisModule = $(moduleClass);
    $thisModule.find('.main-link').click(function (e) {
        let liContainer = $(this).parent();
        if ($(window).width() < 992) {
        e.preventDefault();
            if ($(liContainer).hasClass('sub-on')) {
                $(liContainer).removeClass('sub-on');
            } else {
                $(liContainer).addClass('sub-on');
            }
    }
    });

    var delay = debounce(function () {
    }, 0);

    setTimeout(delay(), 500);
    window.addEventListener('resize', delay);
    /**
     * Debounce function. Really important to use when working with for example resize or scroll to not fire event
     * every time when you scroll or resize.
     * https://davidwalsh.name/javascript-debounce-function
     * @returns {Function}
     */
    function debounce(func, wait, immediate) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var later = function () {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }


})(jQuery);
