<?php
session_start();
extract($_GET);

$imagens = [
    'img/camisabs.webp', 'img/camisabs2.webp', 'img/shortbsblack.webp', 'img/shortbsgray.webp',
    'img/copobs.webp', 'img/mochila.webp', 'img/bone.webp', 'img/bolsabs.webp',
    'img/tenisbranco.webp', 'img/tenispreto.webp', 'img/americatenis.webp', 'img/creatina.webp',
    'img/pretreino.webp', 'img/whey.webp', 'img/cafeina.webp'
];

// REMOVER
if(isset($remover)){
    $idProduto = (int) $remover;
    unset($_SESSION['carrinho'][$idProduto]);
    header('Location: carrinho.php'); exit;
}

// ADICIONAR +1
if(isset($mais)){
    $idProduto = (int) $mais;
    $_SESSION['carrinho'][$idProduto]['quantidade']++;
    header('Location: carrinho.php'); exit;
}

// SUBTRAIR -1
if(isset($menos)){
    $idProduto = (int) $menos;
    if($_SESSION['carrinho'][$idProduto]['quantidade'] > 1){
        $_SESSION['carrinho'][$idProduto]['quantidade']--;
    } else {
        unset($_SESSION['carrinho'][$idProduto]); // Se for 1 e diminuir, remove
    }
    header('Location: carrinho.php'); exit;
}
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel">
        <h2 class="painel-titulo">Seu Carrinho</h2>

        <?php
        $total = 0;
        if(isset($_SESSION['carrinho'])){
            foreach($_SESSION['carrinho'] as $key => $value){
                $subtotal = $value['quantidade'] * $value['preco'];
                $total = $total + $subtotal;
                $img = isset($imagens[$key]) ? $imagens[$key] : 'img/copobs.webp';

                echo "<div class='item-carrinho'>";
                echo "  <img src='$img' alt='".$value['nome']."' class='item-carrinho-img'>";
                echo "  <div class='item-carrinho-info'>";
                echo "      <h4>".$value['nome']."</h4>";
                echo "      <p>Preço: R$ ".$value['preco'].",00</p>";
                echo "  </div>";
                
                // BOTÕES DE + E -
                echo "  <div class='qtd-controle'>";
                echo "      <a href='?menos=$key' class='btn-qtd'>-</a>";
                echo "      <span>".$value['quantidade']."</span>";
                echo "      <a href='?mais=$key' class='btn-qtd'>+</a>";
                echo "  </div>";
                
                echo "  <div class='item-carrinho-subtotal'>";
                echo "      <strong>R$ ".$subtotal.",00</strong>";
                echo "      <a class='botao remover' href='?remover=$key'>X</a>";
                echo "  </div>";
                echo "</div>";
            }

            echo "<div class='total'>";
            echo "<span>Total</span>";
            echo "<strong>R$ $total,00</strong>";
            echo "</div>";

            echo "<div class='painel-acoes'>";
            echo "<a class='botao destaque' href='finalizar.php'>Ir para o Pagamento</a>";
            echo "</div>";
        }else{
            echo "<p class='vazio'>Seu carrinho está vazio.</p>";
            echo "<div class='painel-acoes'>";
            echo "<a class='botao' href='index.php'>Ver produtos</a>";
            echo "</div>";
        }
        ?>
    </section>
</main>

<?php include "footer.php"; ?>