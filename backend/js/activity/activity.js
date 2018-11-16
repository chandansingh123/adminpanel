/* activity.js
 * ===========================
 * Activity module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($activity, $common) {
    "use strict";
    
    var baseUrl = $common.getBaseUrl();

    /**
     * validation initializer
     * @param {string} formId 
     */
    $activity.validation = function (formId) {
        $(formId).validate({
            rules: {
                name: {
                    required: true
                },
                description: {
                    required: true
                },
                activity_date: {
                    required: true
                }
            },
            messages: {
                name: {
                    required: "(This field is required.)"
                },
                description: {
                    required: "(This field is required.)"
                },
                activity_date: {
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
    $(document).on('click', '.activity-delete-btn', function () {
        // Get the record's id via attribute
        var id = $(this).attr('data-id');
        var modelId = $('#activityDeleteModal');
        modelId.find('#activity-id').val(id);
    });

    /**
     * delete yes click event
     */
    $('.activity-delete-yes-btn').on('click', function () {
        var modelId = $('#activityDeleteModal');
        var id = modelId.find('#activity-id').val();
        $activity.delete(id, function (data) {
            modelId.modal('hide');
            $('.activity-list-success-message').html(data.message).show();
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
     * ajax call for delete activity information
     * @param {integer} id
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $activity.delete = function (id, successCallBack, errorCallBack) {
        var activityUrl = baseUrl + "activity/destroy/" + id;
        $.ajax({
            url: activityUrl,
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

    $activity.validation("#activity-add-form");
    $activity.validation("#activity-edit-form");


})(auction.activity = auction.activity || {}, auction.common);