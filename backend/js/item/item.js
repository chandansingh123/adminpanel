/* item.js
 * =======================
 * Item module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($item, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();


    /**
     * validation initializer
     * @param {string} formId
     */
    $item.validation = function (formId) {
        $(formId).validate({
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                file_name: {
                    // required: true,
                    extension: "jpg|png|jpeg"
                }
            },
            messages: {
                name: {
                    required: "(This field is required.)"
                },
                description: {
                    required: "(This field is required.)"
                },
                file_name: {
                    required: "(This field is required.)"
                }
            },
            highlight: function (element) {
                if ($(element).parent().parent().parent('.checkbox-group').length) {
                    $(element).parent().parent().parent('.checkbox-group').addClass('has-error');
                } else {
                    $(element).closest('.form-group').addClass('has-error');
                }
            },
            unhighlight: function (element) {
                if ($(element).parent().parent().parent('.checkbox-group').length) {
                    $(element).parent().parent().parent('.checkbox-group').removeClass('has-error');
                } else {
                    $(element).closest('.form-group').removeClass('has-error');
                }
            },
            errorElement: 'span',
            errorClass: 'help-block',
            errorPlacement: function (error, element) {
                if (element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else if (element.is(':checkbox')) {
                    error.insertAfter($('#fake-' + element.attr('id')));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                $.blockUI({
                    css: {
                        border: 'none',
                        backgroundColor: 'none',
                        opacity: 0.6,
                        width: '18%',
                        left: '55%'
                    },
                    message: '<img src="/backend/img/loading-big.gif" width="64"/>',
                    baseZ: 1050
                });

                form.submit();

            }
        });
    };


    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    $item.validation("#item-form");


})(auction.item = auction.item || {}, auction.common);