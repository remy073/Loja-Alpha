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

// botoes + e - dentro da tela de pagamento
extract($_GET);
if(isset($mais)){
    $_SESSION['carrinho'][(int)$mais]['quantidade']++;
    header('Location: finalizar.php'); exit;
}
if(isset($menos)){
    $id = (int)$menos;
    if($_SESSION['carrinho'][$id]['quantidade'] > 1){
        $_SESSION['carrinho'][$id]['quantidade']--;
    } else {
        unset($_SESSION['carrinho'][$id]);
    }
    header('Location: finalizar.php'); exit;
}

$imagens = [
    'img/camisabs.webp', 'img/camisabs2.webp', 'img/shortbsblack.webp', 'img/shortbsgray.webp',
    'img/copobs.webp', 'img/mochila.webp', 'img/bone.webp', 'img/bolsabs.webp',
    'img/tenisbranco.webp', 'img/tenispreto.webp', 'img/americatenis.webp', 'img/creatina.webp',
    'img/pretreino.webp', 'img/whey.webp', 'img/cafeina.webp'
];
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel">
        <h2 class="painel-titulo">Finalizar Compra</h2>

        <?php if(isset($_SESSION['carrinho']) && count($_SESSION['carrinho']) > 0){ ?>

            <form action="banco.php" method="post" class="formulario">

                <!-- DADOS ESCONDIDOS DO ENDEREÇO (pra o banco salvar) -->
                <input type="hidden" name="estado" value="<?php echo $usuario['Estado']; ?>">
                <input type="hidden" name="cidade" value="<?php echo $usuario['Cidade']; ?>">
                <input type="hidden" name="bairro" value="<?php echo $usuario['Bairro']; ?>">
                <input type="hidden" name="rua" value="<?php echo $usuario['Rua']; ?>">
                <input type="hidden" name="numero" value="<?php echo $usuario['Numero']; ?>">

                <h3 class="form-secao-titulo">1. Resumo do Pedido</h3>
                
                <div class="resumo-compra">
                    <?php
                    $total = 0;
                    foreach($_SESSION['carrinho'] as $key => $value){
                        $subtotal = $value['quantidade'] * $value['preco'];
                        $total += $subtotal;
                        $img = isset($imagens[$key]) ? $imagens[$key] : 'img/copobs.webp';
                        
                        echo "<div class='item-carrinho finalizar-item'>";
                        echo "  <img src='$img' class='item-carrinho-img'>";
                        echo "  <div class='item-carrinho-info'>";
                        echo "      <h4>".$value['nome']."</h4>";
                        echo "      <p>R$ ".$value['preco'].",00</p>";
                        echo "  </div>";
                        
                        echo "  <div class='qtd-controle'>";
                        echo "      <a href='?menos=$key' class='btn-qtd'>-</a>";
                        echo "      <span>".$value['quantidade']."</span>";
                        echo "      <a href='?mais=$key' class='btn-qtd'>+</a>";
                        echo "  </div>";
                        
                        echo "  <div class='item-carrinho-subtotal'>";
                        echo "      <strong>R$ ".$subtotal.",00</strong>";
                        echo "  </div>";
                        echo "</div>";
                    }
                    ?>
                </div>

                <div class="total">
                    <span>Total a pagar</span>
                    <strong>R$ <?php echo $total; ?>,00</strong>
                </div>

                <h3 class="form-secao-titulo mt-40">2. Forma de Pagamento</h3>
                <div class="pagamento-opcoes">
                    
                    <label class="pagamento-card">
                        <input type="radio" name="pagamento" value="pix" checked>
                        <div class="pagamento-conteudo">
                            <span class="pagamento-icone"></span>
                            <div>
                                <strong>Pix</strong>
                                <span>Aprovação imediata</span>
                            </div>
                        </div>
                    </label>

                    <label class="pagamento-card">
                        <input type="radio" name="pagamento" value="credito">
                        <div class="pagamento-conteudo">
                            <span class="pagamento-icone"></span>
                            <div>
                                <strong>Cartão de Crédito</strong>
                                <span>Até 12x</span>
                            </div>
                        </div>
                    </label>

                    <label class="pagamento-card">
                        <input type="radio" name="pagamento" value="debito">
                        <div class="pagamento-conteudo">
                            <span class="pagamento-icone"></span>
                            <div>
                                <strong>Cartão de Débito</strong>
                                <span>À vista</span>
                            </div>
                        </div>
                    </label>

                </div>

                <div class="acoes mt-40">
                    <input type="submit" value="Pagar e Finalizar" name="Finalizar"/>
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