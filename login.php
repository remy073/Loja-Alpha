<?php
session_start();
require_once "app/DLL.php";
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel painel-estreito">
        <h2 class="painel-titulo">Entrar</h2>
        <p class="cliente-logado" style="text-align: center; color: var(--texto-suave); margin-bottom: 30px;">Bem-vindo de volta. Continue de onde parou.</p>

        <form action="banco.php" method="post" class="formulario">
            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required placeholder="Digite seu e-mail" />
            </div>

            <div class="campo">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required placeholder="Digite sua senha" />
            </div>

            <div class="acoes mt-40">
                <input type="submit" name="Entrar" value="Entrar" />
            </div>
        </form>

        <div class="painel-rodape">
            <p>Não tem cadastro? <a href="formulario.php">Criar conta</a></p>
            <p><a href="recuperar.php">Esqueci minha senha</a></p> <!-- Adicione esta linha -->
            <p><a href="index.php">← Voltar para a loja</a></p>
        </div>
    </section>
</main>

<style>
.header-logo svg {
    display: none !important;
}
</style>

<?php include "footer.php"; ?>