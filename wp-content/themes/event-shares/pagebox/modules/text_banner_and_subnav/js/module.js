'use strict';
(function ($) {
    let $window = $(window),
        $thisModule = $(".wpx-mf3f354e1");


    $($thisModule).find('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        let target = $(this).attr('href');
        $(target).css('left','-'+$(window).width()+'px');
        let left = $(target).offset().left;
        $(target).css({left:left}).animate({"left":"0px"}, "400");
    })


    // $thisModule.each(function (index, el) {
    //     var $module = $(el),
    //         $navDropdwon = $module.find('.nav-tabs-dropdown');
    //
    //     $navDropdwon.on('click', function (e) {
    //         e.preventDefault();
    //         $(e.target).toggleClass('show').next('ul').slideToggle(400);
    //     });
    //
    //     $('.nav-tabs-wrapper a[data-toggle="tab"]').on('click', function (e) {
    //         e.preventDefault();
    //         $(e.target).closest('ul').hide().prev('a').removeClass('show').text($(this).text());
    //
    //     });
    // });

})(jQuery);