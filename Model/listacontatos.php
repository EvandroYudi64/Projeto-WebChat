<?php
include_once("../conexao.php");
session_start();
$sql = "SELECT * FROM `usuario` WHERE usuario_id != '{$_SESSION["id"]} ORDER BY status DESC'";
$query = mysqli_query($conexao, $sql);

if(!$query){
    echo "conexao falhou";
}else{
    if(mysqli_num_rows($query) == 0){
        echo '<div id="errors">Nenhum contato disponivel</div>';
    }elseif(mysqli_num_rows($query) > 0){
        include_once("dados.php");
    }else{
        echo "Erro inesperado";
    }
}
?>