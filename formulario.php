<?php
require_once "app/DLL.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cadastro · Alpha</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topo topo-compacto">
    <div class="topo-conteudo">
        <h1 class="logo">ALPHA</h1>
        <p class="slogan">Crie sua conta</p>
    </div>
</header>

<main class="conteudo">
    <section class="painel painel-estreito painel-auth">

        <div class="auth-icone">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
                <line x1="19" y1="8" x2="19" y2="14"/>
                <line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
        </div>

        <h2 class="painel-titulo">Cadastro</h2>
        <p class="auth-subtitulo">Crie sua conta e comece a treinar com estilo.</p>

        <?php
        form("banco.php", "nome", "email", "senha", null, null, null, null, "Cadastrar", null, null);
        ?>

        <div class="painel-rodape">
            <p>Já tem login? <a href="login.php">Entrar</a></p>
            <p><a href="index.php">← Voltar para a loja</a></p>
        </div>
    </section>
</main>

<footer class="rodape">
    <p>Reilly &amp; Gabriel &copy; <?php echo date('Y'); ?> — Projeto Integrador</p>
</footer>

</body>
</html>
