<?php
session_start();
include("../conexao.php");
if(isset($_POST['salvar']))
{
    $sql = mysqli_query($conexao,"SELECT nome, sobrenome,Bio,foto FROM `usuario` WHERE usuario_id = '{$_SESSION['id']}'");
    $row=mysqli_fetch_array($sql);
    if(empty($_POST["nome"]))
    {
        $nome = $row['nome'];

    }
    else
    {
        $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    } 
    if(empty($_POST["sobrenome"]))
    {
        $sobrenome = $row['sobrenome'];
    }
    else
    {
        $sobrenome = mysqli_real_escape_string($conexao, $_POST["sobrenome"]);  
    }
    if(empty($_POST["bio"]))
    {
        $Bio = $row['Bio'];
    }
    else
    {
        $Bio = mysqli_real_escape_string($conexao, $_POST["bio"]);
    }
    if($_FILES['imagem']['error'] == 4)
    {
        $foto = $row['foto'];
        $salvar= "UPDATE usuario SET nome = '{$nome}', sobrenome = '{$sobrenome}', Bio = '{$Bio}', foto = '{$foto}' WHERE usuario_id = '{$_SESSION['id']}'";
        $sqlsalvar = mysqli_query($conexao,$salvar);
        if(!$sqlsalvar)
        {
            echo "Erro de cadastro";
        }
        else
        {
            header("location: ../View/perfil.php");
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
            echo "Extensão de imagem não compativel, porfavor use JPG or PNG.";
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