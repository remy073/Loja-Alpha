<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";

$sessao = "nao";
if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
teste_login($sessao);

$logado = $_SESSION['email'];

$consulta = "SELECT * FROM usuarios WHERE Email = '$logado'";
$resultado = banco($server, $user, $password, $db, $consulta);
$usuario = $resultado->fetch_assoc();
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
        <h2 class="painel-titulo">Confirme seu endereço</h2>

        <p class="cliente-logado">Cliente logado: <strong><?php echo $logado; ?></strong></p>

        <?php if(isset($_SESSION['carrinho'])){ ?>

            <form action="banco.php" method="post" class="formulario">

                <div class="campo">
                    <label for="estado">Estado</label>
                    <input type="text" id="estado" name="estado" value="<?php echo $usuario['Estado']; ?>"/>
                </div>

                <div class="campo">
                    <label for="cidade">Cidade</label>
                    <input type="text" id="cidade" name="cidade" value="<?php echo $usuario['Cidade']; ?>"/>
                </div>

                <div class="campo">
                    <label for="bairro">Bairro</label>
                    <input type="text" id="bairro" name="bairro" value="<?php echo $usuario['Bairro']; ?>"/>
                </div>

                <div class="campo">
                    <label for="rua">Rua</label>
                    <input type="text" id="rua" name="rua" value="<?php echo $usuario['Rua']; ?>"/>
                </div>

                <div class="campo">
                    <label for="numero">Número</label>
                    <input type="text" id="numero" name="numero"/>
                </div>

                <div class="acoes">
                    <input type="submit" value="Finalizar" name="Finalizar"/>
                </div>

            </form>

        <?php }else{ ?>

            <p class="vazio">Seu carrinho está vazio.</p>
            <div class="painel-acoes">
                <a class="botao" href="index.php">Voltar para a loja</a>
            </div>

        <?php } ?>

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
