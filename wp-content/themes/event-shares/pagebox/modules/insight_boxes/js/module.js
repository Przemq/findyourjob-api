/**
 * Created by pgurdek on 23.06.17.
 */
let moduleClass = '.wpx-mcee07026';

'use strict';
(function ($) {

    let $thisModule = $(moduleClass);
    let $loading = $thisModule.find('.loading');
    let options = {
        byRow: true,
        property: 'height',
        target: null,
        remove: false
    };

    makeEquals(options);

    // Click on dropdown menu
    $thisModule.find('.dropdown-item').on('click', function (event) {
        event.preventDefault();

        let $button = $(this).parents('.dropdown').find('.dropdown-button'),
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
        let timeline = $(this).attr('data-category');
        $loading.addClass('show');
        sendAjaxPagination($thisModule, null, timeline);

    });
    $('#insights-post-wrapper').delegate(".pagination-wrapper a ", 'click', function (event) {
        event.preventDefault();
        if (!$(this).hasClass('current')) {
            $(this).parent().find('.page-numbers').removeClass('current');
            $(this).addClass('current');
            let pagNumber;
            let href = this.href;
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
        let dropdown = $(this).parent().find('.nav-tabs-wrapper');
        dropdown.toggleClass('nav-mobile-show');


    });


    function sendAjaxPagination($thisModule, paginationNumber = 1, timeline = null) {
        let $loading = $thisModule.find('.loading');
        let category = $thisModule.find('.current-category').attr('data-picked');
        let topic = $thisModule.find('.current-topic').attr('data-picked');
        let nothingFoundText = $thisModule.find('#nothingFound').val();
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
                makeEquals(options);
                removeClass($loading, 'show');
            })
            .fail(function (response) {
                removeClass($loading, 'show');
            });
    }


    function removeClass(element, classToRemove ,time = 300) {
        setTimeout(function () {
            element.removeClass(classToRemove);
        }, time);
    }

    // Function to change img svg to svg (after ajax request)
    function changeToSVG() {

        // Polyfill to support all ye old browsers
        // delete when not needed in the future
        if (!String.prototype.endsWith) {
            String.prototype.endsWith = function (searchString, position) {
                let subjectString = this.toString();
                if (typeof position !== 'number' || !isFinite(position) || Math.floor(position) !== position || position > subjectString.length) {
                    position = subjectString.length;
                }
                position -= searchString.length;
                let lastIndex = subjectString.lastIndexOf(searchString, position);
                return lastIndex !== -1 && lastIndex === position;
            };
        } // end polyfill

        // Another snippet to support IE11
        String.prototype.endsWith = function (pattern) {
            let d = this.length - pattern.length;
            return d >= 0 && this.lastIndexOf(pattern) === d;
        };
        // End snippet to support IE11

        // Check to see if user set alternate class
        let target = ( cssTarget !== 'img.' ? cssTarget : 'img.style-svg' );

        $(target).each(function (index) {
            let $img = jQuery(this);
            let imgID = $img.attr('id');
            let imgClass = $img.attr('class');
            let imgURL = $img.attr('src');

            if (!imgURL.endsWith('svg')) {
                return;
            }

            $.get(imgURL, function (data) {

                // Get the SVG tag, ignore the rest
                let $svg = $(data).find('svg');

                let svgID = $svg.attr('id');

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
        $thisModule.find('.title-insight').matchHeight(options);
        $thisModule.find('.image-container').matchHeight(options);
    }


})(jQuery);
