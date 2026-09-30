<?php
session_start();
extract($_GET);

$itens = [
    // ROUPAS
    ['imagem'=>'img/camisabs.webp',    'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Branca',  'categoria'=>'roupas',      'badge'=>null],
    ['imagem'=>'img/camisabs2.webp',   'preco'=>89,  'nome'=>'Camisa Compressão Black Skull Preta',   'categoria'=>'roupas',      'badge'=>'Novo'],
    ['imagem'=>'img/shortbsblack.webp','preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Preta',  'categoria'=>'roupas',      'badge'=>null],
    ['imagem'=>'img/shortbsgray.webp', 'preco'=>79,  'nome'=>'Bermuda Compressão Black Skull Cinza',  'categoria'=>'roupas',      'badge'=>null],

    // ACESSÓRIOS
    ['imagem'=>'img/copobs.webp',      'preco'=>49,  'nome'=>'Coqueteleira Black Skull',              'categoria'=>'acessorios',  'badge'=>'Top'],
    ['imagem'=>'img/mochila.webp',     'preco'=>349, 'nome'=>'Mochila Black Skull Oficial Clio 50L',  'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/bone.webp',        'preco'=>89,  'nome'=>'Boné Black Skull Cinza',                'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/bolsabs.webp',     'preco'=>149, 'nome'=>'Bolsa Esportiva Black Skull',           'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/tenisbranco.webp', 'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Branco',   'categoria'=>'acessorios',  'badge'=>'Novo'],
    ['imagem'=>'img/tenispreto.webp',  'preco'=>299, 'nome'=>'Tênis Black Skull Urban Camo Cinza',    'categoria'=>'acessorios',  'badge'=>null],
    ['imagem'=>'img/americatenis.webp','preco'=>349, 'nome'=>'Tênis Black Skull Lifter Ipo American', 'categoria'=>'acessorios',  'badge'=>null],

    // SUPLEMENTOS
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
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Alpha · Loja Virtual</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header class="topo">
    <div class="topo-conteudo">
        <h1 class="logo">ALPHA</h1>
        <p class="slogan">Performance · Estilo · Conforto</p>

        <nav class="menu">
            <a href="index.php" class="ativo">Vitrine</a>
            <a href="carrinho.php">Carrinho</a>

            <?php if(isset($_SESSION['login']) && $_SESSION['login'] == "ok"){ ?>
                <a href="minhasCompras.php">Minhas Compras</a>
                <a href="sair.php">Sair</a>
            <?php }else{ ?>
                <a href="login.php">Login</a>
                <a href="formulario.php">Cadastro</a>
            <?php } ?>
        </nav>
    </div>
</header>

<main class="vitrine">

    <section class="vitrine-titulo">
        <h2>Nossos Produtos</h2>
        <p>Linha Black Skull — feita para quem treina pesado.</p>
    </section>

    <nav class="filtros" id="filtros">
        <button class="filtro ativo" data-categoria="todos">Todos</button>
        <button class="filtro" data-categoria="roupas">Roupas</button>
        <button class="filtro" data-categoria="acessorios">Acessórios</button>
        <button class="filtro" data-categoria="suplementos">Suplementos</button>
    </nav>

    <section class="produtos" id="produtos">
        <?php foreach($itens as $key => $value){ ?>
            <article class="produto" data-categoria="<?php echo $value['categoria']; ?>">

                <?php if(!empty($value['badge'])){ ?>
                    <span class="badge"><?php echo $value['badge']; ?></span>
                <?php } ?>

                <div class="produto-imagem">
                    <img src="<?php echo $value['imagem']; ?>" alt="<?php echo $value['nome']; ?>" loading="lazy">
                </div>
                <h3><?php echo $value['nome']; ?></h3>
                <p class="preco">R$ <?php echo $value['preco']; ?>,00</p>
                <a class="botao" href="?adicionar=<?php echo $key; ?>">Adicionar</a>
            </article>
        <?php } ?>
    </section>

</main>

<footer class="rodape">
    <p>Reilly &amp; Gabriel &copy; <?php echo date('Y'); ?> — Projeto Integrador</p>
</footer>

<script>
    const botoes  = document.querySelectorAll('.filtro');
    const cards   = document.querySelectorAll('.produto');

    botoes.forEach(botao => {
        botao.addEventListener('click', () => {
            botoes.forEach(b => b.classList.remove('ativo'));
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
</script>

</body>
</html>