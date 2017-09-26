$j = jQuery.noConflict();
$j(function () {
    Controller.init();
})

var Controller ={
    init:function () {
this.accordionOpenClose();
    },
    accordionOpenClose:function () {
        $j('.site-footer').on('click','.accordion_oppener', function () {
            var openCloseObject = {
                that:$j(this),
                arrow :$j(this).find('.accordion_arrow'),
            },
            open = openCloseObject.arrow.hasClass('oppened')

            if(open){
                UI.accordionClose(openCloseObject);
                return;
            }
            UI.accordionOpen(openCloseObject);

        })
    }
}