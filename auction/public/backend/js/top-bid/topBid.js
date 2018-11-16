/* topBid.js
 * ===========================
 * Top Bid module jquery code
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($topBid, $common) {
    "use strict";
    
    var baseUrl = $common.getBaseUrl();

    /**
     * validation initializer
     * @param {string} formId 
     */
    $topBid.validation = function (formId) {
        $(formId).validate({
            rules: {
                name: {
                    required: true
                },
                quantity: {
                    required: true,
                    digits: true
                },
                price: {
                    required: true,
                    digits: true
                }
            },
            messages: {
                name: {
                    required: "(This field is required.)"
                },
                quantity: {
                    required: "(This field is required.)"
                },
                price: {
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
    $('input[type="checkbox"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

    /**
     * delete click event
     */
    $(document).on('click', '.bid-delete-btn', function () {
        // Get the record's id via attribute
        var id = $(this).attr('data-id');
        var modelId = $('#bidDeleteModal');
        modelId.find('#top-bid-id').val(id);
    });

    /**
     * delete yes click event
     */
    $('.bid-delete-yes-btn').on('click', function () {
        var modelId = $('#bidDeleteModal');
        var id = modelId.find('#top-bid-id').val();
        $topBid.delete(id, function (data) {
            modelId.modal('hide');
            $('.bid-list-success-message').html(data.message).show();
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
     * ajax call for delete bid information
     * @param {integer} id
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $topBid.delete = function (id, successCallBack, errorCallBack) {
        var bidUrl = baseUrl + "top-bid/destroy/" + id;
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

    $topBid.validation("#top-bid-add-form");
    $topBid.validation("#top-bid-edit-form");


})(auction.topBid = auction.topBid || {}, auction.common);