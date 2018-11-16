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
                reason: {
                    required: true
                }
            },
            messages: {
                reason: {
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
                        left: '40%',
                        top: '25%'
                    },
                    message: '<img src="/backend/img/loading-big.gif" width="64"/>',
                    baseZ: 1050
                });
                var bidFormData = $(formId).serialize();

                $bid.update(bidFormData, function (response) {
                    if (response.status === 'success') {
                        $('#bidStatusModal').modal('hide');
                        $.unblockUI();
                        setTimeout(function () {
                            window.location.reload();
                        }, 800);

                    }
                }, function (error) {
                    if (error) {
                        console.log(error);
                    }
                });

            }
        });
    };

    /**
     * delete click event
     */
    $(document).on('click', '.bid-status-btn', function () {
        // Get the record's id via attribute
        var id = $(this).attr('data-id');
        var modelId = $('#bidStatusModal');
        modelId.find('#id').val(id);
    });

    //Flat red color scheme for iCheck
    $('input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    /**
     * ajax call for update bid information
     * @param {array} bidFormData
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $bid.update = function (bidFormData, successCallBack, errorCallBack) {
        var bidUrl = baseUrl + "bid/update";
        $.ajax({
            url: bidUrl,
            method: "POST",
            data: bidFormData,
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

    $bid.validation("#bid-status-form");


})(auction.bid = auction.bid || {}, auction.common);