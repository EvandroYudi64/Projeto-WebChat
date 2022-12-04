$(document).ready(function(){
    setInterval(function(){
        let entrada = $("#entrada").val();
        $.ajax({
            type: "post",
            url: "../Model/chat.php",
            data: {entrada: entrada},
            success: function(response){
                $("#mainSection").html(response);
            }
        });
    }, 500);
});