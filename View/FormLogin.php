<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Login</title>
</head>
<body>
    
    <div class="main">
        <div class="logo">
            <h1>Butterchat<br></h1>
            <img src="../img/svg112220-ypi.png"/>
        </div>
        <form action="../Model/login.php" method="POST" id="DadosLogin">
            <div class="form">
                <div class="card">
                    <h1>Bem vindo!</h1>
                    <!--<div class="erromsg">Mensagem de erro</div>-->
                    <div class="txtfield">
                        <label for="email">E-mail</label>
                        <input type="text" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="txtfield">
                        <label for="senha">Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha" required>
                    </div>
                    <button type="submit" class="btn-login" id="login" name="login" value="login">Login</button><br>
                    <div class="link">Não possui um cadastro? <a href="FormCadastro.php">Registrar-se</a></div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>
</html>