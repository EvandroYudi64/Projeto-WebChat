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
    <link rel="stylesheet" href="./css/chatareas.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div class="contatos" style="background: #fff; width: 30vw; border-radius: 20px 0 0 20px;">
        <div class="voce" style="width: 100%;padding-top:10px;">
            <header style="border-bottom: 2px solid pink; border-radius:5px;">
                <div class="conteudo"><!--conteudo-->
                <?php 
                    $perfilQ = "SELECT * FROM `usuario` WHERE usuario_id = '{$_SESSION["id"]}'";
                    $sql = mysqli_query($conexao, $perfilQ);
                    if(!$perfilQ){
                        echo "conexao falhou";
                    }else{
                            $dados = mysqli_fetch_assoc($sql);
                    }
                ?>
            
                <img src="../img/<?php echo $dados['foto']; ?>" alt="" style="width:100px;height:100px;border:3px solid rgb(237, 86, 206);">
                <div class="dados"><!--dados-->
                    <h3><?php echo $dados['nome']. " " . $dados['sobrenome'] ?></h3>
                    <p><?php echo $dados['status']; ?></p>
                </div>
                </div>
                <div class="" style="display:flex; align-items:center;height:100px; justify-content:space-between;">
                    <a href="perfil.php?usuario_id=<?php echo $_SESSION['id'];?>" class="perfil" style="padding-yop:10px;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                    </svg></a>
                    
                </div>
                <div style="display:flex; align-items:center;height:100px; justify-content:space-between;padding-right:10px;">
                    <a href="../Model/logout.php?logout_id=<?php echo $dados['usuario_id']; ?>" class="logout">Sair</a>
                </div>
            </header>
            <div class="" style="text-align: center; border: 1px solid pink;background-color: rgb(237, 86, 206);color:white;">
                <h2>Contatos:</h2>
            </div>
        </div>
        <section class="usuarios" style="width: 100%; border-radius:0;">
            <div class="erromsg"id="erromsg" hidden></div>
            <div class="listacont" id="contatosOn" style="height: 700px;">
                    <!---lista de usuarios-->
            </div>
		</section>
        <div style="background-color: rgb(237, 86, 206); height:80px;padding:0px;border-radius:0 0 0 20px;">

        </div>
    </div>
    <div class="mainchat" style="width: 60vw; max-width:100%;border-radius:0;height:93.5vh;max-height:93.5vh">
        <section class="chatmain">
            <header>
                <?php
                $sessao = $_SESSION['id'];
                if(!isset($_GET['usuario_id']))
                {
                    ?>
                    <div class="semusuario" style="height: 85vh;">
                        <h1 style="text-align:center;">Selecione um contato para iniciar uma conversa</h1>
                        <img src="../img/Sent Message-bro.svg" alt="" >
                    </div>
                <?php
                }
                else
                {
                    $receptor_id = mysqli_real_escape_string($conexao, $_GET['usuario_id']);
                    $sqlcontato = mysqli_query($conexao, "SELECT * FROM `usuario` WHERE usuario_id = '{$receptor_id}'");
                    if(!$sqlcontato) 
                    {
                        echo "Falhou";
                    } 
                    else 
                    {
                        $info = mysqli_fetch_assoc($sqlcontato);
                    ?>
                        <img src="../img/<?php echo $info['foto']; ?>" alt="" style="border: 3px solid rgb(237, 86, 206);">
                        <div id="details">
                            <h3 id="name"><?php echo $info['nome'] . " " . $info['sobrenome']; ?></h3>
                            <p id="status"><?php echo $info['status']; ?></p>
                        </div>
                    <?php
                        }
                    
                    ?>
                    </header>
                </section>
                    <div id="mainSection" class="mensagenschat">
                        <!-- mensagens-->
                    </div>
                    <form action="" id="typingArea">
                    <div class="barra">
                        <input type="text" name="saida" placeholder="Escreva sua mensagem aqui" id="saida"  autocomplete="off" value="<?php echo $sessao; ?>" hidden>
                        <input type="text" name="entrada" placeholder="Escreva sua mensagem aqui" id="entrada"  autocomplete="off" value="<?php echo $receptor_id?>" hidden>
                        <input type="text" name="typingField" placeholder="Escreva sua mensagem aqui" id="typingField" autocomplete="off">
                            <input type="submit" value="Enviar" id="sendMessage" style="background-color: rgb(237, 86, 206) ; color:#fff; max-width: 150px;border-radius:5px"></input>
                        
                    </div>
                    </form>
                    <?php
                }
                ?>
            
    </div>
    <div class="perfilusuario" style="background: #fff; width: 10vw;height:93.5vh; border-radius: 0 20px 20px 0;align-items:center;padding:10px;border:5px solid rgb(237, 86, 206);">
                <section style="align-items: center;">
                    <?php
                            if(!isset($_GET['usuario_id']))
                            {
                                $perfilQ = "SELECT * FROM `usuario` WHERE usuario_id = '{$_SESSION['id']}'";
                                $sql = mysqli_query($conexao, $perfilQ);
                                if(!$perfilQ)
                                {
                                    echo "conexao falhou";
                                }
                                else
                                {
                                        $dados = mysqli_fetch_assoc($sql);
                                }
                                ?>
                                <img src="../img/<?php echo $dados['foto']; ?>" alt="" style="object-fit: cover;border-radius: 50%;border: 3px solid rgb(237, 86, 206);width:120px;height:120px;">
                                <h1 style="color: gray;"><?php echo $dados['nome']." ".$dados['sobrenome']?></h1>
                                <div class="txtfield">
                                <label for="Bio" style="font-style: italic; font-weight:bold;">"<?php echo $dados['Bio']?>"</label>
                                </div>
                            <?php
                            }
                            else
                            {
                                $perfilQ = "SELECT * FROM `usuario` WHERE usuario_id = '{$_GET['usuario_id']}'";
                                $sql = mysqli_query($conexao, $perfilQ);
                                if(!$perfilQ)
                                {
                                    echo "conexao falhou";
                                }
                                else
                                {
                                        $dados = mysqli_fetch_assoc($sql);
                                }
                                ?>
                                <img src="../img/<?php echo $dados['foto']; ?>" alt="" style="object-fit: cover;border-radius: 50%;border: 3px solid rgb(237, 86, 206);width:120px;height:120px;">
                                <h1 style="color: gray;"><?php echo $dados['nome']." ".$dados['sobrenome']?></h1>
                                <div class="txtfield">
                                <label for="Bio" style="font-style: italic; font-weight:bold;">"<?php echo $dados['Bio']?>"</label>
                                </div>
                                <?php
                            }
                        ?> 
                </section>
                    
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./script/mensagem.js"></script>
    <script src="./script/chat.js"></script>
    <script src="./script/usuarios.js"></script>
</body>

</html>
