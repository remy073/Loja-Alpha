<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";

extract($_POST);

// Cadastro
if(isset($Cadastrar)){
    // Verifica se o e-mail já existe
    $check = "SELECT Id FROM usuarios WHERE Email = '$email'";
    $res_check = banco($server, $user, $password, $db, $check);
    
    if($res_check->fetch_assoc()){
        // E-mail já cadastrado, volta com aviso
        header("Location: formulario.php?erro=email");
        exit();
    }

    $consulta = "INSERT INTO usuarios (Id, Nome, Email, Senha, Estado, Cidade, Bairro, Rua, Numero) 
                 VALUES (NULL, '$nome', '$email', '$senha', '$estado', '$cidade', '$bairro', '$rua', '$numero')";
    banco($server, $user, $password, $db, $consulta);
    header("Location: login.php");
    exit();
}

// Login
if(isset($Entrar)){
    $consulta = "SELECT * FROM usuarios WHERE Email = '$email' and Senha = '$senha'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($linha = $resultado->fetch_assoc()){
        // Pega os dados do banco, não do POST (evita problemas com espaços)
        $_SESSION['email'] = $linha['Email'];
        $_SESSION['senha'] = $linha['Senha'];
        $_SESSION['login'] = "ok";
        header("Location: finalizar.php");
        exit();
    }else{
        header("Location: login.php");
        exit();
    }
}

// Finalizar Compra
if(isset($Finalizar)){
    $sessao = "nao";
    if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
    teste_login($sessao);

    $email = $_SESSION['email'];
    $total = 0;
    $produtos = "";

    // Se por algum motivo o pagamento não vier, define 'pix' como padrão
    $pagamento = isset($pagamento) ? $pagamento : 'pix';

    if(isset($_SESSION['carrinho'])){
        foreach($_SESSION['carrinho'] as $value){
            $subtotal = $value['quantidade'] * $value['preco'];
            $total = $total + $subtotal;
            $produtos = $produtos.$value['nome']." | Quantidade: ".$value['quantidade']." | Preco: R$ ".$subtotal.",00; ";
        }
    }

    $consulta = "INSERT INTO vendas (Id, Email, Estado, Cidade, Bairro, Rua, Numero, Produtos, Total, Pagamento) 
                 VALUES (NULL, '$email', '$estado', '$cidade', '$bairro', '$rua', '$numero', '$produtos', '$total', '$pagamento')";
    banco($server, $user, $password, $db, $consulta);

    unset($_SESSION['carrinho']);
    header("Location: compraFinalizada.php");
    exit();
}
?>