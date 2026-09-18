<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";

extract($_POST);

if(isset($Cadastrar)){
    $consulta = "INSERT INTO usuarios (Id, Nome, Email, Senha) VALUES (NULL, '$nome', '$email', '$senha')";
    banco($server, $user, $password, $db, $consulta);
    header("Location: login.php");
    exit();
}

if(isset($Entrar)){
    $consulta = "SELECT * FROM usuarios WHERE Email = '$email' and Senha = '$senha'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($linha = $resultado->fetch_assoc()){
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['login'] = "ok";
        header("Location: finalizar.php");
        exit();
    }else{
        header("Location: login.php");
        exit();
    }
}

if(isset($Finalizar)){
    $sessao = "nao";
    if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
    teste_login($sessao);

    $email = $_SESSION['email'];
    $total = 0;
    $produtos = "";

    if(isset($_SESSION['carrinho'])){
        foreach($_SESSION['carrinho'] as $value){
            $subtotal = $value['quantidade'] * $value['preco'];
            $total = $total + $subtotal;
            $produtos = $produtos.$value['nome']." | Quantidade: ".$value['quantidade']." | Preco: R$ ".$subtotal.",00; ";
        }
    }

    $consulta = "INSERT INTO vendas (Id, Email, Estado, Cidade, Bairro, Rua, Numero, Produtos, Total) VALUES (NULL, '$email', '$estado', '$cidade', '$bairro', '$rua', '$numero', '$produtos', '$total')";
    banco($server, $user, $password, $db, $consulta);

    unset($_SESSION['carrinho']);
    header("Location: compraFinalizada.php");
    exit();
}
?>
