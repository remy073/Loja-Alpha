<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";
header('Content-Type: application/json');

if(!isset($_GET['id'])){
    echo json_encode(['ok' => false, 'msg' => 'ID não enviado']);
    exit;
}

$id = (int) $_GET['id'];

// Busca o produto no banco
$consulta = "SELECT * FROM produtos WHERE Id = $id";
$resultado = banco($server, $user, $password, $db, $consulta);

if($linha = $resultado->fetch_assoc()){
    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id]['quantidade']++;
    } else {
        $_SESSION['carrinho'][$id] = [
            'quantidade' => 1,
            'nome'       => $linha['Nome'],
            'preco'      => $linha['Preco']
        ];
    }

    $totalItens = 0;
    foreach($_SESSION['carrinho'] as $item){
        $totalItens += $item['quantidade'];
    }

    echo json_encode([
        'ok'    => true,
        'qtd'   => $_SESSION['carrinho'][$id]['quantidade'],
        'total' => $totalItens,
        'nome'  => $linha['Nome']
    ]);
} else {
    echo json_encode(['ok' => false, 'msg' => 'Produto não encontrado']);
}
?>