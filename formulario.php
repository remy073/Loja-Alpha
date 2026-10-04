<?php
session_start();
require_once "app/DLL.php";
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel painel-estreito">
        <h2 class="painel-titulo">Cadastro</h2>
        <p class="cliente-logado">Crie sua conta e cadastre seu endereço.</p>

        <?php
        form("banco.php", "nome", "email", "senha", "estado", "cidade", "bairro", "rua", "numero", "Cadastrar", null, null);
        ?>

        <div class="painel-rodape">
            <p>Já tem login? <a href="login.php">Entrar</a></p>
            <p><a href="index.php">← Voltar para a loja</a></p>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>