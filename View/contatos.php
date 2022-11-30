<?php
include_once("../conexao.php");
session_start();
if(!isset($_SESSION['id'])){
    header("location: FormLogin.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Chat In RealTime</title>
		
		<link rel="stylesheet" href="./css/chatarea.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
	</head>
	
	<body>
	<div class="wrapper">
		<section class="users">
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
		<div class="users-list" id="contatosOn">
				
		</div>
		</section>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="script/usuarios.js"></script>

	</body>
</html>