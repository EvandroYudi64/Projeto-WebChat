$(document).ready(function () {
    setInterval(function () {
        $.ajax({
            url: "../Model/listacontatos.php",
            type: "POST",
            success: function (data) {
                $("#contatosOn").html(data);
            }
        });
    }, 500);
});