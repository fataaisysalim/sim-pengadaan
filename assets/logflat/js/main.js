$(document).on("animating.slides", function (a) {
    setTimeout(function () {
        'use strict';
        $("h1.fittext").fitText(1, {minFontSize: "50px", maxFontSize: "100px"});
        $("h2.fittext").fitText(1, {minFontSize: "40px", maxFontSize: "80px"});
        $("h3.fittext").fitText(1, {minFontSize: "30px", maxFontSize: "60px"});
        $("h4.fittext").fitText(1, {minFontSize: "20px", maxFontSize: "40px"});
        $("h5.fittext").fitText(1, {minFontSize: "15px", maxFontSize: "30px"});
        $("h6.fittext").fitText(1, {minFontSize: "10px", maxFontSize: "20px"});
    }, 200);
});

$("#slides").superslides({
    animation: "fade",
    pagination: true
});

window.onload = function () {
    $('.ba-slider').beforeAfter();
};

$(function () {
    'use strict';
    $('#container').beforeAfter();
    $('#container1').beforeAfter();

});