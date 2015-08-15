(function ($) {
    $(document).ready(function () {
        //alert($("div[role*='contentinfo']").text);
        if ($(".messages").html().trim() == "") {
            $(".messages").css("display", "none");
        }
    });
})(jQuery);