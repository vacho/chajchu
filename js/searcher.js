(function ($) {
    $(document).ready(function () {
        //@todo remove this and solve
        if ($(".messages").html().trim() == "") {
            $(".messages").css("display", "none");
        }

        //@todo on press enter into searcher
        /*
         $("#busqueda").keyup(function(event){
         if(event.keyCode == 13){
         //$("#edit-offer").trigger("click");
         $("#edit-offer").submit();
         //document.getElementById('edit-offer').submit();
         console.log("hola");
         return false
         }
         });
         */
    });
})(jQuery);