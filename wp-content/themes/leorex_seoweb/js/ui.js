$ = jQuery.noConflict();



var UI = {
    globalObject: {
        menu: $('.mobile_menu_panel'),
        sliderEnable: false
    },
    accordionOpen: function (openCloseObject) {
        var arrow = openCloseObject.arrow,
            hiddenBox = openCloseObject.that.closest('.accordion_one_box').find('.accordion_one_box_body:hidden'),
            arrowsOppened = $('.accordion_container .accordion_arrow.oppened'),
            openBoxes = $('.accordion_container .accordion_one_box_body:not(:hidden)');

        arrowsOppened.removeClass('oppened');
        hiddenBox.slideDown(500);
        openBoxes.slideUp(500);
        arrow.addClass('oppened')
    },
    accordionClose: function (openCloseObject) {
        var arrow = openCloseObject.arrow,
            oppenBox = openCloseObject.that.closest('.accordion_one_box').find('.accordion_one_box_body:not(:hidden)');
        oppenBox.slideUp(500);
        arrow.removeClass('oppened');
    },
    openMenu: function () {
        //var menu = $('.mobile_menu_panel')
        if (UI.globalObject.menu.hasClass('open_menu')) {
            UI.globalObject.menu.removeClass('open_menu')
        } else {
            UI.globalObject.menu.addClass('open_menu')
        }
    },
    headerChange: function () {
        var hamburger = $('.hamburger');
        var cartIcon = $('.flaticon-business');
        var headeLogo = $('.logo_container');
        if (UI.globalObject.menu.hasClass('open_menu')) {
            cartIcon.addClass('open_menu');
            hamburger.addClass('open_menu');
            headeLogo.addClass('open_menu');
        } else {
            cartIcon.removeClass('open_menu');
            hamburger.removeClass('open_menu');
            headeLogo.removeClass('open_menu');
        }
    },
    sliderProcessing: function (that, event) {
        var pX;
        if (event.originalEvent.touches !== undefined) {
            var touch = event.originalEvent.touches[0];
            pX = touch.pageX

        } else {
            pX = event.clientX;
        }


        var movingContainer = that.parents('.before_image'),
            // target = $(event.target),
            mousePositionX = parseInt(pX),
            // movingContainerWidht = parseInt(movingContainer.width()) ,
            containerWidth = parseInt(movingContainer.parents('.before_after_container').width()),
            newPosition = containerWidth - mousePositionX,
            slidePercend = (newPosition / containerWidth) * 100;
        if (mousePositionX >= 0) {

            movingContainer.css({'width': newPosition + 'px'});
            // if(slidePercend<=40){
            //     $('.seven_minutes_before:not(:hidden)').hide();
            // }else{
            //     $('.seven_minutes_before:hidden').show();
            // }
        }
    },
    contentTextParse: function (contentHtml) {
        var contentSize, firstContainer, secondContainer, firstContainerSize, counter = 1
        contentSize = parseInt(contentHtml.size());
        firstContainerSize = Math.ceil(contentSize / 2);
        $.each(contentHtml, function (key, val) {
            if (counter <= firstContainerSize) {
                $('.text_box_left').append(val);
                counter++;
            } else {
                $('.text_box_rigth').append(val);
            }

        })

    },
    contentTextParseReadMore: function (contentHtml) {
        var contentSize, firstContainer, secondContainer, firstContainerSize, counter = 1
        contentSize = parseInt(contentHtml.size());
        firstContainerSize = Math.ceil(contentSize / 2);
        $.each(contentHtml, function (key, val) {
            if (counter <= firstContainerSize) {
                $('.text_box_left_read_more').append(val);
                counter++;
            } else {
                $('.text_box_rigth_read_more').append(val);
            }

        })

    },
    readMoreOpenClose: function (that) {
        if (that.is('.read_more:not(.opend)')) {

            $('.content_body_read_more:hidden').slideDown(300).css({'display': 'flex'});
            $('.read_less').show();
            $(that).text('Read Less');
            $(that).addClass('opend');
            return false;

        }
        if (that.is('.read_less') || that.is('.opend')) {
            $('.content_body_read_more:not(:hidden)').slideUp(300);
            $('.read_less').hide();
            $('html, body').animate({
                scrollTop: $("#c_c").offset().top
            }, 300);
            $('.read_more').text('Read More');
            $('.read_more.opend').removeClass('opend');
        }

    },
    addQuamtityValueToHeaderIcon: function (that) {
        var inputVal = parseInt($('.quantity .input-text').val()),
            cardIcon = $('#header_inner .flaticon-business .header-cart-count:visible'),
            cardVal = parseInt(cardIcon.text()),
            cardNewVal = inputVal + cardVal;
        if (that.is('.xoo-wsc-remove')) {
            cardNewVal = 0;
        }
        else if (that.is('.single_add_to_cart_button')) {
            $('.fast_checkout').addClass('opend');
        }
        cardIcon.text(cardNewVal);


    },
    openCloseFastCheckout: function () {
        var cardIcon = $('#header_inner .flaticon-business .header-cart-count'),
            cardVal = parseInt(cardIcon.text()),
            notShow = false || $('body').is('.woocommerce-cart') || $('body').is('.woocommerce-checkout');
        if (cardVal > 0 && !notShow) {
            $('.fast_checkout').addClass('opend');
        }
    },
    tabsOpenClose: function (that) {
        var tabContainer = that.closest('.one_tab'),
            tabBody = tabContainer.find('.one_tab_body');
        if (tabBody.is('.one_tab_body_hidden ')) {
            tabBody.slideDown(300).removeClass('one_tab_body_hidden ');
            if (tabBody.find('.one_review').size() > 0) {
                var mainTextElement = tabBody.find('.reviews_text');
                mainTextElement.each(function (key, val) {
                    var innerEllement = $(this).find('.reviews_text_inner'),
                        innerText = innerEllement.text(),
                        innerHtml = innerEllement.html(),
                        shortString = innerText.substring(0, 240),
                        longText = innerText.replace(shortString, '');

                    innerEllement.html(shortString + '...<br>').append('<long style="display: none">' + innerHtml + '</long>').css({'paddingTop': '14px'});
                    $(this).height(innerEllement.height() + 20)
                })
            }
        } else {
            tabBody.slideUp(300, function () {

            }).addClass('one_tab_body_hidden ');

        }
    },
    reviewsTabsReadMoreOpen: function (that) {
        var parentBox = that.closest('.one_review'),
            mainTextBox = parentBox.find('.reviews_text'),
            mainTextBoxHeight = mainTextBox.find('.reviews_text_inner').outerHeight(true),
            innerElement = mainTextBox.find('.reviews_text_inner');
        innerElement.html(innerElement.find('long').html()).css({'paddingTop': '0px'})
        innerElement.find("br").remove();
        mainTextBox.animate({'height': innerElement.height() + 60}, 500);
        that.hide();
        mainTextBox.find('.reviews_text_read_less').show();
    },
    reviewsTabsReadMoreClose: function (that) {
        var parentBox = that.closest('.one_review'),
            mainTextBox = parentBox.find('.reviews_text'),
            innerElement = mainTextBox.find('.reviews_text_inner'),
            innerText = innerElement.text(),
            shortText = innerText.substring(0, 240),
            InnerHtml = innerElement.html();
        innerElement.html(shortText + '...<br>').append('<long style="display: none">' + InnerHtml + '</long>').css({'paddingTop': '14px'})

        mainTextBox.animate({'height': innerElement.height() + 20}, 500);
        that.hide();
        mainTextBox.siblings('.one_review_read_more').show();
    },
    repireSelectOptionBoxAddHtml: function () {
        var currentSelectInputElement = $('select#packege'),
            parentBox = currentSelectInputElement.closest('.value'),
            optionsElements = currentSelectInputElement.find('option'),
            selectOptionHtml = '<div class="select_new_box">';
        selectOptionHtml += '<div class="box_header">' +
            '<div class="select_val">' +
            '<div class="arrow"></div>' +
            '<div class="text_element">' + currentSelectInputElement.val() + '</div>' +
            '</div></div>' +
            '<div class="box_body">';
        optionsElements.each(function (key, val) {
            selectOptionHtml += '<div class="one_option" one_option_val="' + $(this).val() + '">' + $(this).text() + '</div>'
        })
        selectOptionHtml += '</div></div>';
        currentSelectInputElement.hide();
        parentBox.append(selectOptionHtml)
    },
    openCloseNewSelectBoxBody: function (that, bodyElement, statusElement) {
        if (!statusElement) {
            bodyElement.slideDown(300);
        } else {
            bodyElement.slideUp(300);
        }
    },
    newSelectElementOneElementSelect: function (that, currentSelect, bodyElement, inputElement) {
        var elemText = that.text(),
            elemVal = that.attr('one_option_val') || '';
        currentSelect.val(elemVal);
        inputElement.text(elemText);
        bodyElement.slideUp(300);
    },
    cardShowDesktop: function (card, after_ajax) {
        var lastActiveElement = card.find('.xoo-wsc-product:last'),
            notLastElement = card.find('.xoo-wsc-product:not(:last)'),
            variation = $.trim(lastActiveElement.find('.variation:last dd').text());
// $.each(card.find('.xoo-wsc-product:not(:last)'), function () {
//     notLastElement.hide();
// })

        var productsElements = card.find('.xoo-wsc-product'),
            headerEllement = card.find('.xoo-wsc-header'),
            afterTitleText = 'Has been added to your bag',
            popTitle = card.find('.xoo-wsc-product:last').find('.xoo-wsc-sum-col a:not(.xoo-wsc-pname)').text() || $('.xoo-wsc-header .header_title .title_text').text();
        lastActiveElement.css({'opacity':0, 'display':'flex'}).animate({'opacity':1},300);


            productsElements.each(function () {


                var /*popTitle = $(this).find('.xoo-wsc-sum-col a:not(.xoo-wsc-pname)').text()||$('.xoo-wsc-header .header_title .title_text').text(),*/
                    capacityValue = 20,
                    quantity = 1,
                    curency = $(this).find('.xoo-wsc-price .woocommerce-Price-currencySymbol:last').text(),
                    price = $(this).find('.xoo-wsc-price .woocommerce-Price-amount:first').text(),
                    price = price.replace('$', ''),
                    variation = $.trim($(this).find('.variation:last dd').text()),
                    headerHtml,
                    productContentHtml;
//  product content
                productContentHtml = $(
                    '<div class="product_info">' +
                    '<div class="product_price"><div class="product_price_title">Price:</div><div class="product_price_val">' + curency + price + '</div></div>' +
                    '<div class="product_quantity"><div class="product_quantity_title">Quantity:</div><div class="product_quantity_val">1</div></div>' +
                    '</div>  '
                )
                if (after_ajax) {
                    $(this).find('.xoo-wsc-sum-col').html(productContentHtml);
                    // $(this).find('.xoo-wsc-sum-col').fadeIn(1000)
                    // $('body:not(.mobile) .xoo-wsc-active').removeClass('xoo-wsc-active');
                } else {
                    if($(this).find('.xoo-wsc-sum-col .product_info').size()==0) {
                        $(this).find('.xoo-wsc-sum-col').append(productContentHtml);
                    }/*else{
                        $(this).find('.xoo-wsc-sum-col').append(productContentHtml);
                    }*/
                }
                //    close button===================
                var closeElement = $('<div class="new_remove"></div>');
                $(this).find('.xoo-wsc-img-col').prepend(closeElement);
            })

            //    card header building
           var headerHtml = $('<div class="thryangle"></div><div class="header_title">' +
                '<div class="title_text">' + popTitle + '</div>' +
                '<div class="title_variation">' + variation + '</div>' +
                '</div><div class="card_desctiption">' + afterTitleText + '</div>');
            if(headerEllement.find('.title_text').size()==0) {
                headerEllement.append(headerHtml);
            }
        if (parseFloat($(document).width()) < 1020) {
            var sliderArrowHtml = $('<div class="slider_arrow"></div>')
            if(headerEllement.find('.slider_arrow').size()==0) {
                headerEllement.prepend(sliderArrowHtml);
            }
        }
        // }


        //   pop-up footer buttons
        card.find('.xoo-wsc-footer .xoo-wsc-chkt').text('Checkout').attr('href', 'http://leorex-cosmetics.com/cart/')
        if($('body .hide_screen_box').size()==0)
{
    var hideScreenBox = $('<div class="hide_screen_box"></div>');

    $('body').prepend(hideScreenBox);
}
    },
    quantityInputClickMobileRepire: function (that) {
        var inputValue = that.val(),
            inputId = that.attr('id'),
            inputName = that.attr('name'),
            inputHtml = '<input type="number" id="' + inputId + '" class="input-text qty text changed" step="1" min="0" max="25" name="' + inputName + '" value="' + inputValue + '" title="Qty" size="4" pattern="[0-9]*" inputmode="numeric">';
        that.replaceWith(inputHtml);

    },
    numInputChange: function () {
        var card_sum = 0
        $('#table_container .input-text').each(function () {
            var num = parseInt($(this).val()) || 0;
            card_sum += num;
        })
        $('.header-cart-count').text(card_sum)
        $("[name='update_cart']").trigger('click');
    },
    // ==== this function SelectOptionRepireScript just for mobile-touched devises ====================================
    SelectOptionRepireScript: function (that, parentId) {
    $('body .select2-container--open').remove();
    if(that.is(':not(.is_drop_open)')) {
        var curentSelect = $('#' + parentId).find('select'),
            optionSelected = curentSelect.val(),
            optionsFealds = curentSelect.find('option'),
            counter = 1,
            appHtml = '<span class="select2-container select2-container--default select2-container--open" dest_target_parent ="' + parentId + '" style="position: absolute; top: 391.313px; left: 3px;">' +
                '    <span class="select2-dropdown select2-dropdown--below" dir="ltr" >' +
                '<span class="select2-search select2-search--dropdown">' +
                '<input class="select2-search__field" type="text" tabindex="0" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false"' +
                'role="combobox" aria-autocomplete="list" aria-expanded="true" aria-owns="select2-billing_state-results" aria-activedescendant="select2-billing_country-result-ehvw-MV">' +
                '</span>' +
                ' <span class="select2-results">' +
                '<ul class="select2-results__options" role="listbox" tabindex="-1" ' +
                'id="select2-billing_state-results" aria-expanded="true" aria-hidden="false" >';

        optionsFealds.each(function (k, v) {
            var opText = $(v).text(),
                opVal = $(v).val(),
                ifSelected = optionSelected == opVal ? 'true' : 'false'
            appHtml += '<li class="select2-results__option" id="select2-billing_state-result-rfdy' + counter + '-' + opVal + '" role="option" data-selected="' + ifSelected + '" tabindex="-1">' + opText + '</li>'
            counter++;

        })
        appHtml += '</ul></span></span></span>'
        var selId = $(appHtml).find('.select2-results__option[data-selected=true]').attr('id'),
            w = that.width() + 'px',
            h = parseFloat(that.height())
        t = (parseFloat(that.position().top) + h) + 'px';
        l = that.position().left + 'px'

        $('body.touched').append($(appHtml));
        $('body.touched .select2-container--open').css({'top': t, 'left': l});
        $('body.touched').find('.select2-dropdown--below').css({'width': that.width() + 'px'}).end().find('#select2-billing_state-results , input.select2-search__field').attr('aria-activedescendant', selId);
        // that.closest('p').find('label').click();
        that.addClass('is_drop_open');
    }else{
        that.removeClass('is_drop_open');
    }
},
    woocomerseStateSelectboxMobile:function (that) {
        var parentSpan = that.closest('.select2-container--open'),
            parentId = parentSpan.attr('dest_target_parent')
            parentP = $('p#'+parentId),
            textFeald = parentP.find('.select2-selection__rendered'),
            elementId = that.attr('id'),
            elementText = that.text(),
            curentSelect = parentP.find('select'),
        selectedVal = elementId.slice(-2) ;
        curentSelect.val(selectedVal);
        textFeald.text(elementText).attr('title',elementText);
        parentSpan.remove();
    },
    addNewCheckImputToCheckOutPage:function () {
        var newInputHtml = $('<div id="ship-to-different-address-checkbox-new"></div>')
        $('#ship-to-different-address .woocommerce-form__label-for-checkbox').prepend(newInputHtml)
    },
    shippingInformationOpenCheckBox:function (that) {

        if($('body').is(':not(.touched)')) {
            if (that.is('.checked')) {
                that.removeClass('checked')
                $('#ship-to-different-address-checkbox').prop('checked', true)
                return false;
            }
            else {
                that.addClass('checked');
                $('#ship-to-different-address-checkbox').prop('checked', false)
                return false;
            }
            return;
        }

            if (that.is('.checked')) {
                that.removeClass('checked')
            }
            else {
                that.addClass('checked');
            }
            $('#ship-to-different-address-checkbox').click()

    },
    addNewRadioButtonsToPaymentsOptions:function () {
        $(document).ajaxComplete(function () {
            var payPalRadioHtml = $('<div class="pay_pal custom_radio" id="pay_pal_radio_button"><div class="pay_pal_inner radio_inner"></div></div>'),
                creditCardRadioHtml = $('<div class="credit_card custom_radio" id="credit_card_radio_button"><div class="credit_card_inner radio_inner"></div></div>'),
                payPalLi = $('.wc_payment_methods  li.payment_method_paypal '),
                cardComLi = $('.wc_payment_methods  li.payment_method_cardcom ');
            payPalLi.prepend(payPalRadioHtml);
            if(payPalLi.find('input[checked=checked]').size()>0){
                payPalLi.find('.custom_radio').addClass('checked')
            }
            cardComLi.prepend(creditCardRadioHtml);
            if(cardComLi.find('input[checked=checked]').size()>0){
                cardComLi.find('.custom_radio').addClass('checked')
            }
        })
    },
    radioButtonElementActivate:function (that, parentEll) {


            parentEll.find('.custom_radio.checked').removeClass('checked');
            parentEll.find('input').removeAttr('checked')
            that.addClass('checked');
            that.siblings('input').click()



    },
    setPlaceHolderToStatesFields:function () {
       $('#billing_state_field').add('#shipping_state_field').each(function () {
           var firstSpan = $(this).find('select2-container--default'),
               currentSelectPlaceHolder = $(this).find('select').attr('data-placeholder');
           $(this).find('.select2-selection__rendered').text(currentSelectPlaceHolder).attr('title', currentSelectPlaceHolder)
       })
    },
    statesSearching:function (that, text) {
        var options = that.closest('.select2-dropdown').find('.select2-results__option') ;

        if(text !='') {
            var pattern = new RegExp('^'+text, 'i'),
            // var pattern = ,
            optionText = '',
            optionsVisible = {},
            counter = 1;
            options.each(function () {
                optionText = $(this).text();
                if(!pattern.test(optionText)){
                    $(this).hide();
                }else{
                    $(this).show();
                    optionsVisible[counter] = $(this);
                    counter++;
                }
            })
            // var optionsVisible = that.closest('.select2-dropdown').find('.select2-results__option.vis');
            // optionsVisible.sort(function (a, b) {
            //   var first = $(a).text().toUpperCase();
            //   var second = $(b).text().toUpperCase();
            //     return (first < second) ? -1 : (first > second) ? 1 : 0;
            // })
            // that.closest('.select2-dropdown').find('ul').append(optionsVisible);
        }else{
            options.show();
        }
    },
    slideClickCloseCardMobile:function (that) {
        $('.hide_screen_box').remove();
        $('.xoo-wsc-icon-cross').click();

    }
    


};
