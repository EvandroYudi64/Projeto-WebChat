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
			<a href="../Model/logout.php?logout_id=<?php echo $dados['usuario_id']; ?>" class="logout">Sair</a>
		</header>
        <br>
		<div class="users-list" id="contatosOn" style="height: 100%;">
				
		</div>
		</section>
    </div>
    <div class="wrapper" style="width: 70vw; max-width:100%;">
        <section class="chat-area">
            <header>
            <header>
                <?php
                $myid = $_SESSION['id'];
                if(!isset($_GET['usuario_id'])){
                    ?>
                    <div class="semusuario" style="height: 85vh;">
                        <h1>Selecione um contato para iniciar uma conversa</h1>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="./script/mensagem.js"></script>
    <script src="./script/chat.js"></script>
    <script src="./script/usuarios.js"></script>
</body>

</html>