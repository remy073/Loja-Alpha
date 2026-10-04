<?php
session_start();
extract($_GET);

$itens = [
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

if(isset($adicionar)){
    $idProduto = (int) $adicionar;
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
        header('Location: carrinho.php');
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
        <a href="#" class="vitrine-ver-todos">Ver todos →</a>
    </div>

    <section class="produtos" id="listaProdutos">
        <?php foreach($itens as $key => $value){ ?>
            <article class="produto" data-categoria="<?php echo $value['categoria']; ?>">
                <?php if(!empty($value['badge'])){ ?>
                    <span class="badge"><?php echo $value['badge']; ?></span>
                <?php } ?>
                <div class="produto-imagem">
                    <img src="<?php echo $value['imagem']; ?>" alt="<?php echo $value['nome']; ?>" loading="lazy">
                </div>
                <span class="produto-categoria"><?php echo ucfirst($value['categoria']); ?></span>
                <h3><?php echo $value['nome']; ?></h3>
                <p class="preco">R$ <?php echo $value['preco']; ?>,00</p>
                <a class="botao" href="?adicionar=<?php echo $key; ?>">Adicionar ao carrinho</a>
            </article>
        <?php } ?>
    </section>
</main>

<script>
    const botoesCategoria = document.querySelectorAll('.categoria');
    const cards           = document.querySelectorAll('.produto');

    botoesCategoria.forEach(botao => {
        botao.addEventListener('click', () => {
            botoesCategoria.forEach(b => b.classList.remove('ativo'));
            botao.classList.add('ativo');
            const categoria = botao.dataset.categoria;
            cards.forEach(card => {
                if (categoria === 'todos' || card.dataset.categoria === categoria) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    const campoBusca = document.getElementById('campoBusca');
    if (campoBusca) {
        campoBusca.addEventListener('input', () => {
            const texto = campoBusca.value.toLowerCase().trim();
            const categoriaAtiva = document.querySelector('.categoria.ativo').dataset.categoria;
            cards.forEach(card => {
                const nomeProduto = card.querySelector('h3').textContent.toLowerCase();
                const categoria   = card.dataset.categoria;
                const passaBusca     = texto === '' || nomeProduto.includes(texto);
                const passaCategoria = categoriaAtiva === 'todos' || categoria === categoriaAtiva;
                if (passaBusca && passaCategoria) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
</script>

<?php include "footer.php"; ?>