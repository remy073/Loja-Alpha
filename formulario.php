<?php
session_start();
require_once "app/DLL.php";
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel painel-estreito">
        <h2 class="painel-titulo">Cadastro</h2>
        <p class="cliente-logado" style="text-align: center; color: var(--texto-suave); margin-bottom: 30px;">Crie sua conta e cadastre seu endereço.</p>

        <form action="banco.php" method="post" class="formulario">
            
            <!-- DADOS PESSOAIS -->
            <div class="campo">
                <label for="nome">Nome completo</label>
                <input type="text" name="nome" id="nome" required placeholder="Digite seu nome" />
            </div>

            <div class="campo">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" required placeholder="Digite seu e-mail" />
            </div>

            <div class="campo">
                <label for="senha">Senha</label>
                <input type="password" name="senha" id="senha" required placeholder="Crie uma senha" />
            </div>

            <!-- ENDEREÇO -->
            <div class="campo">
                <label for="estado">Estado (UF)</label>
                <input type="text" name="estado" id="estado" required placeholder="Ex: BA" maxlength="2" />
            </div>

            <div class="campo">
                <label for="cidade">Cidade</label>
                <input type="text" name="cidade" id="cidade" required placeholder="Sua cidade" />
            </div>

            <div class="campo">
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" id="bairro" required placeholder="Seu bairro" />
            </div>

            <div class="campo">
                <label for="rua">Rua</label>
                <input type="text" name="rua" id="rua" required placeholder="Nome da rua" />
            </div>

            <div class="campo">
                <label for="numero">Número</label>
                <input type="text" name="numero" id="numero" required placeholder="Ex: 123" />
            </div>

            <!-- BOTÃO -->
            <div class="acoes mt-40">
                <input type="submit" name="Cadastrar" value="Cadastrar" />
            </div>
        </form>

        <div class="painel-rodape">
            <p>Já tem login? <a href="login.php">Entrar</a></p>
            <p><a href="index.php">← Voltar para a loja</a></p>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>