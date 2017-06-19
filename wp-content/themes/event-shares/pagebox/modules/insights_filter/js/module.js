'use strict';
(function ($) {
    var $window = $(window),
        $thisModule = $(".wpx-m417f0c81");

    $thisModule.each(function (index, el) {
        var $module = $(el),
            $navDropdwon = $module.find('.nav-tabs-dropdown');

        $navDropdwon.on('click', function (e) {
            e.preventDefault();
            $(e.target).toggleClass('show').next('ul').slideToggle(400);
        });

        $('.nav-tabs-wrapper a[data-toggle="tab"]').on('click', function (e) {
            e.preventDefault();
            $(e.target).closest('ul').hide().prev('a').removeClass('show').text($(this).text());

        });
    });
    $thisModule.each(function (index, el) {
        var $module = $(el),
            $textPanel = $module.find('.text-content');

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
        };
    });
})(jQuery);