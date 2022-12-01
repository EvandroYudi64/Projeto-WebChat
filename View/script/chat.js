$(document).ready(function(){
    setInterval(function(){
        let incomingid = $("#entrada").val();
        $.ajax({
            type: "post",
            url: "../Model/getChat.php",
            data: {incomingid: incomingid},
            success: function(response){
                $("#mainSection").html(response);
            }
        });
    }, 500);
});