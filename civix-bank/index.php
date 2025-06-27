<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Civix Bank - Entre na sua conta</title>
    <link rel="stylesheet" href="./css/index-css.css">
</head>
<body>
    <div class="main-page">

    <img src="./img/logo-civix-bank.png" alt="">

        <form action="./scripts/script-login.php" method="post">
            <div class="input-box">
                <label>Conta*</label>
                <input type="text" name="conta" placeholder="Digite o Nº da conta...">
            </div>

            <div class="input-box">
                <label>Senha da Conta*</label>
                <input type="password" name="senha" placeholder="Digite a senha...">
            </div>

            <div class="input-box">
                <a href="#">Crie sua conta</a>
            </div>

            <div class="button-box">
                <button type="submit">Acessar</button> 
                <!-- alterar depois -->
            </div>
            
        </form>

    </div>
    <footer>
        <img src="./img/cynex-logo-white.png" alt="">
        <p>&copy 2025 Civix Bank - Todos os direitos reservados.</p>
    </footer>
</body>
</html>