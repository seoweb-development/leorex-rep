// $ = jQuery.noConflict();
jQuery(document).ready(function () {
 $ = jQuery.noConflict();

   $('.ui-loader').remove();/*remove default jq mobile loader vidget*/

    Controller.init();
})

var Controller ={
    init:function () {
this.toutchProcessing();
this.accordionOpenClose();
this.hamburgerClick();
this.sliderMouseDown();


    },


    accordionOpenClose:function () {
        $('.site-footer').on(Controller.CLICK,'.accordion_oppener', function () {
            var openCloseObject = {
                that:$(this),
                arrow :$(this).find('.accordion_arrow'),
            },
            open = openCloseObject.arrow.hasClass('oppened')

            if(open){
                UI.accordionClose(openCloseObject);
                return;
            }
            UI.accordionOpen(openCloseObject);

        })
    },
    hamburgerClick:function() {
        $('body').on(Controller.CLICK,'.hamburger', function(){
            console.log('click');
            that = $(this);
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


        $('.before_after_container').on(Controller.DOWN, '.slider_button', function (e) {


            var that = $(this);
            that.addClass('in_process')

            Controller.sliderProcessing(that);
        })
        $(document).on(Controller.UP, function () {
            // alert('hjkhjkh');
           $('.slider_button').removeClass('in_process') ;
           return false;
        })

    },
    sliderProcessing:function(that){
        $(document).on(Controller.MOVE, function (event) {

            if(that.is('.in_process')) {
                UI.sliderProcessing(that, event);
            }
        })
    }
}