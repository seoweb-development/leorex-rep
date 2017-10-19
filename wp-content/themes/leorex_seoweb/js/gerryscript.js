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
    element: document.getElementById('page'),
    handler: function() {
        $('.back_to_top').toggleClass('show');
    },
    offset: -500
})

$('.back_to_top').on('click', function () {
    $('body,html').animate({
        scrollTop: 0
    }, 800);
});

//open mini cart

$('#cart_icon').on('click', function () {
    console.log('click icon');
    $('.xoo-wsc-basket').trigger('click');
});


//open fast checkout



$(document).ready(function() {
    $(".word_split").lettering('words');
});

//append elements on product page

//title variation

var productTitle = $('.single-product .product .product_title');
var variationSelect = $('.single-product .product .variations .value select');
var productVariatonValeu = variationSelect.val();
var reviewsLink = '<a href="#reviews" class="reviews_link">Read Reviews</a>';

$(document).ready(function() {
    productTitle.append('<span class="variation_tittle">' + ' ' + productVariatonValeu + '</span>');
});


variationSelect.change(function(){
    var productVariatonValeu = variationSelect.val();
    productTitle.children('.variation_tittle').text(' ' + productVariatonValeu );
});

//reviews link

$(document).ready(function() {
    productTitle.after(reviewsLink);
});




