<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";
extract($_GET);

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
        unset($_SESSION['carrinho'][$idProduto]);
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
                
                // Busca a imagem no banco para mostrar no carrinho
                $consulta_img = "SELECT Imagem FROM produtos WHERE Id = $key";
                $res_img = banco($server, $user, $password, $db, $consulta_img);
                $linha_img = $res_img->fetch_assoc();
                $img = $linha_img ? $linha_img['Imagem'] : 'img/copobs.webp';

                echo "<div class='item-carrinho'>";
                echo "  <img src='$img' alt='".$value['nome']."' class='item-carrinho-img'>";
                echo "  <div class='item-carrinho-info'>";
                echo "      <h4>".$value['nome']."</h4>";
                echo "      <p>Preço: R$ ".number_format($value['preco'], 2, ',', '.')."</p>";
                echo "  </div>";
                
                echo "  <div class='qtd-controle'>";
                echo "      <a href='?menos=$key' class='btn-qtd'>-</a>";
                echo "      <span>".$value['quantidade']."</span>";
                echo "      <a href='?mais=$key' class='btn-qtd'>+</a>";
                echo "  </div>";
                
                echo "  <div class='item-carrinho-subtotal'>";
                echo "      <strong>R$ ".number_format($subtotal, 2, ',', '.')."</strong>";
                echo "      <a class='botao remover' href='?remover=$key'>X</a>";
                echo "  </div>";
                echo "</div>";
            }

            echo "<div class='total'>";
            echo "<span>Total</span>";
            echo "<strong>R$ ".number_format($total, 2, ',', '.')."</strong>";
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