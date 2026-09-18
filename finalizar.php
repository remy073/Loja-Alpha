<?php
session_start();
require_once "app/DLL.php";

$sessao = "nao";
if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
teste_login($sessao);

$logado = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Finalizar Compra · Alpha</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topo">
    <div class="topo-conteudo">
        <h1 class="logo">ALPHA</h1>
        <p class="slogan">Finalizar compra</p>
    </div>
</header>

<main class="conteudo">
    <section class="painel">
        <h2 class="painel-titulo">Endereço de entrega</h2>

        <p class="cliente-logado">Cliente logado: <strong><?php echo $logado; ?></strong></p>

        <?php
        if(isset($_SESSION['carrinho'])){
            form("banco.php", "estado", "cidade", "bairro", "rua", "numero", null, null, "Finalizar", null, null);
        }else{
            echo "<p class='vazio'>Seu carrinho está vazio.</p>";
            echo "<div class='painel-acoes'>";
            echo "<a class='botao' href='index.php'>Voltar para a loja</a>";
            echo "</div>";
        }
        ?>

        <div class="painel-rodape">
            <p><a href="sair.php">Sair da conta</a></p>
        </div>
    </section>
</main>

<footer class="rodape">
    <p>Reilly &amp; Gabriel &copy; <?php echo date('Y'); ?> — Projeto Integrador</p>
</footer>

</body>
</html>
