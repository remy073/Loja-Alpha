<?php

// Funcao fornecida no DLL.php. O destino foi ajustado para o login da loja.
Function teste_login($sessao) {
    if($sessao != "ok"){
        header("Location: login.php");
        exit;
    }
}

// Funcao principal fornecida para executar comandos SQL.
Function banco($server, $user, $password, $db, $consulta)
{
    $banco = new mysqli($server, $user, $password, $db);

    if ($banco->connect_error) {
        echo "Falha de conexao referencia: (".$banco->connect_errno.") - ".$banco->connect_error;
        exit();
    }

    if (!$resultado = $banco->query($consulta)) {
        echo "Falha na consulta referencia: (".$banco->errno.") - ".$banco->error;
        exit();
    }

    $banco->close();
    return $resultado;
}

// Funcao de formulario fornecida no DLL.php.
// Escreva null nos campos e botoes que nao serao usados.
function form($action,$var1,$var2,$var3,$var4,$var5,$var6,$var7,$b1,$b2,$b3){
    echo "
    <style type='text/css'>
    label.incluir {
        display: inline-block;
        width: 120px;
    }
    </style>";

    echo "<fieldset>";
    echo "<form action='$action' method='post'>";

    if(isset($var1)){
        echo "<label for='$var1' class='incluir'>$var1:</label>";
        echo "<input type='text' name='$var1'/><br/>";
    }
    if(isset($var2)){
        echo "<label for='$var2' class='incluir'>$var2:</label>";
        echo "<input type='text' name='$var2'/><br/>";
    }
    if(isset($var3)){
        echo "<label for='$var3' class='incluir'>$var3:</label>";
        echo "<input type='text' name='$var3'/><br/>";
    }
    if(isset($var4)){
        echo "<label for='$var4' class='incluir'>$var4:</label>";
        echo "<input type='text' name='$var4'/><br/>";
    }
    if(isset($var5)){
        echo "<label for='$var5' class='incluir'>$var5:</label>";
        echo "<input type='text' name='$var5'/><br/>";
    }
    if(isset($var6)){
        echo "<label for='$var6' class='incluir'>$var6:</label>";
        echo "<input type='text' name='$var6'/><br/>";
    }
    if(isset($var7)){
        echo "<label for='$var7' class='incluir'>$var7:</label>";
        echo "<input type='text' name='$var7'/><br/>";
    }

    if(isset($b1)) echo "<input type='submit' value='$b1' name='$b1'/>";
    if(isset($b2)) echo "<input type='submit' value='$b2' name='$b2'/>";
    if(isset($b3)) echo "<input type='submit' value='$b3' name='$b3'/>";

    echo "</form>";
    echo "</fieldset>";
}

?>
