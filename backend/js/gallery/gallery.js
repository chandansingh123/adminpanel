/* gallery.js
 * ===========================
 * Gallery module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($gallery, $common) {
    "use strict";
    
    var baseUrl = $common.getBaseUrl();

    /**
     * validation initializer
     * @param {string} formId 
     */
    $gallery.validation = function (formId, isNew = false) {
        $(formId).validate({
            rules: {
                title: {
                    required: true,
                    remote: {
                        url: baseUrl + "gallery/availability",
                        method: "POST",
                        data: {
                            title: function () {
                                return $(formId + ' :input[name=title]').val();
                            },
                            id: function () {
                                return $(formId + ' :input[name=id]').val();
                            }
                        }
                    }
                },
                file_name: {
                    required: isNew,
                    filesize: true,
                    extension: "jpg|png|jpeg"
                }
            },
            messages: {
                title: {
                    required: "(This field is required.)",
                    remote: "(Title already exists in system.)"
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

    /**
     * delete click event
     */
    $(document).on('click', '.gallery-delete-btn', function () {
        // Get the record's id via attribute
        var id = $(this).attr('data-id');
        var modelId = $('#galleryDeleteModal');
        modelId.find('#gallery-id').val(id);
    });

    /**
     * delete yes click event
     */
    $('.gallery-delete-yes-btn').on('click', function () {
        var modelId = $('#galleryDeleteModal');
        var id = modelId.find('#gallery-id').val();
        $gallery.delete(id, function (data) {
            modelId.modal('hide');
            $('.gallery-list-success-message').html(data.message).show();
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
     * ajax call for delete gallery information
     * @param {integer} id
     * @param {function} successCallBack
     * @param {function} errorCallBack
     */
    $gallery.delete = function (id, successCallBack, errorCallBack) {
        var galleryUrl = baseUrl + "gallery/destroy/" + id;
        $.ajax({
            url: galleryUrl,
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

    $gallery.validation("#gallery-add-form", true);
    $gallery.validation('#gallery-edit-form');


})(auction.gallery = auction.gallery || {}, auction.common);