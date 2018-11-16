/* member.js
 * ==========================
 * Member module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($member, $common) {
    "use strict";
    
    var baseUrl = $common.getBaseUrl();

    /**
     * validation initializer
     * @param {string} formId 
     */
    $member.validation = function (formId, isNew = false) {
        $(formId).validate({
            rules: {
                first_name: {
                    required: true
                },
                last_name: {
                    required: true
                },
                photo: {
                    required: isNew,
                    filesize: true,
                    extension: "jpg|png|jpeg"
                }
            },
            messages: {
                first_name: {
                    required: "(This field is required.)"
                },
                last_name: {
                    required: "(This field is required.)"
                },
                photo: {
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

    /**
     * delete click event
     */
    $(document).on('click', '.member-delete-btn', function () {
        // Get the record's id via attribute
        var id = $(this).attr('data-id');
        var modelId = $('#memberDeleteModal');
        modelId.find('#member-id').val(id);
    });
    /**
     * delete yes click event
     */
    $('.member-delete-yes-btn').on('click', function () {
        var modelId = $('#memberDeleteModal');
        var id = modelId.find('#member-id').val();
        $member.delete(id, function (data) {
            modelId.modal('hide');
            $('.member-list-success-message').html(data.message).show();
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
     * ajax call for delete member information
     * @param {integer} id
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $member.delete = function (id, successCallBack, errorCallBack) {
        var memberUrl = baseUrl + "member/destroy/" + id;
        $.ajax({
            url: memberUrl,
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

    $member.validation("#member-add-form", true);
    $member.validation('#member-edit-form');


})(auction.member = auction.member || {}, auction.common);