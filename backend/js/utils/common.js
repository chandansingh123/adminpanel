/* common.js
 * =========================
 * Common module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */
var auction = auction || {};

;(function ($common) {
    "use strict";

    /**
     * masked initializer
     */
    $common.masked = function () {
        $(".phone").mask("(999) 999-9999");
    };

    /**
     * custom phone validation
     */
    $common.phoneValidation = function () {
        $.validator.addMethod("phonerequired", function (value, element) {
                return value.replace(/\D+/g, '').length > 1;
            },
            "(This field is required.)");
    };


    /**
     * custom price validation
     */
    $common.priceValidation = function () {
        $.validator.addMethod("pricerequired", function (value, element) {
                return this.optional(element) || /^\d*(\.\d{2})?$/.test(value);
            },
            "Please enter a valid amount.");
    };

    /**
     * custom email validation
     */
    $common.emailValidation = function () {
        $.validator.addMethod("emailrequired", function (value, element) {
              return this.optional(element) || /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/.test(value);
          },
          "Please enter a valid email.");
    };

    /**
     * datepicker initializer
     */
    $common.initDatepicker = function () {

        $("#delivery_date").datepicker({dateFormat: 'yy-mm-dd', minDate : 0}).val();
        $("#closed_date").datepicker({dateFormat: 'yy-mm-dd', minDate : 0}).val();
        $("#activity_date").datepicker({dateFormat: 'yy-mm-dd', minDate : 0}).val();
    };

    /**
     * reset form after close or cancel bootstrap model
     */
    $common.resetFormMessage = function () {
        $('.modal').on('hidden.bs.modal', function () {
            if ($(this).find('form')[0] !== undefined) {
                $(this).find('form')[0].reset();
                var formID = $(this).find('form').attr('id');
                $('#' + formID).validate().resetForm();
                $('input[type=text], select, textarea').each(function () {
                    $(this).removeClass('has-error');
                });
                $('.form-group').find('.input-group').each(function () {
                    $(this).removeClass('has-error');
                });
                //for tab form
                $('.form-group').each(function () {
                    $(this).removeClass('has-error');
                });
            }
        });
    };

    /**
     * project base url
     */
    $common.getBaseUrl = function () {
        var baseUrl = location.protocol + "//" + location.host + "/";
        return baseUrl;
    };

    /**
     * format date
     * @param {string} date
     */
    $common.formatDate = function (date) {
        var d = new Date(date),
            month = '' + (d.getMonth() + 1),
            day = '' + d.getDate(),
            year = d.getFullYear();

        if (month.length < 2)
            month = '0' + month;
        if (day.length < 2)
            day = '0' + day;

        return [year, month, day].join('-');
    };

    /**
     * CSRF token verification for ajax request
     *
     */
    $common.ajaxCSRF = function () {
        $.ajaxSetup({
            headers: { 'X-CSRF-Token' : $('meta[name="csrf-token"]').attr('content') }
        });
    };



    $common.generateGUID = function () {
        var s4 = function() {
            return (((1+Math.random())*0x10000)|0).toString(16).substring(1);
        };
        return 'EXTRA-' +  s4() +  s4();
    };

    $common.masked();
    $common.initDatepicker();
    $common.phoneValidation();
    $common.priceValidation();
    $common.emailValidation();
    $common.resetFormMessage();

    $common.ajaxCSRF();

})(auction.common = auction.common || {});


