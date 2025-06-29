<?php
session_start();

if($_SESSION['sessao-logada'] == TRUE){
   require $_SERVER['DOCUMENT_ROOT'] . '../civix-bank/painelCliente/scripts/atualizarDados.php';

}else{
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['nome_completo']?> - Pagina Inicial</title>
    <link rel="stylesheet" href="./css/painelCliente.css">
</head>
<body>
    <header>

        <div class="up-header">
            <a href="#">
                <img src="./img/default.png" alt="">
            </a>
            <p class="tipoConta">Conta: <?php echo $_SESSION['conta_user'] . "-" . $_SESSION['tipo_conta_num']; ?></p>

        </div>
        <div class="down-header">
            <p>Olá, <?php echo $_SESSION['nome_completo'];?>!</p>
        </div>

        
        <a class="sair" href="../index.php">Sair</a>
    </header>
    <div class="blank-space"></div>
    <div class="body-page">

            <div class="label-conta">
                <p>Saldo Disponivel</p>
            </div>

            <div class="saldo-conta">
                <p>R$ <?php echo number_format($_SESSION['saldo_conta'],2,',','.'); ?></p>
            </div>

            <div class="icons-page">

                <a class="icon" href="./transferir/transferir.php">
                    <img src="../icons\transferir.png" alt="">
                    <p>Transferir</p>
                </a>

                <a class="icon" href="./pagar/pagar.php">
                    <img src="../icons\boleto.png" alt="">
                    <p>Pagar</p>
                </a>

                <a class="icon" href="./depositar/depositar.php">
                    <img src="../icons\depositar.png" alt="">
                    <p>Depositar</p>
                </a>

            </div>
           

             <div class="blank-space"></div>
            



    <footer>
        <div class="icon-inferior">
            <a href="">
                <img src="../icons\home.png" alt="">
                <p>Home</p>
            </a>
        </div>

        <div class="icon-inferior">
            <a href="./extratoCliente/extratoCliente.php">
                <img src="../icons\barra-inferior-extrato.png" alt="">
                <p>Extrato</p>
            </a>
        </div>
    </footer>
    
</body>
</html>