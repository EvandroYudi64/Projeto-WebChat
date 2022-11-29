<?php
session_start();
include("../conexao.php");
if(isset($_POST['cadastro'])){
    if(empty($_POST['nome']) || empty($_POST['sobrenome']) || empty($_POST['email']) || empty($_POST['senha']) || empty($_POST['confirmasenha']) || empty($_FILES['imagem'])){
        echo "Todos os campos são necessários-";
        echo $_POST['nome']," ";
        echo $_POST['sobrenome']," ";
        echo $_POST['email']," ";
        echo $_POST['senha']," ";
        echo $_POST['confirmasenha']," ";
        echo $_POST['imagem']," ";
        echo $_FILES['imagem']," ";
    }else{
    
    $nome = mysqli_real_escape_string($conexao, $_POST["nome"]);
    
    $sobrenome = mysqli_real_escape_string($conexao, $_POST["sobrenome"]);
    
    $email = mysqli_real_escape_string($conexao, $_POST["email"]);

    
    $sqlEmail = "SELECT * FROM `usuario` WHERE email = '{$email}'";
    $Querymail = mysqli_query($conexao,$sqlEmail);

    if($Querymail){
        if(mysqli_num_rows($Querymail) > 0){
            echo "Email já existe";
        }else{
            if(strlen($_POST["senha"]) < 6 || strlen($_POST["confirmasenha"]) < 6){
                echo "Senha deve ter no minimo 6 caracteres";
            }else if($_POST["senha"] != $_POST['confirmasenha']){
                
                echo "Senhas diferentes";
            }else{
                
                $senha = md5($_POST["senha"]);



                $imagemNome = $_FILES['imagem']['name'];
                $imagemTam = $_FILES['size'];
                $imagemTempNome = $_FILES['imagem']['tmp_name'];
                $imageType = $_FILES['imagem']['type'];

                $explode = explode(".", $imagemNome);
                $lowercase = strtolower(end($explode));

                $extension = ["png","jpg","jpeg"];

                if(in_array($lowercase,$extension) == false){
                    echo "Extensão de imagem não compativel, porfavor use JPG or PNG.";
                }else{
                    $random = rand(999999999,111111111);
                    $time = time();

                    $uniqueImageName = $random . $time;

                    move_uploaded_file($imagemTempNome, "../img/" . $uniqueImageName);

                    // user status
                    $status = "Offline";

                    $insertQuery = "INSERT INTO `usuario` (nome,sobrenome,email,senha,foto,status)
                    VALUES('{$nome}','{$sobrenome}','{$email}','{$senha}','{$uniqueImageName}','{$status}')";

                    $runInsertQuery = mysqli_query($conexao, $insertQuery);
                    if(!$runInsertQuery){
                        echo "Erro de insert";
                    }else{
                        header("location: ../View/FormLogin.php");
                    }
                }
            }
        }
    }
    }
}