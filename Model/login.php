<?php
session_start();
include("../conexao.php");

if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conexao, $_POST['email']);
    $senha = md5($_POST['senha']);
    $sql =  mysqli_query($conexao, "SELECT * FROM `usuario` WHERE email = '$email'");
    $sql2 = mysqli_query($conexao,"SELECT `usuario_id` FROM `usuario` WHERE email = '$email'");
    $row = mysqli_fetch_array($sql2);
    $id_usuario = $row['usuario_id'];

    if(!$sql)
    {
        echo "erro";
    }
    else
    {
        if(mysqli_num_rows($sql) > 0)
        {
            $sqlsenha = mysqli_query($conexao, "SELECT * FROM `usuario` WHERE email = '$email' AND senha = '$senha'");

            if(!$sqlsenha)
            {
                echo "erro";
            }
            else
            {
                if(mysqli_num_rows($sqlsenha) > 0)
                {
                    $dados = mysqli_fetch_assoc($sqlsenha);
                    $status = "Online";
                    $statusBol = 1;
                    $sql3 =  mysqli_query($conexao, "UPDATE usuario SET status = '{$status}', statusBol = '{$statusBol}' WHERE usuario_id = '{$id_usuario}'");
                    if(!$sql3)
                    {
                        echo "erro";
                    }
                    else
                    {
                        $_SESSION['id'] = $id_usuario;
                        header("location: ../View/mensagem.php");
                    }
                }
                else
                {
                    echo "Senha errada";
                }
            }
        }
        else
        {
            echo "Email errado";
        }
    }
}
?>