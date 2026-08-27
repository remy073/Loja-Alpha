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
<title>Compra Finalizada</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Compra Finalizada</h1></header>
<main class="caixa">
<p>Compra realizada com sucesso.</p>
<p>Os dados foram salvos no <strong>banco de dados</strong> usando a funcao <strong>banco()</strong>.</p>
<p><a href="index.php">Voltar para a loja</a></p>
<p><a href="sair.php">Sair</a></p>
</main>
</body>
</html>
