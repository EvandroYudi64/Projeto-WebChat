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
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
    </svg>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
</head>

<body>
    <div class="contatos" style="background: #fff; width: 30vw; border-radius: 16px;border: 1px solid pink;">
        <section class="users" style="width: 100%; border-radius:16px;">
		<header>
			<div class="content">
			<?php 
				$perfilQ = "SELECT * FROM `usuario` WHERE usuario_id = '{$_SESSION["id"]}'";
				$sql = mysqli_query($conexao, $perfilQ);
				if(!$perfilQ){
            		echo "conexao falhou";
       			}else{
           				 $dados = mysqli_fetch_assoc($sql);
				}
			?>
		
			<img src="../img/<?php echo $dados['foto']; ?>" alt="">
			<div class="details">
				<span><?php echo $dados['nome']. " " . $dados['sobrenome'] ?></span>
				<p><?php echo $dados['status']; ?></p>
			</div>
			</div>
            <a href="perfil.php?usuario_id=<?php echo $_SESSION['id'];?>" class="perfil"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
            </svg></a>
			<a href="../Model/logout.php?logout_id=<?php echo $dados['usuario_id']; ?>" class="logout">Sair</a>
		</header>
        <br>
		<div class="users-list" id="contatosOn" style="height: 100%;">
				
		</div>
		</section>
    </div>
    <div class="wrapper" style="width: 50vw; max-width:100%;">
        <section class="chat-area">
            <header>
            <header>
                <?php
                $myid = $_SESSION['id'];
                if(!isset($_GET['usuario_id'])){
                    ?>
                    <div class="semusuario" style="height: 85vh;">
                        <h1>Selecione um contato para iniciar uma conversa!!</h1>
                    </div>
                <?php
                }
                else{
                    $userid = mysqli_real_escape_string($conexao, $_GET['usuario_id']);

                    $headerQuery = "SELECT * FROM `usuario` WHERE usuario_id = '{$userid}'";
                    $runHeaderQuery = mysqli_query($conexao, $headerQuery);
    
                    if (!$runHeaderQuery) {
                        echo "Connection failed";
                    } else {
                        $info = mysqli_fetch_assoc($runHeaderQuery);
                    ?>
                        <img src="../img/<?php echo $info['foto']; ?>" alt="">
                        <div id="details">
                            <h3 id="name"><?php echo $info['nome'] . " " . $info['sobrenome']; ?></h3>
                            <p id="status"><?php echo $info['status']; ?></p>
                        </div>
                    <?php
                        }
                    
                    ?>
                    </header>
                </section>
                    <div id="mainSection" class="chat-box">
                    
                    </div>
                    <form action="" id="typingArea">
                    <div class="typing-area">
                        <input type="text" name="saida" placeholder="Escreva sua mensagem aqui" id="saida" class="outgoing_id" autocomplete="off" value="<?php echo $myid; ?>" hidden>
                        <input type="text" name="entrada" placeholder="Escreva sua mensagem aqui" id="entrada" class="incoming_id" autocomplete="off" value="<?php echo $userid?>" hidden>
                        <input type="text" name="typingField" placeholder="Escreva sua mensagem aqui" id="typingField" autocomplete="off">
                        <input type="submit" value="Enviar" id="sendMessage" style="background-color: rgb(237, 86, 206) ; color:#fff; max-width: 200px;">
                    </div>
                    </form>
                    <?php
                }
                ?>
            
    </div>
    <div class="perfilusuario" style="background: #fff; width: 20vw;height:93.5vh; border-radius: 16px;border: 1px solid pink;">
                    <?php
                        if(!isset($_GET['usuario_id']))
                        {
                            ?>
                            <div class="semusuario" style="height: 85vh;">
                                <h1>Perfil selecionado será exibido aqui</h1>
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
                            <img src="../img/<?php echo $dados['foto']; ?>" alt="" style="object-fit: cover;border-radius: 50%;border: 5px solid pink;width:120px;height:120px;">
                            <h1 style="color: gray;"><?php echo $dados['nome']." ".$dados['sobrenome']?></h1>
                            <div class="txtfield">
                            <label for="nome">Bio: <?php $dados['Bio']?></label>
                            </div>
                            <?php
                        }
                    ?> 
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./script/mensagem.js"></script>
    <script src="./script/chat.js"></script>
    <script src="./script/usuarios.js"></script>
</body>

</html>
