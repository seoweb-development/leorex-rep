$ = jQuery.noConflict();



var UI = {
    globalObject:{
        menu:$('.mobile_menu_panel'),
        sliderEnable:false
    },
    accordionOpen:function(openCloseObject){
        var arrow = openCloseObject.arrow,
            hiddenBox = openCloseObject.that.closest('.accordion_one_box').find('.accordion_one_box_body:hidden'),
            arrowsOppened = $('.accordion_container .accordion_arrow.oppened'),
            openBoxes = $('.accordion_container .accordion_one_box_body:not(:hidden)');

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
    openMenu:function(){
        //var menu = $('.mobile_menu_panel')
        if (UI.globalObject.menu.hasClass('open_menu')){
            UI.globalObject.menu.removeClass('open_menu')
        } else {
            UI.globalObject.menu.addClass('open_menu')
        }
    },
    headerChange:function(){
        var hamburger = $('.hamburger');
        var cartIcon = $('.flaticon-business');
        var headeLogo = $('.logo_container');
        if (UI.globalObject.menu.hasClass('open_menu')){
            cartIcon.addClass('open_menu');
            hamburger.addClass('open_menu');
            headeLogo.addClass('open_menu');
        } else {
            cartIcon.removeClass('open_menu');
            hamburger.removeClass('open_menu');
            headeLogo.removeClass('open_menu');
        }
    },
    sliderProcessing:function (that, event) {
        var pX;
        if(event.originalEvent.touches !== undefined){
            var touch = event.originalEvent.touches[0];
            pX = touch.pageX

        }else{
            pX = event.clientX;
        }


        var movingContainer = that.parents('.before_image'),
            // target = $(event.target),
            mousePositionX =parseInt(pX),
            // movingContainerWidht = parseInt(movingContainer.width()) ,
            containerWidth = parseInt(movingContainer.parents('.before_after_container').width()),
            newPosition = containerWidth - mousePositionX ,
            slidePercend = (newPosition/containerWidth)*100;
if(mousePositionX >=0) {

    movingContainer.css({'width': newPosition + 'px'});
    // if(slidePercend<=40){
    //     $('.seven_minutes_before:not(:hidden)').hide();
    // }else{
    //     $('.seven_minutes_before:hidden').show();
    // }
}
    },
    contentTextParse:function (contentHtml) {
        var contentSize, firstContainer, secondContainer, firstContainerSize, counter = 1
        contentSize = parseInt(contentHtml.size());
        firstContainerSize = Math.ceil(contentSize/2);
        $.each(contentHtml,function (key , val) {
            if(counter<=firstContainerSize){
                $('.text_box_left') .append(val);
                counter++;
            }else {
                $('.text_box_rigth') .append(val);
            }

        })
        // console.log(firstContainerSize);
    }

};
