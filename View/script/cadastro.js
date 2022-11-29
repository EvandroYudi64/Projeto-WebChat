$(document).ready(function(){
    $("#DadosCad").on("submit", function(e){
        e.preventDefault();
    
        let DadosForm = new FormData(this);
        DadosForm.append("cadastro","cadastro");

        $.ajax({
           
            type: "POST",
            
            url: "../Model/cadastrar.php",
            data: DadosForm,
            contentType: false,
            processData: false,
            
            success: function(response){
                if(response == "sucess"){
                    location.href = "FormLogin.php";
                }else{
                    $("#erromsg").css("display", "block");
                    $("#erromsg").html(response);
                }
            }
        });
    });
});