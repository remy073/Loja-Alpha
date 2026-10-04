<?php
session_start();
require_once "app/DLL.php";
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel painel-estreito">
        <h2 class="painel-titulo">Entrar</h2>
        <p class="cliente-logado">Bem-vindo de volta. Continue de onde parou.</p>

        <?php
        form("banco.php", "email", "senha", null, null, null, null, null, null, "Entrar", null, null);
        ?>

        <div class="painel-rodape">
            <p>Não tem cadastro? <a href="formulario.php">Criar conta</a></p>
            <p><a href="index.php">← Voltar para a loja</a></p>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>