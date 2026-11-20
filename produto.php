<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";
extract($_GET);

$id = isset($_GET['id']) ? (int) $_GET['id'] : -1;

if($id < 0){
    header('Location: index.php');
    exit;
}

// Busca o produto no banco
$consulta = "SELECT * FROM produtos WHERE Id = $id";
$resultado = banco($server, $user, $password, $db, $consulta);
$produto = $resultado->fetch_assoc();

if(!$produto){
    header('Location: index.php');
    exit;
}

// COMPRAR AGORA 
if(isset($comprar)){
    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id]['quantidade']++;
    }else{
        $_SESSION['carrinho'][$id] = [
            'quantidade' => 1,
            'nome'       => $produto['Nome'],
            'preco'      => $produto['Preco']
        ];
    }
    header('Location: finalizar.php');
    exit;
}
?>
<?php include "header.php"; ?>

<main class="conteudo conteudo-produto">

    <nav class="breadcrumb">
        <a href="index.php">Início</a>
        <span>/</span>
        <a href="index.php#produtos"><?php echo ucfirst($produto['Categoria']); ?></a>
        <span>/</span>
        <strong><?php echo $produto['Nome']; ?></strong>
    </nav>

    <section class="produto-detalhe">

        <div class="produto-detalhe-imagem">
            <img src="<?php echo $produto['Imagem']; ?>" alt="<?php echo $produto['Nome']; ?>">
            <?php if(!empty($produto['Badge'])){ ?>
                <span class="badge"><?php echo $produto['Badge']; ?></span>
            <?php } ?>
        </div>

        <div class="produto-detalhe-info">

            <span class="produto-categoria"><?php echo ucfirst($produto['Categoria']); ?></span>
            <h1 class="produto-detalhe-titulo"><?php echo $produto['Nome']; ?></h1>
            <p class="produto-detalhe-preco">R$ <?php echo number_format($produto['Preco'], 2, ',', '.'); ?></p>

            <div class="produto-detalhe-desc">
                <h3 class="produto-detalhe-subtitulo">Descrição</h3>
                <p><?php echo $produto['Descricao']; ?></p>
            </div>

            <div class="produto-detalhe-acoes">
                <button class="botao botao-carrinho"
                        data-id="<?php echo $id; ?>"
                        data-nome="<?php echo $produto['Nome']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                    Adicionar ao carrinho
                </button>
                <a class="botao botao-comprar destaque" href="?id=<?php echo $id; ?>&comprar=<?php echo $id; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                    Comprar agora
                </a>
            </div>
            <a href="index.php" class="produto-detalhe-voltar">← Voltar para a loja</a>
        </div>

    </section>
</main>

<?php include "footer.php"; ?>