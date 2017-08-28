/**
 * Created by pgurdek on 27.06.17.
 */
'use strict';

(function ($) {
$('.share-button').one('click', function () {

}).on('click', function () {
    $('.icons').toggleClass('active-share-icons');
    setTimeout(function () {
        // if($('.icons').hasClass('d-none')){
        //     console.log($('.icons').hasClass('d-none'));
        // }
        // else {
        //     console.log($('.icons').hasClass('d-none'));
        //     $('.icons').addClass('d-none');
        // }
        // $('.icons').addClass('d-none');
    },600);
})
})(jQuery);
