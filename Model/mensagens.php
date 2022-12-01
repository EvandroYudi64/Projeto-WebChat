<?php
session_start();
include_once("../conexao.php");
if(isset($_POST['send'])){
    $saida = mysqli_real_escape_string($conexao, $_POST['saida']);
    $entrada= mysqli_real_escape_string($conexao, $_POST['entrada']);
    $mensagem = mysqli_real_escape_string($conexao, $_POST['typingField']);

    $sql = mysqli_query($conexao, "INSERT INTO `mensagem` (saida,entrada,messagens) VALUES('$saida','$entrada', '$mensagem')");
    header("location : ../View/perfil.php");
    if(!$sql)
    {
        header("location : ../View/perfil.php");
    }
    
}
?>