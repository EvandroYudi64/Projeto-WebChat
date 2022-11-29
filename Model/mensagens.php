<?php
session_start();
include_once("../conexao.php");
if(isset($_POST['send'])){
    $outgoing = mysqli_real_escape_string($conexao, $_POST['saida']);
    $incoming = mysqli_real_escape_string($conexao, $_POST['entrada']);
    $messages = mysqli_real_escape_string($conexao, $_POST['typingField']);

    $saveMsgQuery = "INSERT INTO `mensagem` (saida,entrada,messagens) VALUES('$outgoing','$incoming', '$messages')";
    $runSaveQuery = mysqli_query($conexao, $saveMsgQuery);
    header("location : ../View/perfil.php");
    if(!$runSaveQuery){
        header("location : ../View/perfil.php");
    }
    
}
?>