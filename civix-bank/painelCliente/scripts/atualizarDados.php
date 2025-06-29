<?php 

require $_SERVER['DOCUMENT_ROOT'] . '../civix-bank/scripts/conexao-banco.php';


    $num_conta=$_SESSION['conta_user'];
    $id = $_SESSION['id'];

    $sql = "SELECT * FROM cliente WHERE usuario_id = ? LIMIT 1";


    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s",$id);
    $stmt->execute();
    $resultado = $stmt->get_result();
        
    $usuario_dados = $resultado->fetch_assoc();

    $_SESSION['id'] = $usuario_dados['id'];
    $_SESSION['cpf'] = $usuario_dados['cpf'];
    $_SESSION['nome_completo'] = $usuario_dados['nome_completo'];
    $_SESSION['data_nascimento'] = $usuario_dados['data_nascimento'];
    $_SESSION['telefone'] = $usuario_dados['telefone'];
    $_SESSION['email'] = $usuario_dados['email'];
    $_SESSION['saldo_conta'] = $usuario_dados['saldo_conta'];
    $_SESSION['ativo'] = $usuario_dados['ativo'];


?>