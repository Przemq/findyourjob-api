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
    })
})(jQuery);
