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
<?php include "header.php"; ?>

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
                    <input type="text" id="numero" name="numero" value="<?php echo $usuario['Numero']; ?>"/>
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
    </section>
</main>

<?php include "footer.php"; ?>