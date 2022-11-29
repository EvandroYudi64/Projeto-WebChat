$(document).ready(function()
{
    $("#DadosLogin").on("submit", function(e)
    {
        e.preventDefault();
        

        let DadosForm = new FormData(this);
        DadosForm.append("login","login");

    
        $.ajax({
            type: "POST",
           
            url: "../Model/login.php",
            data: DadosForm,
            contentType: false,
            processData: false,
            
            success: function(response){
                if(response == "Hello"){
                    location.href = "contatos.php";
                }else{
                    $("#errors").css("display", "block");
                    $("#errors").html(response);
                }
            }
        });
    });
});