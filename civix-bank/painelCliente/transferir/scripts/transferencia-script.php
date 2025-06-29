<?php 
require $_SERVER['DOCUMENT_ROOT'] . '../civix-bank/scripts/conexao-banco.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conta_digitada = $_POST['conta-digitada'];
    $valor_transferencia =$_POST['valor-trans'];
    $saldo_conta = $_SESSION['saldo_conta'];

    
    $stmt = $conexao->prepare("SELECT * FROM usuario WHERE num_conta = ? LIMIT 1");
    $stmt->bind_param("s",$conta_digitada);
    $stmt->execute();
    $resultado = $stmt->get_result();


    if($resultado->num_rows === 1){
        $usuario_dados = $resultado->fetch_assoc();
        $_SESSION['conta-trans'] = $usuario_dados['num_conta'];
        switch($usuario_dados['tipo_conta']){
            case 'poupanca':
                $num_conta = 1;
                break;
            case 'corrente':
                $num_conta = 2;
                break;

            case 'salario':
                $num_conta = 3;
                break;
        }

    }else{
        echo "<script>alert('Conta não encontrada!');
            window.location.href = '../../painelCliente.php';
            
            </script>";
            die();
    }

    $stmt2 = $conexao->prepare("SELECT * FROM cliente WHERE usuario_id = ? LIMIT 1");
    $stmt2->bind_param("s",$usuario_dados['id']);
    $stmt2->execute();
    $resultado2 = $stmt2->get_result();

    $dadosTransferencia = $resultado2->fetch_assoc();

    if($valor_transferencia > $saldo_conta){
        echo "<script>alert('Saldo em conta é menor que o valor da transferencia!');
            window.location.href = '../../painelCliente.php';
            
            </script>";
            die();
    }else if($conta_digitada == $_SESSION['conta_user']){
            echo "<script>alert('Você não pode transferir para si mesmo!');
            window.location.href = '../../painelCliente.php';
            
            </script>";
            die();
    }else if($valor_transferencia == NULL || $valor_transferencia <= 0){
        echo "<script>alert('Você não digitou um valor válido!');
            window.location.href = '../../painelCliente.php';
            
            </script>";
            die();
    }else{
        $_SESSION['valor-transferencia'] = $valor_transferencia;
    }

}

?> 

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['nome_completo'];?> - Extrato Bancario</title>
    <link rel="stylesheet" href="../transferir.css">
</head>
<body>
    
    <header>
        <a href="../../painelCliente.php">
            <img src="../../../icons/back-button.png" alt="">
        </a>

        <p>Transferir</p>

    </header>
           
    <div class="body-page">
        <form action="./confirmarTransferencia.php" method="post">

            <div class="input-box">
                <label><strong>Confirme os dados de transferencia:</strong></label>
            </div>

            <div class="input-box">
                <label><strong>Nome Completo:</strong></label>
                <label><?php echo $dadosTransferencia['nome_completo'];?></label>
                <label><strong>CPF do Recebedor:</strong></label>
                <label><?php echo $dadosTransferencia['cpf'];?></label>
                <label><strong>Nº da Conta:</strong></label>
                <label><?php echo $usuario_dados['num_conta'] . "-" . $num_conta;?></label>
                <label><strong>Valor da Transferencia:</strong></label>
                <label>R$ <?php echo number_format($valor_transferencia,2,',','.');?></label>
            </div>

            <div class="input-box">
                <label><strong>Senha:</strong></label>
                <input type="password" name="senha-digitada" placeholder="Digite sua senha..." required>
            </div>


            <button type="submit">Confirmar dados e Transferir</button>


        </form>
    </div>
            



    <footer>
        <div class="icon-inferior">
            <a href="../../../painelCliente/painelCliente.php">
                <img src="../../../icons\home.png" alt="">
                <p>Home</p>
            </a>
        </div>

        <div class="icon-inferior">
            <a href="../../extratoCliente/extratoCliente.php">
                <img src="../../../icons\barra-inferior-extrato.png" alt="">
                <p>Extrato</p>
            </a>
        </div>
    </footer>
    
</body>
</html>