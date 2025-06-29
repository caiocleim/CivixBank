<?php 

require $_SERVER['DOCUMENT_ROOT'] . '../civix-bank/scripts/conexao-banco.php';

session_start();

function verificarSenha($conexao,$conta_user,$senha_digitada){

    $stmt = $conexao->prepare("SELECT * FROM usuario WHERE num_conta = ? LIMIT 1");
    $stmt->bind_param("s",$conta_user);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $usuario_dados = $resultado->fetch_assoc();

    if($senha_digitada == $usuario_dados['senha_hash']){
        return true;
    }else{
        return false;
    }

}

function pegarID($conexao,$conta){
    $sql = "SELECT id FROM usuario WHERE num_conta = ? LIMIT 1";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s",$conta);
    $stmt->execute();
    $resultado = $stmt->get_result();

    $dados = $resultado->fetch_assoc();
    $id = $dados['id'];
    return $id;
}

function diminuirNoRemetente($conexao,$id,$valor){

    $sql = "UPDATE cliente SET saldo_conta = saldo_conta - ? WHERE usuario_id = ?";


    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ds",$valor,$id);
    $stmt->execute();


}

function aumentarRecebedor($conexao,$id,$valor){

    $sql = "UPDATE cliente SET saldo_conta = saldo_conta + ? WHERE usuario_id = ?";


    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ds",$valor,$id);
    $stmt->execute();


}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $conta_user = $_SESSION['conta_user'];
    $senha_digitada = $_POST['senha-digitada'];
    $conta_recebedor = $_SESSION['conta-trans'];
    $valor_transferencia = $_SESSION['valor-transferencia'];


    $senha_verificada = verificarSenha($conexao,$conta_user,$senha_digitada);

    if($senha_verificada == true){
        $id_conta_remetente = pegarID($conexao,$conta_user);
        $id_conta_destino = pegarID($conexao,$conta_recebedor);
    }else{
        echo "<script>alert('Senha Incorreta, tenta novamente!');
            window.location.href = '../../painelCliente.php';
            
            </script>";
            die();
    }

    # finaliza a transferencia

    $conexao->begin_transaction();

    try{
        diminuirNoRemetente($conexao,$id_conta_remetente,$valor_transferencia);
        aumentarRecebedor($conexao,$id_conta_destino,$valor_transferencia);
        $conexao->commit();
    }catch(Exception $e){
        $conexao->rollback();
    }


    $conexao->close();

    header("Location: ../../painelCliente.php");

}






?>