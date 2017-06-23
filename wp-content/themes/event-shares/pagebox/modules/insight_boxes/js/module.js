/**
 * Created by pgurdek on 23.06.17.
 */
let moduleClass = '.wpx-mcee07026';

'use strict';
(function ($) {
    console.log('załadowany');

    $(moduleClass).find('.dropdown-item').on('click', function (event) {
        event.preventDefault();

        let $thisModule = $(this).parents(moduleClass),
            $button = $(this).parents('.dropdown').find('.dropdown-button'),
            optionText = $(this).text(),
            optionValue = $(this).attr('data-value'),
            $loading = $thisModule.find('.loading');

        $button.text(optionText);
        $loading.addClass('show');
        $button.attr('data-picked', optionValue);
        sendAjaxData($thisModule);

    });

    $('#insights-post-wrapper').delegate(".pagination-wrapper .page-numbers", 'click', function (event) {
        event.preventDefault();
        if (!$(this).hasClass('current')) {
            $(this).parent().find('.page-numbers').removeClass('current');
            $(this).addClass('current');
            let pagNumber = $(this).find('strong').text();
            let $thisModule = $(this).parents(moduleClass);
            let $loading = $thisModule.find('.loading');
            $loading.addClass('show');
            try {
                pagNumber = parseInt(pagNumber);
                sendAjaxPagination($thisModule, pagNumber);
            } catch (err) {
                console.log(err.message);
            }
        }

    });
    // $('.')

    function sendAjaxPagination($thisModule, paginationNumber = null) {
        let $loading = $thisModule.find('.loading');
        let category = $thisModule.find('.current-category').attr('data-picked');
        let topic = $thisModule.find('.current-topic').attr('data-picked');
        $.ajax({
            url: Ajax.ajax_url,
            type: 'post',
            data: {
                wpx_module: 'Nurture/EventShares/Module/InsightsBoxes',
                action: 'filterInsightsNoPagination',
                cat: category,
                topic: topic,
                paginationNumber: paginationNumber
            }
        })
            .done(function (response) {
                $thisModule.find('.article-boxes-wrapper').html(response);
                removeClass($loading,'show');
            })
            .fail(function (response) {
                removeClass($loading,'show');
            });
    }


    function sendAjaxData($thisModule) {
        let category = $thisModule.find('.current-category').attr('data-picked');
        let topic = $thisModule.find('.current-topic').attr('data-picked');
        let $loading = $thisModule.find('.loading');
        $.ajax({
            url: Ajax.ajax_url,
            type: 'post',
            data: {
                wpx_module: 'Nurture/EventShares/Module/InsightsBoxes',
                action: 'filterInsights',
                cat: category,
                topic: topic
            }
        })
            .done(function (response) {
                $thisModule.find('.article-boxes-wrapper').html(response);
                removeClass($loading,'show');
            })
            .fail(function (response) {
                console.log(response);
                removeClass($loading,'show');
            });
    }

    function removeClass(element,classToRemove) {
        setTimeout(function() {
            element.removeClass(classToRemove);
        }, 300);
    }

})(jQuery);
