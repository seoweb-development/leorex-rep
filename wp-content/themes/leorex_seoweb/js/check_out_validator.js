var Validator = {
    flags:[],
    validObject:{},
    validPaterns:{},

    getFormFieldsObject:function (form_container) {
      var inputs = form_container.find(':input:not([type=checkbox])'),
      inputId = '';


      inputs.each(function (key, val) {
          inputId = $(this).attr('id')
          Validator.validObject[inputId] = false;
          if(inputId == 'billing_address_2' || inputId == 'shipping_address_2'){
              Validator.validObject[inputId] = true;
          }

      })
        Validator.setPattern();
    },
    setPattern:function () {
        Validator.validPaterns = {
            'billing_first_name':/^[a-z\d\s]{3,20}$/i,
            'billing_address_1':/^[a-z\d\s]{3,20}$/i,
            'billing_city':/^[a-z\d\s]{3,20}$/i,
            'billing_phone':/^[0-9]{10}$/i,
            'billing_postcode':/^[0-9]{5}$/i,
            'billing_state':/^[a-z0-9\s-]{1,20}$/i,
            'billing_email': /^[a-z0-9\._-]+@[a-z0-9\._-]+\.[a-z]{2,6}$/i,
            'shipping_address_1': /^[a-z\d\s]{3,20}$/i,
            'shipping_city': /^[a-z\d\s]{3,20}$/i,
            'shipping_first_name': /^[a-z\d\s]{3,20}$/i,
            'shipping_postcode':/^[0-9]{5}$/i,
            'shipping_state':/^[a-z0-9\s-]{1,20}$/i
        }

    },

            fValidator: function (field) {
        var field_val = field.val(),
            field_id = field.attr('id');
       if(Validator.validPaterns[field_id]!= undefined) {
           if (Validator.validPaterns[field_id].test($.trim(field_val))) {
               Validator.validObject[field_id] = true;
               field.css({'borderColor':'green'});
               field.closest('.form-row').find('.select2-selection').css({'borderColor':'green'})
               return;
           }
           Validator.validObject[field_id] = false;
           field.css({'borderColor':'red'});
           field.closest('.form-row').find('.select2-selection').css({'borderColor':'red'})
       }


    },
    GeleteFormFieldsObject:function () {
        var pattern = /shipping_/;
        $.each(Validator.validObject,function (k,v) {
            if(pattern.test(k)){
                delete Validator.validObject[k];
            }
        })
    }

}