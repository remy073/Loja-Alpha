<?php
require_once "app/DLL.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<header><h1>Login</h1></header>
<main class="caixa">
<?php
form("banco.php", "email", "senha", null, null, null, null, null, "Entrar", null, null);
?>
<p>Nao tem cadastro? <a href="formulario.php">Cadastre-se</a></p>
<p><a href="index.php">Voltar para a loja</a></p>
</main>
</body>
</html>
