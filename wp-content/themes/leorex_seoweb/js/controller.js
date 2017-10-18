// $ = jQuery.noConflict();
jQuery(document).ready(function () {
 $ = jQuery.noConflict();

   $('.ui-loader').remove();/*remove default jq mobile loader vidget*/

    Controller.init();
});

var Controller ={
    init:function () {
        // this.touchClick();
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
        $('body').on('touchstart', '.flaticon-business.mobile, .xoo-wsc-close ',function (e) {
            $(e.target).click();
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
        $('.quantity .input-text').mouseup(function(){
            $(this).trigger('blur')})
    },
    addQuamtityValueToHeaderIcon:function(){
$('body').on(Controller.CLICK,'.single_add_to_cart_button,' +
    ' .xoo-wsc-product .xoo-wsc-img-col .xoo-wsc-remove',function () {
    var that = $(this);
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
    }


};