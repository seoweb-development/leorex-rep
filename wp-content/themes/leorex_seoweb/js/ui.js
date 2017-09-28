$j = jQuery.noConflict();
var UI = {
    globalObject:{
        menu:$j('.mobile_menu_panel')
    },
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
    },
    openMenu:function(that){
        //var menu = $j('.mobile_menu_panel')
        if (UI.globalObject.menu.hasClass('open_menu')){
            UI.globalObject.menu.removeClass('open_menu')
        } else {
            UI.globalObject.menu.addClass('open_menu')
        }
    },
    headerChange:function(that){
        var hamburger = $j('.hamburger');
        var cartIcon = $j('.flaticon-business');
        var headeLogo = $j('.logo_container');
        if (UI.globalObject.menu.hasClass('open_menu')){
            cartIcon.addClass('open_menu');
            hamburger.addClass('open_menu');
            headeLogo.addClass('open_menu');
        } else {
            cartIcon.removeClass('open_menu');
            hamburger.removeClass('open_menu');
            headeLogo.removeClass('open_menu');
        }
    }

}