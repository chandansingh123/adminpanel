/* product.js
 * ==========================
 * Product module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($product, $common) {
    "use strict";
    
    var baseUrl = $common.getBaseUrl();

    /**
     * validation initializer
     * @param {string} formId 
     */
    $product.validation = function (formId) {
        $(formId).validate({
            rules: {
                name: {
                    required: true
                },
                delivery_date: {
                    required: true
                },
                min_reserved_price: {
                    required: true,
                    digits: true
                },
                item_id: {
                    required: true,
                },
                closed_date: {
                    required: true
                },
                offer_quantity: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                name: {
                    required: "(This field is required.)"
                },
                delivery_date: {
                    required: "(This field is required.)"
                },
                min_reserved_price: {
                    required: "(This field is required.)",
                    digits: "(Please enter only digits.)"
                },
                item_id: {
                    required: "(This field is required.)"
                },
                closed_date: {
                    required: "(This field is required.)"
                },
                offer_quantity: {
                    required: "(This field is required.)",
                    digits: "(Please enter only digits.)"
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
                        left: '50%'
                    },
                    message: '<img src="/backend/img/loading-big.gif" width="64"/>',
                    baseZ: 1050
                });

                form.submit();

            }
        });
    };

    /**
     * delete click event
     */
    $(document).on('click', '.product-delete-btn', function () {
        // Get the record's id via attribute
        var id = $(this).attr('data-id');
        var modelId = $('#productDeleteModal');
        modelId.find('#product-id').val(id);
    });

    /**
     * delete yes click event
     */
    $('.product-delete-yes-btn').on('click', function () {
        var modelId = $('#productDeleteModal');
        var id = modelId.find('#product-id').val();
        $product.delete(id, function (data) {
            modelId.modal('hide');
            $('.product-list-success-message').html(data.message).show();
            setTimeout(function () {
                window.location.reload();
            }, 800);

        }, function (error) {
            if (error) {
                console.log(error);
            }
        });
    });

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    /**
     * ajax call for store product information
     * @param {array} productFormData
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $product.save = function (productFormData, successCallBack, errorCallBack) {
        var productUrl = baseUrl + "product/store";
        $.ajax({
            url: productUrl,
            method: "POST",
            data: productFormData,
            success: function (response) {
                if (successCallBack)
                    successCallBack(response);
            },
            error: function (error) {
                if (errorCallBack)
                    errorCallBack(error);
            },
            dataType: "json"
        });
    };


    /**
     * ajax call for delete product information
     * @param {integer} id
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $product.delete = function (id, successCallBack, errorCallBack) {
        var productUrl = baseUrl + "product/destroy/" + id;
        $.ajax({
            url: productUrl,
            method: "GET",
            success: function (response) {
                if (successCallBack)
                    successCallBack(response);
            },
            error: function (error) {
                if (errorCallBack)
                    errorCallBack(error);
            },
            dataType: "json"
        });
    };

    $product.validation("#product-add-form");
    $product.validation("#product-edit-form");


})(auction.product = auction.product || {}, auction.common);