<?php
session_start();
header('Content-Type: application/json');

if(!isset($_GET['id'])){
    echo json_encode(['ok' => false, 'msg' => 'ID não enviado']);
    exit;
}

$itens = [
    ['imagem'=>'img/camisabs.webp',    'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Branca'],
    ['imagem'=>'img/camisabs2.webp',   'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Preta'],
    ['imagem'=>'img/shortbsblack.webp','preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Preta'],
    ['imagem'=>'img/shortbsgray.webp', 'preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Cinza'],
    ['imagem'=>'img/copobs.webp',      'preco'=>49,  'nome'=>'Coqueteleira Black Skull'],
    ['imagem'=>'img/mochila.webp',     'preco'=>349, 'nome'=>'Mochila Black Skull Oficial Clio 50L'],
    ['imagem'=>'img/bone.webp',        'preco'=>89,  'nome'=>'Boné Black Skull Cinza'],
    ['imagem'=>'img/bolsabs.webp',     'preco'=>149, 'nome'=>'Bolsa Esportiva Black Skull'],
    ['imagem'=>'img/tenisbranco.webp', 'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Branco'],
    ['imagem'=>'img/tenispreto.webp',  'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Cinza'],
    ['imagem'=>'img/americatenis.webp','preco'=>349, 'nome'=>'Tênis Black Skull Lifter Ipo American'],
    ['imagem'=>'img/creatina.webp',    'preco'=>129, 'nome'=>'Creatina Monohidratada Black Skull'],
    ['imagem'=>'img/pretreino.webp',   'preco'=>149, 'nome'=>'Pré-Treino B.O.P.E Black Skull'],
    ['imagem'=>'img/whey.webp',        'preco'=>199, 'nome'=>'Whey 100% Black Skull'],
    ['imagem'=>'img/cafeina.webp',     'preco'=>99,  'nome'=>'Thermo Flame Cafeína Black Skull']
];

$id = (int) $_GET['id'];

if(isset($itens[$id])){
    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id]['quantidade']++;
    } else {
        $_SESSION['carrinho'][$id] = [
            'quantidade' => 1,
            'nome'       => $itens[$id]['nome'],
            'preco'      => $itens[$id]['preco']
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
        'nome'  => $itens[$id]['nome']
    ]);
} else {
    echo json_encode(['ok' => false, 'msg' => 'Produto não encontrado']);
}
?>