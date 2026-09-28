<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";

$sessao = "nao";
if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
teste_login($sessao);

$logado = $_SESSION['email'];

$consulta = "SELECT * FROM vendas WHERE Email = '$logado' ORDER BY Id DESC";
$resultado = banco($server, $user, $password, $db, $consulta);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Minhas Compras · Alpha</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topo">
    <div class="topo-conteudo">
        <h1 class="logo">ALPHA</h1>
        <p class="slogan">Minhas compras</p>

        <nav class="menu">
            <a href="index.php">Vitrine</a>
            <a href="carrinho.php">Carrinho</a>
            <a href="minhasCompras.php" class="ativo">Minhas Compras</a>
            <a href="sair.php">Sair</a>
        </nav>
    </div>
</header>

<main class="conteudo">
    <section class="painel">
        <h2 class="painel-titulo">Histórico de compras</h2>

        <p class="cliente-logado">Cliente: <strong><?php echo $logado; ?></strong></p>

        <?php
        $temCompras = false;

        while($linha = $resultado->fetch_assoc()){
            $temCompras = true;

            echo "<div class='item'>";
            echo "<div class='item-info'>";
            echo "<h4>Pedido #".$linha['Id']."</h4>";
            echo "<p><strong>Produtos:</strong> ".$linha['Produtos']."</p>";
            echo "<p><strong>Endereço:</strong> ".$linha['Rua'].", ".$linha['Numero']." — ".$linha['Bairro'].", ".$linha['Cidade']."/".$linha['Estado']."</p>";
            echo "<p><strong>Total:</strong> R$ ".$linha['Total']."</p>";
            echo "</div>";
            echo "</div>";
        }

        if(!$temCompras){
            echo "<p class='vazio'>Você ainda não fez nenhuma compra.</p>";
        }
        ?>

        <div class="painel-acoes">
            <a class="botao" href="index.php">Voltar para a loja</a>
        </div>
    </section>
</main>

<footer class="rodape">
    <p>Reilly &amp; Gabriel &copy; <?php echo date('Y'); ?> — Projeto Integrador</p>
</footer>

</body>
</html>