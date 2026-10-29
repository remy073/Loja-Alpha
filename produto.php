<?php
session_start();
extract($_GET);

$itens = [
    // ROUPAS
    ['imagem'=>'img/camisabs.webp',    'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Branca',  'categoria'=>'roupas',      'badge'=>null,          'desc'=>'Camisa de compressão com tecido respirável de alta performance. Modelagem justa que acompanha o corpo, ideal para treinos intensos. Logo Black Skull aplicado nas costas.'],
    ['imagem'=>'img/camisabs2.webp',   'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Preta',   'categoria'=>'roupas',      'badge'=>'Novo',        'desc'=>'Versão preta da camisa de compressão oficial Black Skull. Tecido com elasticidade e secagem rápida, perfeita para musculação e crossfit.'],
    ['imagem'=>'img/shortbsblack.webp','preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Preta',  'categoria'=>'roupas',      'badge'=>null,          'desc'=>'Bermuda de compressão preta com elástico na cintura e cordão de ajuste. Tecido leve e resistente, ideal para treinos de alta intensidade.'],
    ['imagem'=>'img/shortbsgray.webp', 'preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Cinza',  'categoria'=>'roupas',      'badge'=>null,          'desc'=>'Bermuda de compressão cinza com logo Black Skull. Conforto e mobilidade para o dia a dia ou para a academia.'],
    // ACESSÓRIOS
    ['imagem'=>'img/copobs.webp',      'preco'=>49,  'nome'=>'Coqueteleira Black Skull',              'categoria'=>'acessorios',  'badge'=>'Top',         'desc'=>'Coqueteleira oficial Black Skull com capacidade para 700ml. Tampa com trava e mola misturadora para shakes e suplementos.'],
    ['imagem'=>'img/mochila.webp',     'preco'=>349, 'nome'=>'Mochila Black Skull Oficial Clio 50L',  'categoria'=>'acessorios',  'badge'=>null,          'desc'=>'Mochila tática Black Skull com 50 litros de capacidade. Diversos compartimentos, tecido resistente e patches bordados. Ideal para treino e viagem.'],
    ['imagem'=>'img/bone.webp',        'preco'=>89,  'nome'=>'Boné Black Skull Cinza',                'categoria'=>'acessorios',  'badge'=>null,          'desc'=>'Boné Black Skull cinza com aba curva e ajuste traseiro. Logo bordado em destaque. Estilo e proteção para o dia a dia.'],
    ['imagem'=>'img/bolsabs.webp',     'preco'=>149, 'nome'=>'Bolsa Esportiva Black Skull',           'categoria'=>'acessorios',  'badge'=>null,          'desc'=>'Bolsa esportiva Black Skull com cordão ajustável. Leve e prática, ideal para carregar itens de treino. Logo estampado em destaque.'],
    ['imagem'=>'img/tenisbranco.webp', 'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Branco',   'categoria'=>'acessorios',  'badge'=>'Novo',        'desc'=>'Tênis Black Skull Urban Camo na versão branca. Solado em borracha, cabedal em camurça e detalhes em camouflage. Conforto e estilo urbano.'],
    ['imagem'=>'img/tenispreto.webp',  'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Cinza',    'categoria'=>'acessorios',  'badge'=>null,          'desc'=>'Tênis Black Skull Urban Camo na versão cinza. Mesma construção do modelo branco, com acabamento em tons escuros para o dia a dia.'],
    ['imagem'=>'img/americatenis.webp','preco'=>349, 'nome'=>'Tênis Black Skull Lifter Ipo American', 'categoria'=>'acessorios',  'badge'=>null,          'desc'=>'Tênis Black Skull Lifter Ipo American com bandeira dos EUA. Estrutura reforçada para treinos de força e uso diário.'],
    // SUPLEMENTOS
    ['imagem'=>'img/creatina.webp',    'preco'=>129, 'nome'=>'Creatina Monohidratada Black Skull',    'categoria'=>'suplementos', 'badge'=>'Mais vendido','desc'=>'Creatina monohidratada Black Skull em pó (300g). Auxilia no ganho de força e massa muscular. Sabor neutro, ideal para misturar com shakes.'],
    ['imagem'=>'img/pretreino.webp',   'preco'=>149, 'nome'=>'Pré-Treino B.O.P.E Black Skull',        'categoria'=>'suplementos', 'badge'=>null,          'desc'=>'Pré-treino B.O.P.E Black Skull (150g). Fórmula com cafeína e beta-alanina para mais energia, foco e resistência nos treinos.'],
    ['imagem'=>'img/whey.webp',        'preco'=>199, 'nome'=>'Whey 100% Black Skull',                 'categoria'=>'suplementos', 'badge'=>'Mais vendido','desc'=>'Whey protein 100% Black Skull (837g). Alto teor de proteína por dose, sabor baunilha. Auxilia na recuperação muscular e ganho de massa.'],
    ['imagem'=>'img/cafeina.webp',     'preco'=>99,  'nome'=>'Thermo Flame Cafeína Black Skull',      'categoria'=>'suplementos', 'badge'=>'Novo',        'desc'=>'Termogênico Thermo Flame Black Skull (120 cápsulas). Fórmula com cafeína para acelerar o metabolismo e aumentar a disposição.']
];

// Verifica se o ID existe
$id = isset($_GET['id']) ? (int) $_GET['id'] : -1;

if(!isset($itens[$id])){
    // Produto não encontrado — volta pra loja
    header('Location: index.php');
    exit;
}

$produto = $itens[$id];

// COMPRAR AGORA 
if(isset($comprar)){
    if(isset($_SESSION['carrinho'][$id])){
        $_SESSION['carrinho'][$id]['quantidade']++;
    }else{
        $_SESSION['carrinho'][$id] = [
            'quantidade' => 1,
            'nome'       => $produto['nome'],
            'preco'      => $produto['preco']
        ];
    }
    header('Location: finalizar.php');
    exit;
}
?>
<?php include "header.php"; ?>

<main class="conteudo conteudo-produto">

    <!-- BREADCRUMB oq diabos é isso kkkak -->
    <nav class="breadcrumb">
        <a href="index.php">Início</a>
        <span>/</span>
        <a href="index.php#produtos"><?php echo ucfirst($produto['categoria']); ?></a>
        <span>/</span>
        <strong><?php echo $produto['nome']; ?></strong>
    </nav>

    <section class="produto-detalhe">

        <!-- COLUNA ESQUERDA: IMAGEM -->
        <div class="produto-detalhe-imagem">
            <img src="<?php echo $produto['imagem']; ?>" alt="<?php echo $produto['nome']; ?>">
            <?php if(!empty($produto['badge'])){ ?>
                <span class="badge"><?php echo $produto['badge']; ?></span>
            <?php } ?>
        </div>

        <!-- COLUNA DIREITA: INFOS -->
        <div class="produto-detalhe-info">

            <span class="produto-categoria"><?php echo ucfirst($produto['categoria']); ?></span>
            <h1 class="produto-detalhe-titulo"><?php echo $produto['nome']; ?></h1>
            <p class="produto-detalhe-preco">R$ <?php echo $produto['preco']; ?>,00</p>

            <div class="produto-detalhe-desc">
                <h3 class="produto-detalhe-subtitulo">Descrição</h3>
                <p><?php echo $produto['desc']; ?></p>
            </div>

            <div class="produto-detalhe-acoes">
                <button class="botao botao-carrinho"
                        data-id="<?php echo $id; ?>"
                        data-nome="<?php echo $produto['nome']; ?>">
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