/**
 * Created by pgurdek on 15.06.17.
 */
'use strict';
(function ($) {


    $('a[data-toggle="team-tab"]').click(function (e) {
        e.preventDefault();
        var maximum = getMaxSize();
        ClearSpace();
        $(this).addClass('active');
        var $row = $(this).parent();
        var $rowDataSize = parseInt($row.attr('data-size')) + 1;
        var $tabTeamPanel = $row.find('.tab-team-panel');
        $tabTeamPanel.addClass('active show');
        var $tabTeamHeight = $(this).parent().find('.tab-team-panel').outerHeight()+15;

        // Add padding bottom if last element
        if ($rowDataSize-1 === maximum ){
            $('.team-member[data-size="'+maximum+'"]').css({
                'padding-bottom': $tabTeamHeight + 'px'
            });
        }else{
            //Add padding top if not last element
            $('.team-member[data-size="'+$rowDataSize+'"]').css({
                'padding-top': $tabTeamHeight + 'px'
            });
        }

    });

    function getMaxSize() {
        var maximum = 0;
        $('.team-member').each(function() {
            var value = parseFloat($(this).attr('data-size'));
            maximum = (value > maximum) ? value : maximum;
        });
        return maximum
    }

    function ClearSpace() {
        $('.tab-team-panel').removeClass('active').removeClass('show');
        $('.team-member .nav-link').removeClass('active').removeClass('show');
        $('.team-member').css({
            'padding-top':'0px',
            'padding-bottom':'0px'
        });
    }

})(jQuery);
