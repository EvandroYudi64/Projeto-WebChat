<?php
session_start();
include("../conexao.php");
if(isset($_POST['cadastro']))
{
    if(empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmasenha']) || empty($_FILES['imagem']))
    {
        echo "Todos os campos são necessários-";
        echo $_POST['nome']," ";
        echo $_POST['sobrenome']," ";
        echo $_POST['email']," ";
        echo $_POST['senha']," ";
        echo $_POST['confirmasenha']," ";
        echo $_POST['imagem']," ";
        echo $_FILES['imagem']," ";
    }
    else
    {
        $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
        $sobrenome = mysqli_real_escape_string($conexao, $_POST["sobrenome"]);  
        $email = mysqli_real_escape_string($conexao, $_POST["email"]);
        $sqlEmail = mysqli_query($conexao,"SELECT * FROM `usuario` WHERE email = '{$email}'");

        if($sqlEmail)
        {
            if(mysqli_num_rows($sqlEmail) > 0)
            {
                echo "Email já existe";
            }
            else
            {
                if(strlen($_POST["senha"]) < 6 || strlen($_POST["confirmasenha"]) < 6)
                {
                    echo "Senha deve ter no minimo 6 caracteres";
                }
                else if($_POST["senha"] != $_POST['confirmasenha'])
                {
                    
                    echo "Senhas diferentes";
                }
                else
                {
                    $senha = md5($_POST["senha"]);

                    $imagemNome = $_FILES['imagem']['name'];
                    $imagemTam = $_FILES['size'];
                    $imagemTempNome = $_FILES['imagem']['tmp_name'];
                    $imageType = $_FILES['imagem']['type'];

                    $explode = explode(".", $imagemNome);
                    $diminui = strtolower(end($explode));

                    $extensão = ["png","jpg","jpeg"];

                    if(in_array($diminui,$extensão) == false)
                    {
                        echo "Extensão de imagem não compativel, porfavor use JPG or PNG.";
                    }else
                    {
                        $random = rand(999999999,111111111);
                        move_uploaded_file($imagemTempNome, "../img/" . $random);
                        $status = "Offline";
                        $statusBol = 0;
                        $sqlCad = mysqli_query($conexao, "INSERT INTO `usuario` (nome,sobrenome,email,senha,foto,status,statusBol) VALUES('{$nome}','{$sobrenome}','{$email}','{$senha}','{$random}','{$status}','{$statusBol}')");
                        if(!$sqlCad)
                        {
                            echo "Erro de cadastro";
                        }
                        else
                        {
                            header("location: ../View/FormLogin.php");
                        }
                    }
                }
            }
        }
    }
}