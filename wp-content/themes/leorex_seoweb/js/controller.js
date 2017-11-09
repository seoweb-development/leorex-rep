// $ = jQuery.noConflict();
jQuery(document).ready(function () {
    $ = jQuery.noConflict();

    $('.ui-loader').remove();
    /*remove default jq mobile loader vidget*/

    Controller.init();
});

var Controller = {
    init: function () {
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
        this.cardBuildAfterAddProduct();
        this.shopingContinue();
        this.quantityInputClickMobileRepire();
        this.numInputChange();
        this.checkOutMobileClicksRepire();
        this.woocomerseStateSelectboxMobile();
        this.woocomerseStateSelectboxMobileSearch();
        this.addNewCheckImputToCheckOutPage();
        this.shippingInformationOpenCheckBox();
        this.radioButtonElementActivate();
        this.setPlaceHolderToStatesFields();
        this.statesSearching();
        this.slideClickCloseCardMobile();
        this.getFormFields();
        this.fieldValidatorEnable();
        this.checkoutCustomSubmitButtonAdd();
        this.checkoutFormSubmitButtonClick();
        this.reviewsDeckTopShow();
        this.variationDesctiptMobileRepire();

    },
    touchClick: function () {
        $('body').on('click, touchstart', '*', function (event) {
            if ('ontouchstart' in window) {
                $(event.target).trigger('touchstart')
                return false;
            }
            else {
                $(event.target).trigger('click')
                return false;
            }


        })


    },

    openCardMenuMobile: function () {
        $('body').on('click touchstart', '.xoo-wsc-close ', function (e) {
            // if( parseFloat($(document).width())< 1020) {
            $(e.target).click();
            // }
        })
    },

    accordionOpenClose: function () {
        $('.site-footer').on(Controller.CLICK, '.accordion_one_box .accordion_oppener', function () {
            var openCloseObject = {
                    that: $(this),
                    arrow: $(this).find('.accordion_arrow')
                },
                open = openCloseObject.arrow.hasClass('oppened');

            if (open) {
                UI.accordionClose(openCloseObject);
                return;
            }
            UI.accordionOpen(openCloseObject);
            $('.comtact_us_title.open_contact').trigger(Controller.CLICK);
        })
    },
    hamburgerClick: function () {
        $('body').on(Controller.CLICK, '.hamburger', function () {
            console.log('click');
            var that = $(this);
            UI.openMenu(that);
            UI.headerChange(that);
        })


    },
    toutchProcessing: function () {
        if ('ontouchstart' in window) {

            Controller.UP = 'touchend';
            Controller.DOWN = 'touchstart';
            Controller.MOVE = 'touchmove';
            Controller.CLICK = 'touchstart';
            $('body').addClass('touched');

        } else {
            Controller.UP = 'mouseup';
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
            $('.slider_button').removeClass('in_process');
            return false;
        })

    },
    sliderProcessing: function (that) {
        $(document).on(Controller.MOVE, function (event) {/*after-before slider SLIDE*/

            if (that.is('.in_process')) {
                UI.sliderProcessing(that, event);
            }
        });
    },
    pageResizeProcessing: function () {
        $(window).resize(function () {
            if ('ontouchstart' in window) {
                $('.before_image').css({'width': '90%'});
            } else {
                $('.before_image').css({'width': '72%'});
            }

            // $('.seven_minutes_before').show();
        })
    },
    slickSlider: function () {
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
    slickReviewsSlider: function () {
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
    slickSliderMobileClicker: function () {
        $('#page').on('touchstart', '.slick-prev, .slick-next, li[id^=slick-slide]', function (event) {

            $(event.target).click();
        })
    },
    contentTextParse: function () {
        var contentHtml = $('.content_container .content_body .hidden_container p');
        if (contentHtml.size() > 0) {
            UI.contentTextParse(contentHtml);
        }
    },
    contentTextParseReadMore: function () {
        var contentHtml = $('.content_container .content_body_read_more .hidden_container_read_more p');
        if (contentHtml.size() > 0) {
            UI.contentTextParseReadMore(contentHtml);
        }
    },
    readMoreOpenClose: function () {
        $('body.home').on(Controller.CLICK, '.read_more, .read_less ', function () {
            var that = $(this);
           // UI.readMoreOpenClose(that);
        })
    },
    quantityInputClickRepire: function () {
        $('body').on(Controller.UP, '.quantity .input-text', function (e) {
// alert($(this).val())
            $(this).trigger('blur')
            // e.preventDefault()
        })
        // return false;
    },
    quantityInputClickMobileRepire: function () {
        $('body.touched').on('touchstart', '.quantity .input-text', function (e) {
            var that = $(this);
            UI.quantityInputClickMobileRepire(that);


        })
    },
    numInputChange: function () {
        $('body').on('change', '.quantity .input-text', function () {

            UI.numInputChange()
        })
    },
    addQuamtityValueToHeaderIcon: function () {
        $('body').on('click touchstart', '.single_add_to_cart_button,' +
            ' .xoo-wsc-product .xoo-wsc-img-col .xoo-wsc-remove', function (e) {

            var that = $(this),
                flag = 1;
            if (that.is('.single_add_to_cart_button') && e.type == 'touchstart') {
                that.click();
                flag++;
            }
            if (flag == 1) {
                UI.addQuamtityValueToHeaderIcon(that);
            }
        })
    },
    openCloseFastCheckout: function () {
        UI.openCloseFastCheckout()
    },

    tabsOpenClose: function () {
        $('body').on(Controller.CLICK, '.tabs_container .one_tab .one_tab_header', function () {
            var that = $(this);
            UI.tabsOpenClose(that);
        })
    },
    reviewsTabsReadMoreOpen: function () {
        $('body').on(Controller.CLICK, '.tabs_container .one_tab.reviews_tab .one_tab_body .one_review .one_review_read_more', function () {
            var that = $(this);


            UI.reviewsTabsReadMoreOpen(that);
        })
    },
    reviewsTabsReadMoreClose: function () {
        $('body').on(Controller.CLICK, '.tabs_container .one_tab.reviews_tab .one_tab_body .one_review .reviews_text_read_less', function () {
            var that = $(this);


            UI.reviewsTabsReadMoreClose(that);
        })
    },
    repireSelectOptionBoxAddHtml: function () {
        if ($('body.single-product').size() > 0 && 'ontouchstart' in window) {
            UI.repireSelectOptionBoxAddHtml();
        }
    },
    openCloseNewSelectBoxBody: function () {
        $('body.single-product').on(Controller.CLICK, '.select_new_box .select_val', function () {
            var that = $(this),
                bodyElement = that.closest('.select_new_box').find('.box_body'),
                statusElement = bodyElement.is(':visible');
            UI.openCloseNewSelectBoxBody(that, bodyElement, statusElement)
        })
    },
    newSelectElementOneElementSelect: function () {
        $('body.single-product').on(Controller.CLICK, '.select_new_box .box_body .one_option', function () {
            var that = $(this),
                currentSelect = $('#packege'),
                bodyElement = that.closest('.box_body'),
                inputElement = bodyElement.siblings('.box_header').find('.select_val .text_element');
            UI.newSelectElementOneElementSelect(that, currentSelect, bodyElement, inputElement)
        })

    },
    cardShowDesktop: function () {
        var card = $('body .xoo-wsc-container');
        // UI.cardShowDesktop(card);
    },
    shopingContinue: function () {
        $('body').on('click touchstart', '.xoo-wsc-footer .xoo-wsc-cont, .xoo-wsc-container .xoo-wsc-cont, .hide_screen_box', function (e) {
            $('.hide_screen_box').remove();
            if ($(this).is('.hide_screen_box')) {
                $('.xoo-wsc-cont ').click();
                // $('.xoo-wsc-icon-cross').click();
                $(this).remove();
            }
            else {
                $('.xoo-wsc-container').hide();
                $('.slider_arrow').click();

                //     e.preventDefault()
            }


        })
    },

    removeFromCard: function () {
        $('body').on('click touchstart', '.new_remove', function () {
            $(this).parents('.xoo-wsc-product').find('.xoo-wsc-remove').click();
            var del = true

            $(document).ajaxComplete(function () {
                if (del) {
                    var cardCount = $('body:not(.mobile) .xoo-wsc-active .xoo-wsc-container .xoo-wsc-product').size();
                    $('.flaticon-business.desktop .header-cart-count ').text(cardCount);
                    // $('.flaticon-business.desktop .header-cart-count ').click();
                    $('.hide_screen_box').click();
                    del = false
                    return false
                }

            })

        })
    },
    cardBuildAfterAddProduct: function () {
        $('body').on('touchstart click', '.single_add_to_cart_button', function () {

            var cardWatcherInterval = setInterval(function () {
                if ($('.xoo-wsc-modal.xoo-wsc-active').size() > 0) {
                    clearInterval(cardWatcherInterval);

                    UI.cardShowDesktop($('body .xoo-wsc-active .xoo-wsc-container'), false)
                }
            }, 500)

        })

    },
    linksMobileClick: function () {
        $('body').on('mousedown touchstart', 'a', function (e) {
            if ($('body').is('.touched')) {
                e.preventDefault()
                var href = $(this).attr('href')
                window.location.assign(href);
            }
        })
    },


    checkOutMobileClicksRepire: function () {
        $('body.touched').on('touchstart', '.woocommerce-checkout :input', function (e) {
            $(e.target).focus().click();
        })

        $('body.touched').on('touchstart', ' .select2-container', function (e) {
            var that = $(this),
                parentId = that.closest('p').attr('id');
            UI.SelectOptionRepireScript(that, parentId);
        })
    },
    woocomerseStateSelectboxMobile: function () {
        $('body.touched').on('touchstart', 'li[id*=select2-billing_state-result]', function (e) {
            var that = $(this);
            UI.woocomerseStateSelectboxMobile(that);

            e.stopPropagation();
        })
    },
    woocomerseStateSelectboxMobileSearch: function () {
        $('body.touched').on('touchstart', '.select2-search__field', function (e) {
            $(this).focus();
            e.stopPropagation();
        })
    },
    addNewCheckImputToCheckOutPage: function () {
        UI.addNewCheckImputToCheckOutPage();
        UI.addNewRadioButtonsToPaymentsOptions();
    },
    shippingInformationOpenCheckBox: function () {
        $('body').on('click touchstart', '#ship-to-different-address-checkbox-new', function () {
            var that = $(this)
            UI.shippingInformationOpenCheckBox(that);
        })
    },

    radioButtonElementActivate: function () {
        $('body').on('click touchstart', '.wc_payment_methods .custom_radio:not(.checked)', function () {
            var that = $(this),
                parentEll = $('.wc_payment_methods');
            UI.radioButtonElementActivate(that, parentEll);
        })
    },

    setPlaceHolderToStatesFields: function () {
        UI.setPlaceHolderToStatesFields()
    },

    statesSearching: function () {
        $('body.touched').on('keyup', '.select2-search__field:focus', function () {
            var that = $(this),
                textToSearch = that.val();
            UI.statesSearching(that, textToSearch);
            return false;
        })

    },
    slideClickCloseCardMobile: function () {
        $('body').on('touchstart click', '.xoo-wsc-header .slider_arrow', function () {
            var that = $(this)
            UI.slideClickCloseCardMobile(that)
        })
    },
    getFormFields: function () {
        var CheckFormContainer = $('.woocommerce-billing-fields__field-wrapper');
        Validator.getFormFieldsObject(CheckFormContainer);
    },

    fieldValidatorEnable: function () {
        $('body').on('blur', '.woocommerce-billing-fields__field-wrapper :input, .woocommerce-shipping-fields__field-wrapper:visible :input', function () {
            var input = $(this);
            Validator.fValidator(input);

        })
    },
    checkoutCustomSubmitButtonAdd: function () {
        var pattern = /checkout/;
        if (pattern.test(window.location.pathname)) {
            UI.checkoutCustomSubmitButtonAdd()

        }
    },
    checkoutFormSubmitButtonClick: function () {
        var pattern = /checkout/;
        if (pattern.test(window.location.pathname)) {
            $('body').on(Controller.CLICK,'.custom_submit_button',function () {
                var that = $(this);
                UI.checkoutFormSubmitButtonClick(that)
            })
        }
    },
    reviewsDeckTopShow:function(){
        if($('body').width()> 768 && $('.one_review:visible').size()>4) {
            var counter = 1
            $('.one_review:visible').each(function () {
                if(counter>4){
                    $(this).hide();
                }
                counter++;
            })
            var readMoreHtml = $('<div class="read_more_decktop">Read more ></div>');
            $('.reviews_tab.one_tab').append(readMoreHtml);
            $('body').on(Controller.CLICK,'.read_more_decktop:not(.op)', function () {
                $(this).siblings('.one_tab_body').find('.one_review:hidden').show();
                $(this).text('Read Less>').addClass('op')
            } )
            $('body').on(Controller.CLICK,'.read_more_decktop.op', function () {
                $(this).text('Read More>').removeClass('op')
                var counter = 1
                $('.one_review:visible').each(function () {
                    if(counter>4){
                        $(this).hide();
                    }
                    counter++;
                })
                $('html, body').animate({
                    scrollTop: $('#reviews').offset().top - (100 + parseFloat($('#reviews').css("marginTop").replace('px','')))
                }, 800);
            } )

        }
    },
    variationDesctiptMobileRepire:function () {
        var pattern = /product/;
        if($('body').width()<= 768 && pattern.test(window.location.pathname) ){
            // $(document).ajaxComplete(function () {
            setTimeout(function () {
                var varElementText = $('.woocommerce-variation-description p').text();



                $('.woocommerce-product-details__short-description').text($('.woocommerce-product-details__short-description').text() + ' ' + varElementText);
            }, 1000)
            // });
        }
    }


};