/* user.js
 * =========================
 * User module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($customer, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();

    /**
     * validation initializer
     * @param {string} formId
     */
    $customer.validation = function (formId) {
        $(formId).validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                phone: {
                    required: true,
                    digits: true,
                    remote: {
                        url: baseUrl + "customer/availability",
                        method: "POST",
                        data: {
                            phone: function () {
                                return $(formId).find('input[name=phone]').val();
                            }
                        }
                    }
                },
                address: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true
                },
                terms: {
                    required: true
                }
            },
            messages: {
                first_name: {
                    required: "(This field is required.)"
                },
                last_name: {
                    required: "(This field is required.)"
                },
                phone: {
                    required: "(This field is required.)",
                    remote: "(Phone already exists in system.)"
                },
                address: {
                    required: "(This field is required.)"
                },
                email: {
                    required: "(This field is required.)"
                },
                password: {
                    required: "(This field is required.)"
                },
                terms: {
                    required: "(This field is required.)"
                }
            },
            highlight: function (element) {

                $(element).closest('.form-group').addClass('has-error');

            },
            unhighlight: function (element) {

                $(element).closest('.form-group').removeClass('has-error');

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
                        left: '40%'
                    },
                    message: '<img src="../../../backend/img/loading-big.gif" width="64"/>',
                    baseZ: 1050
                });

                form.submit();
            }

        });

    };

    $customer.validation("#customer-add-form");

})(auction.customer = auction.user || {}, auction.common);