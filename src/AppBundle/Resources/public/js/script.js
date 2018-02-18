var app = new Vue({
    el: "#app",
    delimiters: ['${', '}']
});

function synchroline() {
    var maxHeight = 0;
    $(".synchroline").each(function() {
        maxHeight = 0;
        $(this).find(".synchroelement, .synchroref").each(function() {
            $(this).css("height", "auto");
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight()
            }
        });
        $(this).find(".synchroelement, .synchrodest").each(function() {
            $(this).css("height", maxHeight)
        });
        if ($(this).hasClass("synchroline-no-flow")) {
            $(this).css("height", maxHeight)
        }
        maxHeight = 0;
        $(this).find(".synchroelement2, .synchroref2").each(function() {
            $(this).css("height", "auto");
            if ($(this).outerHeight() > maxHeight) {
                maxHeight = $(this).outerHeight()
            }
        });
        $(this).find(".synchroelement2, .synchrodest2").each(function() {
            $(this).css("height", maxHeight)
        });
        if ($(this).hasClass("synchroline-no-flow2")) {
            $(this).css("height", maxHeight)
        }
    });
}

$(document).ready(function(){
    setTimeout(function() {
        $("#title").append('<span class="title-addon"> avec JQuery !</span>')
    }, 2000);
});