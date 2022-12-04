$(document).ready(function(){
    $("#DadosLogin").on("submit", function(e){
        e.preventDefault();
        Dados = new FormData(this);
        Dados.append("login","login");
        $.ajax({
            type: "POST",
            url: "../Model/login.php",
            data: Dados,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == "logado"){
                    location.href = "./mensagem.php";
                }else{
                    $("#erromsg").css("display", "block");
                    $("#erromsg").html(response);
                }
            }
        });
    });
});