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
var reviewsLink = '<a href="#reviews" class="reviews_link product_link">Read Reviews</a>';
var pDitails =  $('.product_details');

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


//reorder variation ditails

$(document).ready(function() {



var variationSelector = $('.variations');
var  singleVariation = $('.single_variation');
var productDeskLinks = $('<div class="desktop_product_links"><a id="des_link" class="product_link" href="#description" >Full Description</a> | <a id="adv_link" class="product_link" href="#advantages">Product advantages </a> | <a id="del_link" class="product_link" href="#delivery">Delivery info</a></div>');
var underButtonText = '<div class="under_button"><span class="under_button_span flaticon-check">Free Delivery </span><span class="under_button_span flaticon-check">In stock</span></div>'
var addToCart = $('.woocommerce-variation-add-to-cart');

    //variation selector relocation
    if ($( window ).width() > 767){
        singleVariation.after(variationSelector);
    }
    //product links
    singleVariation.after(productDeskLinks);

    // text under ad to cart button
    addToCart.after(underButtonText);



    $('body').on('click', '.product_link', function (event){
        event.preventDefault();
        var id = $(this).attr('href');


        console.log(id);
        $('html, body').animate({
            scrollTop: $(id).offset().top - 60
        }, 800);
    });
});






