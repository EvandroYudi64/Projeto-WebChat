<?php
session_start();
include("../conexao.php");

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = md5($_POST['senha']);
    $emailQuery = "SELECT * FROM `usuario` WHERE email = '$email'";
    $runEmailQuery = mysqli_query($conexao, $emailQuery);

    $get_idQ = "SELECT `usuario_id` as sd FROM `usuario` WHERE email = '$email'";

    $id_user = mysqli_query($conexao, $get_idQ);
    $row = mysqli_fetch_array($id_user);
    $id_usuario = $row['sd'];

    if(!$runEmailQuery){
        echo "erro";
    }else{
        if(mysqli_num_rows($runEmailQuery) > 0){
            $passwordQuery = "SELECT * FROM `usuario` WHERE email = '$email' AND senha = '$senha'";
            $runPasswordQuery = mysqli_query($conexao, $passwordQuery);

            if(!$runPasswordQuery){
                echo "erro";
            }else{
                if(mysqli_num_rows($runPasswordQuery) > 0){
                    $fetchData = mysqli_fetch_assoc($runPasswordQuery);
                    $status = "Online";
                    $statusBol = 1;
                    $statusQuery = "UPDATE usuario SET status = '{$status}', statusBol = '{$statusBol}' WHERE usuario_id = '{$id_usuario}'";
                    $runStatusQuery = mysqli_query($conexao, $statusQuery);
                    if(!$runStatusQuery){
                        echo "erro";
                    }else{
                        $_SESSION['id'] = $id_usuario;
                        header("location: ../View/mensagem.php");
                    }
                }else{
                    echo "Senha errada";
                }
            }
        }else{
            echo "Email errado";
        }
    }
}
?>