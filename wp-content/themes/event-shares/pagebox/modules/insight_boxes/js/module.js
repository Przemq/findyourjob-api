/**
 * Created by pgurdek on 23.06.17.
 */
var moduleClass = '.wpx-mcee07026';

'use strict';
(function ($) {

    var $thisModule = $(moduleClass);
    var $loading = $thisModule.find('.loading');
    var options = {
        byRow: true,
        property: 'height',
        target: null,
        remove: false
    };

    makeEquals(options);

    // Click on dropdown menu
    $thisModule.find('.dropdown-item').on('click', function (event) {
        event.preventDefault();

        var $button = $(this).parents('.dropdown').find('.dropdown-button'),
            optionText = $(this).text(),
            optionValue = $(this).attr('data-value');

        $button.text(optionText);
        $loading.addClass('show');
        $button.attr('data-picked', optionValue);
        sendAjaxPagination($thisModule);

    });

    // Click on nav example Advisor Media
    $thisModule.find('.nav-tabs-wrapper a').on('click', function (event) {
        event.preventDefault();
        var timeline = $(this).attr('data-category');
        $loading.addClass('show');
        sendAjaxPagination($thisModule, null, timeline);

    });

    //submenu click
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

    $('#insights-post-wrapper').delegate(".pagination-wrapper a ", 'click', function (event) {
        event.preventDefault();
        if (!$(this).hasClass('current')) {
            $(this).parent().find('.page-numbers').removeClass('current');
            $(this).addClass('current');
            var pagNumber;
            var href = this.href;
            pagNumber = href.match(/([^\/]*)\/*$/)[1];
            $loading.addClass('show');
            try {
                pagNumber = parseInt(pagNumber);
                sendAjaxPagination($thisModule, pagNumber);
            } catch (err) {
                console.log(err.message);
            }
        }

    });

    $thisModule.find('.mob-nav').on('click', function (event) {
        event.preventDefault();
        var dropdown = $(this).parent().find('.nav-tabs-wrapper');
        dropdown.toggleClass('nav-mobile-show');


    });


    function sendAjaxPagination($thisModule, paginationNumber, timeline) {
        paginationNumber = !!paginationNumber ? paginationNumber : 1;
        timeline = !!timeline ? timeline : null;
        var $loading = $thisModule.find('.loading');
        var category = $thisModule.find('.current-category').attr('data-picked');
        var topic = $thisModule.find('.current-topic').attr('data-picked');
        var nothingFoundText = $thisModule.find('#nothingFound').val();
        if (timeline === null) {
            timeline = $thisModule.find('.nav-tabs-wrapper a.active').attr('data-category');
        }

        $.ajax({
            url: Ajax.ajax_url,
            type: 'post',
            data: {
                wpx_module: 'Nurture/EventShares/Module/InsightsBoxes',
                action: 'filterInsights',
                cat: category,
                timeline: timeline,
                topic: topic,
                paginationNumber: paginationNumber,
                nothingFoundText: nothingFoundText
            }
        })
            .done(function (response) {
                $thisModule.find('.article-boxes-wrapper').html(response);
                changeToSVG();
                removeClass($loading, 'show');
                updateEquals(options)
            })
            .fail(function (response) {
                removeClass($loading, 'show');
            });
    }


    function removeClass(element, classToRemove ,time) {
        time = !!time ? time : 300;
        setTimeout(function () {
            element.removeClass(classToRemove);
        }, time);
    }

    // Function to change img svg to svg (after ajax request)
    function changeToSVG() {

        // Polyfill to support all ye old browsers
        // devare when not needed in the future
        if (!String.prototype.endsWith) {
            String.prototype.endsWith = function (searchString, position) {
                var subjectString = this.toString();
                if (typeof position !== 'number' || !isFinite(position) || Math.floor(position) !== position || position > subjectString.length) {
                    position = subjectString.length;
                }
                position -= searchString.length;
                var lastIndex = subjectString.lastIndexOf(searchString, position);
                return lastIndex !== -1 && lastIndex === position;
            };
        } // end polyfill

        // Another snippet to support IE11
        String.prototype.endsWith = function (pattern) {
            var d = this.length - pattern.length;
            return d >= 0 && this.lastIndexOf(pattern) === d;
        };
        // End snippet to support IE11

        // Check to see if user set alternate class
        var target = ( cssTarget !== 'img.' ? cssTarget : 'img.style-svg' );

        $(target).each(function (index) {
            var $img = jQuery(this);
            var imgID = $img.attr('id');
            var imgClass = $img.attr('class');
            var imgURL = $img.attr('src');

            if (!imgURL.endsWith('svg')) {
                return;
            }

            $.get(imgURL, function (data) {

                // Get the SVG tag, ignore the rest
                var $svg = $(data).find('svg');

                var svgID = $svg.attr('id');

                // Add replaced image's ID to the new SVG if necessary
                if (typeof imgID === 'undefined') {
                    if (typeof svgID === 'undefined') {
                        imgID = 'svg-replaced-' + index;
                        $svg = $svg.attr('id', imgID);
                    } else {
                        imgID = svgID;
                    }
                } else {
                    $svg = $svg.attr('id', imgID);
                }

                // Add replaced image's classes to the new SVG
                if (typeof imgClass !== 'undefined') {
                    $svg = $svg.attr('class', imgClass + ' replaced-svg svg-replaced-' + index);
                }

                // Remove any invalid XML tags as per http://validator.w3.org
                $svg = $svg.removeAttr('xmlns:a');

                // Replace image with new SVG
                $img.replaceWith($svg);

                $(document).trigger('svg.loaded', [imgID]);

            }, 'xml');
        });
    }

    function makeEquals(options) {
        $thisModule.find('.content-wrapper').matchHeight(options);
        // $thisModule.find('.image-container').matchHeight(options);
    }

    function updateEquals(options,time) {
        time = !!time ? time : 100;
        setTimeout(function () {
            $thisModule.find('.content-wrapper').matchHeight('remove').matchHeight(options);
        }, time);
    }

})(jQuery);
