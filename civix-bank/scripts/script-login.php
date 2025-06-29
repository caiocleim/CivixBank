<?php

require $_SERVER['DOCUMENT_ROOT'] . '../civix-bank/scripts/conexao-banco.php';

session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conta_digitada = $_POST["conta"];
    $senha_digitada = $_POST["senha"];
    $permissao = FALSE;

    $stmt = $conexao->prepare("SELECT * FROM usuario WHERE num_conta = ? LIMIT 1");
    $stmt->bind_param("s",$conta_digitada);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if($resultado->num_rows === 1){
        $usuario_dados = $resultado->fetch_assoc();

        if($senha_digitada == $usuario_dados['senha_hash']){
            $permissao = TRUE;
            $id_usuario = $usuario_dados['id'];

            switch($usuario_dados['tipo_conta']){
                case 'poupanca':
                    $_SESSION['tipo_conta_num'] = 1;
                    break;
                case 'corrente':
                    $_SESSION['tipo_conta_num'] = 2;
                    break;
                case 'salario':
                    $_SESSION['tipo_conta_num'] = 3;
                    break;
            }
        }else{
            echo "<script>alert('Senha Incorreta!');
            window.location.href = '../index.php';
            
            </script>";
            die();
        }
    }else{
        echo "<script>alert('Usuario não encontrado!');
            window.location.href = '../index.php';
            
            </script>";
    }


    if($permissao == TRUE){
        $stmt = $conexao->prepare("SELECT * FROM cliente WHERE usuario_id = ? LIMIT 1");
        $stmt->bind_param("i",$id_usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        $dadosCompletos = $resultado->fetch_assoc();

        $_SESSION['conta_user'] = $usuario_dados['num_conta'];

        $_SESSION['id'] = $dadosCompletos['id'];
        $_SESSION['usuario_id'] = $dadosCompletos['usuario_id'];
        $_SESSION['cpf'] = $dadosCompletos['cpf'];
        $_SESSION['nome_completo'] = $dadosCompletos['nome_completo'];
        $_SESSION['data_nascimento'] = $dadosCompletos['data_nascimento'];
        $_SESSION['telefone'] = $dadosCompletos['telefone'];
        $_SESSION['email'] = $dadosCompletos['email'];
        $_SESSION['saldo_conta'] = $dadosCompletos['saldo_conta'];
        $_SESSION['ativo'] = $dadosCompletos['ativo'];

        $_SESSION['sessao-logada'] = TRUE;


        header("Location: ../painelCliente/painelCliente.php");
    }


}

