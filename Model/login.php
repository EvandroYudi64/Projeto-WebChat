<?php
session_start();
include("../conexao.php");

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = md5($_POST['senha']);
    $sql = "SELECT * FROM `usuario` WHERE email = '$email'";
    $sqlquery = mysqli_query($conexao, $sql);

    $get_idQ = "SELECT `usuario_id` as sd FROM `usuario` WHERE email = '$email'";

    $usuario_id = mysqli_query($conexao, $get_idQ);
    $row = mysqli_fetch_array($usuario_id);
    $id_usuario = $row['sd'];

    if(!$sqlquery){
        echo "erro";
    }else{
        if(mysqli_num_rows($sqlquery) > 0){
            $senhaQ = "SELECT * FROM `usuario` WHERE email = '$email' AND senha = '$senha'";
            $senhaquery = mysqli_query($conexao, $senhaQ);

            if(!$senhaquery){
                echo "erro";
            }else{
                if(mysqli_num_rows($senhaquery) > 0){
                    $dados = mysqli_fetch_assoc($senhaquery);
                    $status = "Online";
                    $sqlstatus= "UPDATE usuario SET status = '{$status}' WHERE usuario_id = '{$id_usuario}'";
                    $sqlstatusQ = mysqli_query($conexao, $sqlstatus);
                    if(!$sqlstatusQ){
                        echo "erro";
                    }else{
                        $_SESSION['id'] = $id_usuario;
                        header("location: ../View/mensagem.php");
                    }
                }else{
                    echo "Senha incorreta";
                }
            }
        }else{
            echo "Email invalido";
        }
    }
}
?>