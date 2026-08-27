<?php
session_start();
require_once "app/DLL.php";

$sessao = "nao";
if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
teste_login($sessao);

$logado = $_SESSION['email'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Finalizar Compra</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Finalizar Compra</h1></header>
<main class="caixa">
<?php
echo "<p>Cliente logado: <strong>$logado</strong></p>";

if(isset($_SESSION['carrinho'])){
    echo "<h3>Endereco de entrega</h3>";
    form("banco.php", "estado", "cidade", "bairro", "rua", "numero", null, null, "Finalizar", null, null);
}else{
    echo "<p>Seu carrinho esta vazio.</p>";
    echo "<p><a href='index.php'>Voltar para a loja</a></p>";
}
?>
<p><a href="sair.php">Sair</a></p>
</main>
</body>
</html>
