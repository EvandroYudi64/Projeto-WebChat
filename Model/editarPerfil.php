<?php
session_start();
include("../conexao.php");
if(isset($_POST['salvar']))
{
    if(empty($_POST["nome"]))
    {
        $sqlnome = mysqli_query($conexao,"SELECT nome FROM `usuario` WHERE usuario_id = '{$_SESSION['id']}'");
        $nome = $sqlnome;
    }
    else
    {
        $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    } 
    if(empty($_POST["sobrenome"]))
    {
        $sqlsobrenome = mysqli_query($conexao,"SELECT sobrenome FROM `usuario` WHERE usuario_id = '{$_SESSION['id']}'");
        $sobrenome = $sqlsobrenome;
    }
    else
    {
        $sobrenome = mysqli_real_escape_string($conexao, $_POST["sobrenome"]);  
    }
    if(empty($_POST["bio"]))
    {
        $sqlbio = mysqli_query($conexao,"SELECT Bio FROM `usuario` WHERE usuario_id = '{$_SESSION['id']}'");
        $Bio = $sqlbio;
    }
    else
    {
        $Bio = mysqli_real_escape_string($conexao, $_POST["bio"]);
    }
    if(empty($_FILES["imagem"]))
    {
        $sqlfoto = mysqli_query($conexao,"SELECT foto FROM `usuario` WHERE usuario_id = '{$_SESSION['id']}'");
        $foto = $sqlfoto;
        $salvar= "UPDATE usuario SET nome = '{$nome}', sobrenome = '{$sobrenome}', Bio = '{$Bio}', foto = '{$foto}' WHERE usuario_id = '{$_SESSION['id']}'";
        $sqlsalvar = mysqli_query($conexao,$salvar);
        if(!$sqlCad)
        {
            echo "Erro de cadastro";
        }
        else
        {
            header("location: ../View/FormLogin.php");
        }
    }
    else
    {   
        $imagemNome = $_FILES['imagem']['name'];
        $imagemTempNome = $_FILES['imagem']['tmp_name'];
        $imageType = $_FILES['imagem']['type'];
    
        $explode = explode(".", $imagemNome);
        $diminui = strtolower(end($explode));
    
        $extensão = ["png","jpg","jpeg"];
    
        if(in_array($diminui,$extensão) == false)
        {
            echo "Extensão de imagem não compativel";
        }else
        {
            $random = rand(999999999,111111111);
            move_uploaded_file($imagemTempNome, "../img/" . $random);
            $salvar= "UPDATE usuario SET nome = '{$nome}', sobrenome = '{$sobrenome}', Bio = '{$Bio}', foto = '{$random}' WHERE usuario_id = '{$_SESSION['id']}'";
            $sqlsalvar = mysqli_query($conexao,$salvar);
            if(!$sqlsalvar)
            {
                echo "Erro de update";
            }
            else
            {
                header("location: ../View/perfil.php");
            }
        }
    }
    
}