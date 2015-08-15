(function ($) {
    $(document).ready(function () {
        //@todo remove this and solve
        if ($(".messages").html().trim() == "") {
            $(".messages").css("display", "none");
        }
    });
})(jQuery);