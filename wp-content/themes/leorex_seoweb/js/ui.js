var UI = {

    accordionOpen:function(openCloseObject){
        var arrow = openCloseObject.arrow,
            hiddenBox = openCloseObject.that.closest('.accordion_one_box').find('.accordion_one_box_body:hidden'),
            arrowsOppened = $j('.accordion_container .accordion_arrow.oppened'),
            openBoxes = $j('.accordion_container .accordion_one_box_body:not(:hidden)');

        arrowsOppened.removeClass('oppened');
        hiddenBox.slideDown(500);
        openBoxes.slideUp(500);
        arrow.addClass('oppened')
    },
    accordionClose:function(openCloseObject){
        var arrow = openCloseObject.arrow,
            oppenBox = openCloseObject.that.closest('.accordion_one_box').find('.accordion_one_box_body:not(:hidden)');
        oppenBox.slideUp(500);
        arrow.removeClass('oppened');
    }
}