$(document).ready(function() {
    $(".pubmobilebx1").each( function(){
        var container = $(this);
        $.ajax({url: "/wp-content/themes/BX1-2017-APP/includes/loadads.php", success: function(result){
                container.html(result);
            }});
        setTimeout(function () {
        }, 500);
    });
});