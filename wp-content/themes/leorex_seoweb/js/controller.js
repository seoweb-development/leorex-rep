// $ = jQuery.noConflict();
jQuery(document).ready(function () {
 $ = jQuery.noConflict();

   $('.ui-loader').remove();/*remove default jq mobile loader vidget*/

    Controller.init();
})

var Controller ={
    init:function () {

this.accordionOpenClose();
this.hamburgerClick();
this.sliderMouseDown();

    },
    accordionOpenClose:function () {
        $('.site-footer').on('click, vclick','.accordion_oppener', function () {
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
        $('body').on('click, vclick','.hamburger', function(){
            console.log('click');
            that = $(this);
            UI.openMenu(that);
            UI.headerChange(that);
        })


    },
    sliderMouseDown: function () {
        $('.before_after_container').on('mousedown, vmousedown', '.slider_button', function () {
            var that = $(this);
            that.addClass('in_process')

            Controller.sliderProcessing(that);
        })
        $(document).on('mouseup, vmouseup', function () {
           $('.slider_button').removeClass('in_process') ;
           return false;
        })

    },
    sliderProcessing:function(that){
        $(document).on("mousemove, vmousemove", function (event) {
            if(that.is('.in_process')) {
                UI.sliderProcessing(that, event);
            }
        })
    }
}