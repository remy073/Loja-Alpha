<?php
require_once "app/DLL.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login · Alpha</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topo topo-compacto">
    <div class="topo-conteudo">
        <h1 class="logo">ALPHA</h1>
        <p class="slogan">Acesse sua conta</p>
    </div>
</header>

<main class="conteudo">
    <section class="painel painel-estreito painel-auth">

        <div class="auth-icone">
            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        </div>

        <h2 class="painel-titulo">Entrar</h2>
        <p class="auth-subtitulo">Bem-vindo de volta. Continue de onde parou.</p>

        <?php
        form("banco.php", "email", "senha", null, null, null, null, null, null, "Entrar", null, null);
        ?>

        <div class="painel-rodape">
            <p>Não tem cadastro? <a href="formulario.php">Criar conta</a></p>
            <p><a href="index.php">← Voltar para a loja</a></p>
        </div>
    </section>
</main>

<footer class="rodape">
    <p>Reilly &amp; Gabriel &copy; <?php echo date('Y'); ?> — Projeto Integrador</p>
</footer>

</body>
</html>
