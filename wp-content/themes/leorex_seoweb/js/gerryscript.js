/**
 * Created by Gerry on 01/10/2017.
 */


$(window).on("load scroll resize", function() {
    var offset = $(".accordion_one_box:nth-child(2)").offset();
    var wiWidth = $('body').width();
    var containeWidth = $('.footer_menu_container').width();
    var inOffset = parseInt(containeWidth) - (parseInt(offset.left) - (parseInt(wiWidth) - parseInt(containeWidth))/2);
    $('.sub_footer').css('width', parseInt(inOffset) + 'px' );
});

$('.comtact_us_title').on('click touchstart',function(){
    console.log('click here');
    if($(this).hasClass('open_contact')){
        $(this).next('.textwidget').slideUp(500);
        $(this).removeClass('open_contact');
    }else{
        $(this).parents('.accordion_container').find('.accordion_oppener:has(.oppened)').trigger(Controller.CLICK);
        $(this).next('.textwidget').slideDown(500);
        $(this).addClass('open_contact');

    }
});

var waypoint = new Waypoint({
    element: document.getElementById('advantages'),
    handler: function() {
        $('.back_to_top').toggleClass('show');
    }
})

$('.back_to_top').on('click', function () {
    $('body,html').animate({
        scrollTop: 0
    }, 800);
});