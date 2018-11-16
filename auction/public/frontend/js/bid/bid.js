/* bid.js
 * ======================
 * Bid module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($bid, $common) {
    "use strict";

    var baseUrl = $common.getBaseUrl();

    /**
     * validation initializer
     * @param {string} formId
     */
    $bid.validation = function (formId) {

        $(formId).validate({
            rules: {
                bid_price: {
                    required: true,
                    digits: true,
                    remote: {
                        url: baseUrl + "bid/pricevalidation",
                        method: "POST",
                        data: {
                            price: function () {
                                return $(formId).find('input[name=bid_price]').val();
                            },
                            id: function () {
                                return $(formId).find('input[name=product_id]').val();
                            }
                        }
                    }
                },
                bid_quantity: {
                    required: true,
                    digits: true,
                    remote: {
                        url: baseUrl + "bid/qtyvalidation",
                        method: "POST",
                        data: {
                            price: function () {
                                return $(formId).find('input[name=bid_quantity]').val();
                            },
                            id: function () {
                                return $(formId).find('input[name=product_id]').val();
                            }
                        }
                    }
                }
            },
            messages: {
                bid_price: {
                    required: "(This field is required.)",
                    remote: "(Please enter the min. reserved price.)"
                },
                bid_quantity: {
                    required: "(This field is required.)",
                    remote: "(Please enter at least total offer quantity.)"
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
                        left: '40%'
                    },
                    message: '<img src="../../../backend/img/loading-big.gif" width="64"/>',
                    baseZ: 1050
                });

                form.submit();
            }

        });

    };

    /**
     * delete click event
     */
    $(document).on('click', '.bid-cancel-btn', function () {
        // Get the record's id via attribute
        var id = $(this).attr('data-id');
        var modelId = $('#bidCancelModal');
        modelId.find('#bid-id').val(id);
    });

    /**
     * delete yes click event
     */
    $('.bid-cancel-yes-btn').on('click', function () {
        var modelId = $('#bidCancelModal');
        var id = modelId.find('#bid-id').val();
        $bid.cancel(id, function (data) {
            modelId.modal('hide');
            $('.bid-success-message').html(data.message).show();
            setTimeout(function () {
                window.location.reload();
            }, 800);

        }, function (error) {
            if (error) {
                console.log(error);
            }
        });
    });

    /**
     * ajax call for cancel bid information
     * @param {integer} id
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $bid.cancel = function (id, successCallBack, errorCallBack) {
        var bidUrl = baseUrl + "mybid/cancel/" + id;
        $.ajax({
            url: bidUrl,
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

    $('form').each(function () {
        $bid.validation(this);
    });

})(auction.bid = auction.bid || {}, auction.common);