<?php
require_once "app/DLL.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Cadastro</h1></header>
<main class="caixa">
<?php
// form(action, campo1 ... campo7, botao1 ... botao3)
form("banco.php", "nome", "email", "senha", null, null, null, null, "Cadastrar", null, null);
?>
<p><a href="login.php">Ja tenho login</a></p>
<p><a href="index.php">Voltar para a loja</a></p>
</main>
</body>
</html>
