/**
 * Created by pgurdek on 27.06.17.
 */
'use strict';

(function ($) {
    $('.toggle-icons').one('click', function () {

    }).on('click', function () {
        $('.icons').toggleClass('active-share-icons');
    });

    $('.copyLink').on('click', function (e) {
        e.preventDefault();
        $('.copyLinkText').slideToggle(400);
    });

    function debounce(func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                timeout = null;
                if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    }

    var setVideoSize = debounce(function() {
        var win = $(this); //this = window
        if (win.width() <768) {
            var width = $('.video-container').width();
            var height = (9 * width) / 16;
            var iframe = $('#video-iframe');
            iframe.css('height', height);
        }
    }, 10);

    $(window).on('resize', setVideoSize);
    $(window).on('load', setVideoSize);

})(jQuery);
