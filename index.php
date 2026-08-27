<?php
session_start();
extract($_GET);

$itens = [
    ['imagem'=>'img/item1.svg','preco'=>10,'nome'=>'CopoShake'],
    ['imagem'=>'img/item2.svg','preco'=>35,'nome'=>'Coqueteleira'],
    ['imagem'=>'img/item3.svg','preco'=>40,'nome'=>'Short DriFit']
];

if(isset($adicionar)){
    $idProduto = (int) $adicionar;

    if(isset($itens[$idProduto])){
        if(isset($_SESSION['carrinho'][$idProduto])){
            $_SESSION['carrinho'][$idProduto]['quantidade']++;
        }else{
            $_SESSION['carrinho'][$idProduto] = [
                'quantidade'=>1,
                'nome'=>$itens[$idProduto]['nome'],
                'preco'=>$itens[$idProduto]['preco']
            ];
        }

        header('Location: carrinho.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Loja Virtual</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1>Loja Virtual</h1>
<p>Produtos fitness com estilo simples e direto.</p>
<p>Reilly e Gabriel ₢</p>
<nav>
<a href="index.php">Vitrine</a>
<a href="carrinho.php">Carrinho</a>
<a href="login.php">Login</a>
<a href="formulario.php">Cadastro</a>
</nav>
</header>
<main class="produtos">
<?php foreach($itens as $key => $value){ ?>
    <div class="produto">
        <img src="<?php echo $value['imagem']; ?>" alt="<?php echo $value['nome']; ?>">
        <h3><?php echo $value['nome']; ?></h3>
        <p>R$ <?php echo $value['preco']; ?>,00</p>
        <a class="botao" href="?adicionar=<?php echo $key; ?>">Adicionar ao carrinho</a>
    </div>
<?php } ?>
</main>
</body>
</html>
