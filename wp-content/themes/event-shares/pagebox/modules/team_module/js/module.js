/**
 * Created by pgurdek on 15.06.17.
 */
'use strict';
(function ($) {

    // $('.team-nav a').click(function (e) {
    //     e.preventDefault();
    //     console.log($(this));
    //     $(this).tab('show');
    // })
    $('a[data-toggle="tab"]').click( function (e) {
        var target = $(this).attr('href');
        $('.tab-pane').removeClass('active').removeClass('show');
        $('.team-nav .nav-link').removeClass('active').removeClass('show');

        console.log(target);

    })
})(jQuery);
