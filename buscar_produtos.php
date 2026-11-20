<?php
include "app/cons.php";
require_once "app/DLL.php";

header('Content-Type: application/json');

$consulta = "SELECT Id, Nome, Imagem, Preco FROM produtos";
$resultado = banco($server, $user, $password, $db, $consulta);

$arr = [];
while($linha = $resultado->fetch_assoc()){
    $arr[] = [
        'id' => $linha['Id'],
        'nome' => $linha['Nome'],
        'img' => $linha['Imagem'],
        'preco' => number_format($linha['Preco'], 2, ',', '.')
    ];
}

echo json_encode($arr);
?>