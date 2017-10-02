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
    globalObject : {},
    accordionOpenClose:function () {
        $('.site-footer').on('click','.accordion_oppener', function () {
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
        $('body').on('click','.hamburger', function(){
            console.log('click');
            that = $(this);
            UI.openMenu(that);
            UI.headerChange(that);
        })


    },
    toutchProcessing:function () {
         if('ontouchstart'in window){
             Controller.globalObject.touchEvents ={
                 UP:'touchend',
                 DOWN:'touchstart',
                 MOVIE:'touchmove'
             }
         }else{
             Controller.globalObject.touchEvents ={
                 UP:'mouseup',
                 DOWN:'mousedown',
                 MOVIE:'mousemove'
             }
         }
    },
    sliderMouseDown: function () {


        $('.before_after_container').on(Controller.globalObject.touchEvents.DOWN, '.slider_button', function (e) {


            var that = $(this);
            that.addClass('in_process')

            Controller.sliderProcessing(that);
        })
        $(document).on(Controller.globalObject.touchEvents.UP, function () {
            // alert('hjkhjkh');
           $('.slider_button').removeClass('in_process') ;
           return false;
        })

    },
    sliderProcessing:function(that){
        $(document).on(Controller.globalObject.touchEvents.MOVIE, function (event) {

            if(that.is('.in_process')) {
                UI.sliderProcessing(that, event);
            }
        })
    }
}