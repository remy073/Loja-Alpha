<?php
session_start();
require_once "app/DLL.php";

$sessao = "nao";
if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
teste_login($sessao);
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel painel-estreito sucesso">
        <div class="sucesso-icone">✓</div>
        <h2 class="painel-titulo">Compra realizada com sucesso</h2>
        <p>Seus dados foram salvos e seu pedido foi confirmado.</p>

        <div class="painel-acoes">
            <a class="botao destaque" href="index.php">Voltar para a loja</a>
            <a class="botao" href="minhasCompras.php">Minhas compras</a>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>