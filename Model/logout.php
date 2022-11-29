<?php
    session_start();
    if(isset($_SESSION['id'])){
        include_once "../conexao.php";
        $logout_id = mysqli_real_escape_string($conexao, $_GET['logout_id']);
        if(isset($logout_id)){
            $status = "Offline";
            $sql = mysqli_query($conexao, "UPDATE usuario SET status = '{$status}' WHERE usuario_id={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../View/FormLogin.php");
            }
        }else{
            header("location: ../View/contatos.php");
        }
    }else{  
        header("location: ../View/FormLogin.php");
    }
?>