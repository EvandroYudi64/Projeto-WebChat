$(document).ready(function(){
    $("#typingArea").on("submit", function(e) {
    e.preventDefault();
        let formDados = new FormData(this);
        formDados.append("send","send");
        if($("#typingField").val())
        $.ajax({
            type: "POST",
            url: "../Model/mensagens.php",
            data: formDados,
            contentType: false,
            processData: false,
            success: function (response) {
                
            }
        });
        $("#mainSection").scrollTop($("#mainSection")[0].scrollHeight);
        $("#typingField").val("");
    });
});