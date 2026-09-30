<?php
session_start();
unset($_SESSION['email']);
unset($_SESSION['senha']);
unset($_SESSION['login']);
unset($_SESSION['carrinho']);
header('Location: login.php');
exit;
?>
