
$(document).ready(function(){
    $("#DadosCad").on("submit", function(e){
        e.preventDefault();
        DadosCad = new FormData(this);
        DadosCad.append("cadastro","cadastro");
        $.ajax({
            type: "POST",
            url: "../Model/cadastrar.php",
            data: DadosCad,
            contentType: false,
            processData: false,
            success: function(response){
                if(response == "cadastrado"){
                    location.href = "./FormLogin.php";
                }else{
                    $("#erromsg").css("display", "block");
                    $("#erromsg").html(response);
                }
            }
        });
    });
});