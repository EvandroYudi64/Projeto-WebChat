<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Login</title>
</head>
<body>
    
    <div class="main" style="font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;">
        <div class="logo">
            <h1>Butterchat<br></h1>
            <img src="../img/svg112220-ypi.png"/>
        </div>
        <form action="../Model/login.php" method="POST" id="DadosLogin">
            <div class="form">
                <div class="card">
                    <h1 style="color: rgb(214, 70, 230);">Bem vindo!</h1>
                    <!--<div class="erromsg">Mensagem de erro</div>-->
                    <div class="txtfield">
                        <label for="email" style="font-weight: bold;color:rgb(214, 70, 230);">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="txtfield">
                        <label for="senha"style="font-weight: bold;color:rgb(214, 70, 230);">Senha</label>
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