<?php
session_start();
require_once "app/DLL.php";

$sessao = "nao";
if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
teste_login($sessao);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Compra Finalizada · Alpha</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topo">
    <div class="topo-conteudo">
        <h1 class="logo">ALPHA</h1>
        <p class="slogan">Pedido confirmado</p>
    </div>
</header>

<main class="conteudo">
    <section class="painel painel-estreito sucesso">
        <div class="sucesso-icone">✓</div>
        <h2 class="painel-titulo">Compra realizada com sucesso</h2>
        <p>Seus dados foram salvos e seu pedido foi confirmado.</p>

        <div class="painel-acoes">
            <a class="botao destaque" href="index.php">Voltar para a loja</a>
            <a class="botao" href="sair.php">Sair</a>
        </div>
    </section>
</main>

<footer class="rodape">
    <p>Reilly &amp; Gabriel &copy; <?php echo date('Y'); ?> — Projeto Integrador</p>
</footer>

</body>
</html>
