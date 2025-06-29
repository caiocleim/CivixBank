<?php 
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['nome_completo'];?> - Extrato Bancario</title>
    <link rel="stylesheet" href="./transferir.css">
</head>
<body>
    
    <header>
        <a href="../painelCliente.php">
            <img src="../../icons/back-button.png" alt="">
        </a>

        <p>Transferir</p>

    </header>
           
    <div class="body-page">
        <form action="./scripts/transferencia-script.php" method="post">

            <div class="input-box">
                <label>Digite a Conta que Deseja Transferir:</label>
                <input type="text" name="conta-digitada" placeholder="Digite Nº da Conta:">
            </div>

            <div class="input-box">
                <label>Digite o Valor que deseja transferir (R$)</label>
                <input type="number" name="valor-trans" placeholder="Valor (R$) ">
            </div>

            <button type="submit">Transferir</button>


        </form>
    </div>
            



    <footer>
        <div class="icon-inferior">
            <a href="../../painelCliente/painelCliente.php">
                <img src="../../icons\home.png" alt="">
                <p>Home</p>
            </a>
        </div>

        <div class="icon-inferior">
            <a href="../extratoCliente/extratoCliente.php">
                <img src="../../icons\barra-inferior-extrato.png" alt="">
                <p>Extrato</p>
            </a>
        </div>
    </footer>
    
</body>
</html>