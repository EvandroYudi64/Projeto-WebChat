<?php
    session_start();
    if(isset($_SESSION['id']))
    {
        include_once "../conexao.php";
        $sair = mysqli_real_escape_string($conexao, $_GET['logout_id']);
        if(isset($sair))
        {
            $status = "Offline";
            $statusBol = 0;
            $sql = mysqli_query($conexao, "UPDATE usuario SET status = '{$status}', statusBol='{$statusBol}' WHERE usuario_id={$_GET['logout_id']}");
            if($sql){
                session_unset();
                session_destroy();
                header("location: ../View/FormLogin.php");
            }
        }
        else
        {
            header("location: ../View/mensagem.php");
        }
    }
    else
    {  
        header("location: ../View/FormLogin.php");
    }
?>