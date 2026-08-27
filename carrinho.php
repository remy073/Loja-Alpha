<?php
session_start();
extract($_GET);

if(isset($remover)){
    $idProduto = (int) $remover;
    unset($_SESSION['carrinho'][$idProduto]);
    header('Location: carrinho.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Carrinho</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header>
<h1>Carrinho</h1>
<nav>
<a href="index.php">Continuar comprando</a>
<a href="login.php">Login</a>
<a href="formulario.php">Cadastro</a>
</nav>
</header>
<main class="caixa">
<?php
$total = 0;

if(isset($_SESSION['carrinho'])){
    foreach($_SESSION['carrinho'] as $key => $value){
        $subtotal = $value['quantidade'] * $value['preco'];
        $total = $total + $subtotal;

        echo "<div class='item'>";
        echo "<p><strong>Produto:</strong> ".$value['nome']."</p>";
        echo "<p><strong>Quantidade:</strong> ".$value['quantidade']."</p>";
        echo "<p><strong>Preco:</strong> R$ ".$subtotal.",00</p>";
        echo "<a class='botao remover' href='?remover=$key'>Remover item</a>";
        echo "</div>";
    }

    echo "<h3>Total: R$ $total,00</h3>";
    echo "<a class='botao' href='finalizar.php'>Finalizar compra</a>";
}else{
    echo "<p>Seu carrinho esta vazio.</p>";
}
?>
</main>
</body>
</html>
