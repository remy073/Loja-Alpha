<?php
session_start();
extract($_GET);

$itens = [
    // ROUPAS
    ['imagem'=>'img/camisabs.webp',    'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Branca',  'categoria'=>'roupas',      'badge'=>null],
    ['imagem'=>'img/camisabs2.webp',   'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Preta',   'categoria'=>'roupas',      'badge'=>'Novo'],
    ['imagem'=>'img/shortbsblack.webp','preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Preta',  'categoria'=>'roupas',      'badge'=>null],
    ['imagem'=>'img/shortbsgray.webp', 'preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Cinza',  'categoria'=>'roupas',      'badge'=>null],
    ['imagem'=>'img/copobs.webp',      'preco'=>49,  'nome'=>'Coqueteleira Black Skull',              'categoria'=>'acessorios',  'badge'=>'Top'],
    ['imagem'=>'img/mochila.webp',     'preco'=>349, 'nome'=>'Mochila Black Skull Oficial Clio 50L',  'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/bone.webp',        'preco'=>89,  'nome'=>'Boné Black Skull Cinza',                'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/bolsabs.webp',     'preco'=>149, 'nome'=>'Bolsa Esportiva Black Skull',           'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/tenisbranco.webp', 'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Branco',   'categoria'=>'acessorios',  'badge'=>'Novo'],
    ['imagem'=>'img/tenispreto.webp',  'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Cinza',    'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/americatenis.webp','preco'=>349, 'nome'=>'Tênis Black Skull Lifter Ipo American', 'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/creatina.webp',    'preco'=>129, 'nome'=>'Creatina Monohidratada Black Skull',    'categoria'=>'suplementos', 'badge'=>'Mais vendido'],
    ['imagem'=>'img/pretreino.webp',   'preco'=>149, 'nome'=>'Pré-Treino B.O.P.E Black Skull',        'categoria'=>'suplementos', 'badge'=>null],
    ['imagem'=>'img/whey.webp',        'preco'=>199, 'nome'=>'Whey 100% Black Skull',                 'categoria'=>'suplementos', 'badge'=>'Mais vendido'],
    ['imagem'=>'img/cafeina.webp',     'preco'=>99,  'nome'=>'Thermo Flame Cafeína Black Skull',      'categoria'=>'suplementos', 'badge'=>'Novo']
];

// COMPRAR AGORA 
if(isset($comprar)){
    $idProduto = (int) $comprar;
    if(isset($itens[$idProduto])){
        if(isset($_SESSION['carrinho'][$idProduto])){
            $_SESSION['carrinho'][$idProduto]['quantidade']++;
        }else{
            $_SESSION['carrinho'][$idProduto] = [
                'quantidade' => 1,
                'nome'       => $itens[$idProduto]['nome'],
                'preco'      => $itens[$idProduto]['preco']
            ];
        }
        header('Location: finalizar.php');
        exit;
    }
}
?>
<?php include "header.php"; ?>

<section class="banner">
    <div class="banner-conteudo">
        <p class="banner-subtitulo">Estilo · Performance · Atitude</p>
        <h1 class="banner-titulo">ALPHA</h1>
        <p class="banner-texto">Mais que uma loja, um estilo de vida. Vista a força, mostre sua essência.</p>
        <a href="#produtos" class="banner-botao">
            Ver produtos
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
    </div>
</section>

<section class="categorias">
    <div class="categorias-conteudo" id="filtros">
        <button class="categoria ativo" data-categoria="todos">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
            Todos
        </button>
        <button class="categoria" data-categoria="roupas">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20.38 3.46 16 2a4 4 0 0 1-8 0L3.62 3.46a2 2 0 0 0-1.34 2.23l.58 3.47a1 1 0 0 0 .99.84H6v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V10h2.15a1 1 0 0 0 .99-.84l.58-3.47a2 2 0 0 0-1.34-2.23z"/></svg>
            Roupas
        </button>
        <button class="categoria" data-categoria="acessorios">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            Acessórios
        </button>
        <button class="categoria" data-categoria="suplementos">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M8 2h8l-1 4h-6z"/><path d="M9 6v13a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2V6"/><line x1="9" y1="13" x2="15" y2="13"/></svg>
            Suplementos
        </button>
    </div>
</section>

<main class="vitrine" id="produtos">
    <div class="vitrine-cabecalho">
        <h2 class="vitrine-titulo">Nossos Produtos</h2>
    </div>

    <section class="produtos" id="listaProdutos">
        <?php foreach($itens as $key => $value){ ?>
            <article class="produto" data-categoria="<?php echo $value['categoria']; ?>">

                <?php if(!empty($value['badge'])){ ?>
                    <span class="badge"><?php echo $value['badge']; ?></span>
                <?php } ?>

                <a href="produto.php?id=<?php echo $key; ?>" class="produto-imagem" title="Ver detalhes">
                    <img src="<?php echo $value['imagem']; ?>" alt="<?php echo $value['nome']; ?>" loading="lazy">
                </a>

                <span class="produto-categoria"><?php echo ucfirst($value['categoria']); ?></span>
                <h3>
                    <a href="produto.php?id=<?php echo $key; ?>" class="produto-link-titulo" title="Ver detalhes">
                        <?php echo $value['nome']; ?>
                    </a>
                </h3>
                <p class="preco">R$ <?php echo $value['preco']; ?>,00</p>

                <div class="produto-acoes">
                    <button class="botao botao-carrinho"
                            data-id="<?php echo $key; ?>"
                            data-nome="<?php echo $value['nome']; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        Adicionar
                    </button>
                    <a class="botao botao-comprar" href="?comprar=<?php echo $key; ?>">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                        Comprar
                    </a>
                </div>
            </article>
        <?php } ?>
    </section>
</main>

<?php include "footer.php"; ?>