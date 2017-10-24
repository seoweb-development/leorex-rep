// $ = jQuery.noConflict();
jQuery(document).ready(function () {
 $ = jQuery.noConflict();

   $('.ui-loader').remove();/*remove default jq mobile loader vidget*/

    Controller.init();
});

var Controller ={
    init:function () {
        // this.touchClick();
this.linksMobileClick();
this.openCardMenuMobile();
this.toutchProcessing();
this.accordionOpenClose();
this.hamburgerClick();
this.sliderMouseDown();
this.pageResizeProcessing();
this.slickSlider();
this.slickSliderMobileClicker();
this.slickReviewsSlider();
this.contentTextParse();
this.contentTextParseReadMore();
this.readMoreOpenClose();
this.quantityInputClickRepire();
this.addQuamtityValueToHeaderIcon();
this.openCloseFastCheckout();
this.tabsOpenClose();
this.reviewsTabsReadMoreOpen();
this.reviewsTabsReadMoreClose();
this.repireSelectOptionBoxAddHtml();
this.openCloseNewSelectBoxBody();
this.newSelectElementOneElementSelect();
this.cardShowDesktop();
this.removeFromCard();
        if( parseFloat($(document).width())>= 1020) {
            this.cardBuildAfterAddProduct();
        }
this.shopingContinue();
this.quantityInputClickMobileRepire();
this.numInputChange();

    },
   touchClick:function () {
       $('body').on('click, touchstart', '*', function (event) {
           if('ontouchstart'in window){
               $(event.target).trigger('touchstart')
               return false;
           }
           else{
               $(event.target).trigger('click')
               return false;
           }


       })


   },

    openCardMenuMobile:function () {
        $('body').on('click touchstart', '.xoo-wsc-close ',function (e) {
           // if( parseFloat($(document).width())< 1020) {
               $(e.target).click();
           // }
        })
    },

    accordionOpenClose:function () {
        $('.site-footer').on(Controller.CLICK,'.accordion_oppener', function () {
            var openCloseObject = {
                that:$(this),
                arrow :$(this).find('.accordion_arrow')
            },
            open = openCloseObject.arrow.hasClass('oppened');

            if(open){
                UI.accordionClose(openCloseObject);
                return;
            }
            UI.accordionOpen(openCloseObject);
            $('.comtact_us_title.open_contact').click();
        })
    },
    hamburgerClick:function() {
        $('body').on(Controller.CLICK,'.hamburger', function(){
            console.log('click');
          var that = $(this);
            UI.openMenu(that);
            UI.headerChange(that);
        })


    },
    toutchProcessing:function () {
         if('ontouchstart'in window){

                 Controller.UP   = 'touchend';
                 Controller.DOWN = 'touchstart';
                 Controller.MOVE = 'touchmove';
                 Controller.CLICK = 'touchstart';
                 $('body').addClass('touched');

         }else{
                Controller.UP   = 'mouseup';
                Controller.DOWN = 'mousedown';
                Controller.MOVE = 'mousemove';
                Controller.CLICK = 'click';
         }
    },
    sliderMouseDown: function () {


        $('.before_after_container').on(Controller.DOWN, '.slider_button', function () {


            var that = $(this);
            that.addClass('in_process');

            Controller.sliderProcessing(that);
        });
        $(document).on(Controller.UP, function () {/*mouse up (after-before slider function enable)*/
           $('.slider_button').removeClass('in_process') ;
           return false;
        })

    },
    sliderProcessing:function(that){
        $(document).on(Controller.MOVE, function (event) {/*after-before slider SLIDE*/

            if(that.is('.in_process')) {
                UI.sliderProcessing(that, event);
            }
        });
    },
    pageResizeProcessing:function(){
        $( window ).resize(function() {
            if('ontouchstart'in window){
                $('.before_image').css({'width':'90%'});
            } else{
                $('.before_image').css({'width':'72%'});
            }

           // $('.seven_minutes_before').show();
        })
    },
    slickSlider:function () {
        $('.top_sllider_container').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            adaptiveHeight: true
        });
        $('.slick-arrow').hide();
        $('.slick-dots li button').text('');
    },
    slickReviewsSlider:function () {
        $('.testomanials_slider_container').slick({
            dots: true,
            infinite: true,
            speed: 500,
            slidesToShow: 1,
            adaptiveHeight: true
        });
        $('.slick-arrow').hide();
        $('.slick-dots li button').text('');
    },
    slickSliderMobileClicker:function () {
$('#page').on('touchstart','.slick-prev, .slick-next, li[id^=slick-slide]',function (event) {

    $(event.target).click();
})
    },
    contentTextParse:function () {
        var contentHtml =  $('.content_container .content_body .hidden_container p');
        if(contentHtml.size()>0) {
            UI.contentTextParse(contentHtml);
        }
    },
    contentTextParseReadMore:function () {
        var contentHtml =  $('.content_container .content_body_read_more .hidden_container_read_more p');
        if(contentHtml.size()>0) {
            UI.contentTextParseReadMore(contentHtml);
        }
    },
    readMoreOpenClose:function () {
        $('body.home').on( Controller.CLICK,'.read_more, .read_less ', function () {
            var that = $(this);
           UI.readMoreOpenClose(that);
        })
    },
    quantityInputClickRepire:function(){
        $('body').on(Controller.UP,'.quantity .input-text', function(e){
// alert($(this).val())
            $(this).trigger('blur')
            // e.preventDefault()
        })
        // return false;
    },
    quantityInputClickMobileRepire:function(){
        $('body.touched').on('touchstart','.quantity .input-text', function(e){
            var that = $(this);
            UI.quantityInputClickMobileRepire(that);


        })
    },
    numInputChange:function () {
        $('body').on('change','.quantity .input-text',function () {

            UI.numInputChange()
        })
    },
    addQuamtityValueToHeaderIcon:function(){
$('body').on('click touchstart','.single_add_to_cart_button,' +
    ' .xoo-wsc-product .xoo-wsc-img-col .xoo-wsc-remove',function () {
    var that = $(this);
    // $('.xoo-wsc-basket').trigger('click');
    UI.addQuamtityValueToHeaderIcon(that);
})
    },
    openCloseFastCheckout:function () {
       UI.openCloseFastCheckout()
    },

    tabsOpenClose:function () {
        $('body').on(Controller.CLICK, '.tabs_container .one_tab .one_tab_header',function () {
            var that = $(this);
            UI.tabsOpenClose(that);
        })
    },
    reviewsTabsReadMoreOpen:function () {
        $('body').on(Controller.CLICK, '.tabs_container .one_tab.reviews_tab .one_tab_body .one_review .one_review_read_more',function () {
            var that = $(this);


            UI.reviewsTabsReadMoreOpen(that);
        })
    },
    reviewsTabsReadMoreClose:function () {
        $('body').on(Controller.CLICK, '.tabs_container .one_tab.reviews_tab .one_tab_body .one_review .reviews_text_read_less',function () {
            var that = $(this);


            UI.reviewsTabsReadMoreClose(that);
        })
    },
    repireSelectOptionBoxAddHtml:function(){
        if($('body.single-product').size()>0 && 'ontouchstart'in window){
            UI.repireSelectOptionBoxAddHtml();
        }
    },
    openCloseNewSelectBoxBody:function () {
        $('body.single-product').on(Controller.CLICK, '.select_new_box .select_val',function () {
            var that = $(this),
                bodyElement = that.closest('.select_new_box').find('.box_body'),
                statusElement = bodyElement.is(':visible');
            UI.openCloseNewSelectBoxBody(that, bodyElement, statusElement)
        })
    },
    newSelectElementOneElementSelect:function(){
        $('body.single-product').on(Controller.CLICK, '.select_new_box .box_body .one_option',function () {
            var that = $(this),
                currentSelect = $('#packege'),
                bodyElement = that.closest('.box_body'),
                inputElement = bodyElement.siblings('.box_header').find('.select_val .text_element');
                UI.newSelectElementOneElementSelect(that,currentSelect, bodyElement, inputElement)
        })

    },
    cardShowDesktop:function () {
           var card = $('body .xoo-wsc-container');
           // UI.cardShowDesktop(card);
    },
    shopingContinue:function() {
        $('body:not(.mobile)').on('click', '.xoo-wsc-container .xoo-wsc-cont, .hide_screen_box', function () {
            $('.hide_screen_box').remove();
            if($(this).is('.hide_screen_box')) {
                $('.flaticon-business.desktop ').click();
            }else{
                $('.flaticon-business.desktop ').click().click();
            }

        })
    },

    removeFromCard:function () {
        $('body').on('click','.new_remove', function () {
            $(this).parents('.xoo-wsc-product').find('.xoo-wsc-remove').click();
              var del = true

           $(document).ajaxComplete(function () {
               if(del) {
                   var cardCount = $('body:not(.mobile) .xoo-wsc-active .xoo-wsc-container .xoo-wsc-product').size();
                   $('.flaticon-business.desktop .header-cart-count ').text(cardCount);
                   $('.flaticon-business.desktop .header-cart-count ').click();
                   $('.hide_screen_box').remove();
                   del = false
                   return false
               }

           })

        })
    },
    cardBuildAfterAddProduct:function(){
        $('body').on( 'mousedown touchstart','.single_add_to_cart_button', function () {

            var cardWatcherInterval = setInterval(function () {
                if( $('.xoo-wsc-container:visible').size()>0){
                    clearInterval(cardWatcherInterval);
                    UI.cardShowDesktop($('body .xoo-wsc-active .xoo-wsc-container'),false)
                }
            },500)

        })

    },
    linksMobileClick:function () {
        $('body').on('mousedown touchstart','a',function (e) {
            if($('body').is('.touched'))
            {
                e.preventDefault()
                var href = $(this).attr('href')
                window.location.assign(href);
            }
            // $(e.target).trigger('click');
            // var originalFunc = jQuery.Event.prototype.preventDefault;
            // return function(){
            //     if($(this.target).hasClass('disableDefault')) {return;}
            //     originalFunc.call(this);
            // }
// $(e.target).click();
        })
    },





};