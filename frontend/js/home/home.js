/* home.js
 * ===========================
 * Home module jquery code.
 *
 * @author  Krishna Prasad Timilsina
 * @email   <bikranshu.t@gmail.com>
 * @version 1.0
 */

$(function () {

    'use strict'

    $('.autoplay').slick({
        slidesToShow: 4,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 2000,
    });

});