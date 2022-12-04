<?php
include_once("../conexao.php");
session_start();
if (!isset($_SESSION['id'])) {
    header("location: FormLogin.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Butterchat</title>
    <link rel="stylesheet" href="./css/chatarea.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>
<body>
        <form action="../Model/editarPerfil.php?usuario_id=<?php echo $_SESSION['id']?>" method="POST" enctype="multipart/form-data">
            <div class="form">
                <div class="card" style="background-color:#fff;">

                    <?php 
                        $perfilQ = "SELECT * FROM `usuario` WHERE usuario_id = '{$_SESSION["id"]}'";
                        $sql = mysqli_query($conexao, $perfilQ);
                        if(!$perfilQ){
                            echo "conexao falhou";
                        }else{
                                $dados = mysqli_fetch_assoc($sql);
                        }
                    ?>
                    <img src="../img/<?php echo $dados['foto']; ?>" alt="" style="object-fit: cover;border-radius: 50%;border: 5px solid rgb(237, 86, 206);width:120px;height:120px;">
                    <h1 style="color: gray;"><?php echo $dados['nome']." ".$dados['sobrenome']?></h1>
                    <div class="txtfield" style="align-items:center;">
                        <label for="alterarnome">Alterar nome:</label>
                        <input type="text" name="nome" id="sobrenome" placeholder="<?php echo$dados['nome'];?>" >
                    </div>
                    <div class="txtfield" style="align-items:center;">
                        <input type="text" name="sobrenome" id="sobrenome" placeholder="<?php echo$dados['sobrenome'];?>" >
                    </div>
                    <div class="txtfield" style="align-items:center;">
                        <label for="Bio" style="font-style: italic;">"<?php echo $dados['Bio']?>"</label>
                        <input type="text" name="bio" id="bio" placeholder="Bio" >
                    </div>
                    <div class="txtfield" style="align-items:center;">
                        <label for="foto" >Alterar foto de perfil:</label>
                        <input type="file" name="imagem" id="imagem">
                    </div>
                    <a href="mensagem.php" class="btn-login" style="justify-content: center; text-align:center;">Voltar</a>
                    <button type="submit" class="btn-login" id="salvar" name="salvar" value="salvar" style="background-color: rgb(237, 86, 206);color:#fff;">Salvar</button><br>
                </div>
            </div>
        </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>
