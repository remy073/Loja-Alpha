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
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Carrinho · Alpha</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topo">
    <div class="topo-conteudo">
        <h1 class="logo">ALPHA</h1>
        <p class="slogan">Seu carrinho</p>
        <nav class="menu">
            <a href="index.php">Continuar comprando</a>
            <a href="login.php">Login</a>
            <a href="formulario.php">Cadastro</a>
        </nav>
    </div>
</header>

<main class="conteudo">
    <section class="painel">
        <h2 class="painel-titulo">Itens no carrinho</h2>

        <?php
        $total = 0;

        if(isset($_SESSION['carrinho'])){
            foreach($_SESSION['carrinho'] as $key => $value){
                $subtotal = $value['quantidade'] * $value['preco'];
                $total = $total + $subtotal;

                echo "<div class='item'>";
                echo "<div class='item-info'>";
                echo "<h4>".$value['nome']."</h4>";
                echo "<p>Quantidade: <strong>".$value['quantidade']."</strong></p>";
                echo "<p>Subtotal: <strong>R$ ".$subtotal.",00</strong></p>";
                echo "</div>";
                echo "<a class='botao remover' href='?remover=$key'>Remover</a>";
                echo "</div>";
            }

            echo "<div class='total'>";
            echo "<span>Total</span>";
            echo "<strong>R$ $total,00</strong>";
            echo "</div>";

            echo "<div class='painel-acoes'>";
            echo "<a class='botao destaque' href='finalizar.php'>Finalizar compra</a>";
            echo "</div>";
        }else{
            echo "<p class='vazio'>Seu carrinho está vazio.</p>";
            echo "<div class='painel-acoes'>";
            echo "<a class='botao' href='index.php'>Ver produtos</a>";
            echo "</div>";
        }
        ?>
    </section>
</main>

<footer class="rodape">
    <p>Reilly &amp; Gabriel &copy; <?php echo date('Y'); ?> — Projeto Integrador</p>
</footer>

</body>
</html>
