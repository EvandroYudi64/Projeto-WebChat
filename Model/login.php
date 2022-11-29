<?php
session_start();
include("../conexao.php");

if(isset($_POST['login'])){
    // store email
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    // store password
    $senha = md5($_POST['senha']);

    // check email is unique or not
    $emailQuery = "SELECT * FROM `usuario` WHERE email = '$email'";
    $runEmailQuery = mysqli_query($conexao, $emailQuery);

    $get_idQ = "SELECT `usuario_id` as sd FROM `usuario` WHERE email = '$email'";

    $id_user = mysqli_query($conexao, $get_idQ);
    $row = mysqli_fetch_array($id_user);
    $id_usuario = $row['sd'];

    if(!$runEmailQuery){
        echo "Query Failed";
    }else{
        if(mysqli_num_rows($runEmailQuery) > 0){
            $passwordQuery = "SELECT * FROM `usuario` WHERE email = '$email' AND senha = '$senha'";
            $runPasswordQuery = mysqli_query($conexao, $passwordQuery);

            if(!$runPasswordQuery){
                echo "Query Failed";
            }else{
                if(mysqli_num_rows($runPasswordQuery) > 0){
                    $fetchData = mysqli_fetch_assoc($runPasswordQuery);
                    // update status
                    $status = "Online";

                    // status query
                    $statusQuery = "UPDATE usuario SET status = '{$status}' WHERE usuario_id = '{$id_usuario}'";
                    $runStatusQuery = mysqli_query($conexao, $statusQuery);
                    if(!$runStatusQuery){
                        echo "failed while updating status";
                    }else{
                        $_SESSION['id'] = $id_usuario;
                        header("location: ../View/contatos.php");
                    }
                }else{
                    echo "Password not matched";
                }
            }
        }else{
            echo "Invalid email address";
        }
    }
}
?>