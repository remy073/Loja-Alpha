/*  ALPHA · script.js */

document.addEventListener('DOMContentLoaded', () => {

    /* 1. NAVBAR AO ROLAR */
    const header = document.querySelector('.header');
    if (header) {
        window.addEventListener('scroll', () => {
            header.classList.toggle('rolada', window.scrollY > 50);
        });
    }

    /* 2. SCROLL SUAVE */
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', (e) => {
            const alvo = document.querySelector(link.getAttribute('href'));
            if (alvo) {
                e.preventDefault();
                alvo.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    /* 3. BOTÃO VOLTAR AO TOPO */
    const btnTopo = document.createElement('button');
    btnTopo.className = 'voltar-topo';
    btnTopo.setAttribute('aria-label', 'Voltar ao topo');
    btnTopo.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"/></svg>';
    document.body.appendChild(btnTopo);
    window.addEventListener('scroll', () => btnTopo.classList.toggle('visivel', window.scrollY > 400));
    btnTopo.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));

    /* 4. REVEAL */
    const elementosReveal = document.querySelectorAll('.produto, .painel, .vitrine-cabecalho, .item');
    elementosReveal.forEach(el => el.classList.add('reveal'));
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, i) => {
            if (entry.isIntersecting) {
                setTimeout(() => entry.target.classList.add('ativo'), i * 60);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });
    elementosReveal.forEach(el => observer.observe(el));

    /* 5. FILTRO DE CATEGORIA */
    const botoesCategoria = document.querySelectorAll('.categoria');
    const cards = document.querySelectorAll('.produto');
    botoesCategoria.forEach(botao => {
        botao.addEventListener('click', () => {
            botoesCategoria.forEach(b => b.classList.remove('ativo'));
            botao.classList.add('ativo');
            const categoria = botao.dataset.categoria;
            cards.forEach(card => {
                card.style.display = (categoria === 'todos' || card.dataset.categoria === categoria) ? '' : 'none';
            });
        });
    });

    /* 6. MENSAGEM FLASH */
    function mostrarFlash(texto) {
        const msg = document.createElement('div');
        msg.className = 'flash-msg';
        msg.textContent = texto;
        document.body.appendChild(msg);
        setTimeout(() => msg.classList.add('visivel'), 100);
        setTimeout(() => {
            msg.classList.remove('visivel');
            setTimeout(() => msg.remove(), 400);
        }, 3000);
    }

    /* 7. CONTADOR ANIMADO */
    const badge = document.querySelector('.carrinho-badge');
    if (badge) {
        badge.style.transform = 'scale(1.3)';
        setTimeout(() => badge.style.transform = 'scale(1)', 300);
    }

    /* 8. ADICIONAR AO CARRINHO VIA AJAX */
    document.querySelectorAll('.botao-carrinho[data-id]').forEach(btn => {
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const id = btn.dataset.id;
            const nome = btn.dataset.nome;
            const textoOriginal = btn.innerHTML;
            
            btn.innerHTML = '...';
            btn.disabled = true;

            try {
                const resp = await fetch('adicionar.php?id=' + id);
                const data = await resp.json();

                if (data.ok) {
                    let badge = document.querySelector('.carrinho-badge');
                    if (badge) {
                        badge.textContent = data.total;
                        badge.style.transform = 'scale(1.4)';
                        setTimeout(() => badge.style.transform = 'scale(1)', 300);
                    } else {
                        const carrinhoIcone = document.querySelector('.header-carrinho');
                        if (carrinhoIcone) {
                            const novoBadge = document.createElement('span');
                            novoBadge.className = 'carrinho-badge';
                            novoBadge.textContent = data.total;
                            carrinhoIcone.appendChild(novoBadge);
                        }
                    }
                    btn.innerHTML = '✓ Adicionado';
                    mostrarFlash(nome + ' foi adicionado!');
                } else {
                    btn.innerHTML = 'Erro';
                }
            } catch (err) {
                console.error(err);
                btn.innerHTML = 'Erro';
            }
            
            setTimeout(() => {
                btn.innerHTML = textoOriginal;
                btn.disabled = false;
            }, 1500);
        });
    });

    /* 9. PESQUISA DINÂMICA (DROPDOWN) */
    const campoBusca = document.getElementById('campoBusca');
    const resultados = document.getElementById('buscaResultados');

    // Lista de itens pra busca 
    const itensBusca = [
        { id: 0, nome: 'Camisa Compressão Black Skull Branca', img: 'img/camisabs.webp', preco: 89 },
        { id: 1, nome: 'Camisa Compressão Black Skull Preta', img: 'img/camisabs2.webp', preco: 89 },
        { id: 2, nome: 'Bermuda Compressão Black Skull Preta', img: 'img/shortbsblack.webp', preco: 79 },
        { id: 3, nome: 'Bermuda Compressão Black Skull Cinza', img: 'img/shortbsgray.webp', preco: 79 },
        { id: 4, nome: 'Coqueteleira Black Skull', img: 'img/copobs.webp', preco: 49 },
        { id: 5, nome: 'Mochila Black Skull Oficial Clio 50L', img: 'img/mochila.webp', preco: 349 },
        { id: 6, nome: 'Boné Black Skull Cinza', img: 'img/bone.webp', preco: 89 },
        { id: 7, nome: 'Bolsa Esportiva Black Skull', img: 'img/bolsabs.webp', preco: 149 },
        { id: 8, nome: 'Tênis Black Skull Urban Camo Branco', img: 'img/tenisbranco.webp', preco: 299 },
        { id: 9, nome: 'Tênis Black Skull Urban Camo Cinza', img: 'img/tenispreto.webp', preco: 299 },
        { id: 10, nome: 'Tênis Black Skull Lifter Ipo American', img: 'img/americatenis.webp', preco: 349 },
        { id: 11, nome: 'Creatina Monohidratada Black Skull', img: 'img/creatina.webp', preco: 129 },
        { id: 12, nome: 'Pré-Treino B.O.P.E Black Skull', img: 'img/pretreino.webp', preco: 149 },
        { id: 13, nome: 'Whey 100% Black Skull', img: 'img/whey.webp', preco: 199 },
        { id: 14, nome: 'Thermo Flame Cafeína Black Skull', img: 'img/cafeina.webp', preco: 99 }
    ];

    if (campoBusca && resultados) {
        campoBusca.addEventListener('input', () => {
            const texto = campoBusca.value.toLowerCase().trim();
            resultados.innerHTML = '';

            if (texto.length > 0) {
                const filtrados = itensBusca.filter(item => item.nome.toLowerCase().includes(texto));

                if (filtrados.length > 0) {
                    filtrados.forEach(item => {
                        const link = document.createElement('a');
                        link.href = 'produto.php?id=' + item.id; // vai pra página do produto
                        link.className = 'busca-item';
                        link.innerHTML = `
                            <img src="${item.img}" alt="${item.nome}">
                            <div>
                                <span class="busca-nome">${item.nome}</span>
                                <span class="busca-preco">R$ ${item.preco},00</span>
                            </div>
                        `;
                        resultados.appendChild(link);
                    });
                    resultados.classList.add('visivel');
                } else {
                    resultados.innerHTML = '<div class="busca-vazio">Nenhum produto encontrado</div>';
                    resultados.classList.add('visivel');
                }
            } else {
                resultados.classList.remove('visivel');
            }
        });

        // Fecha ao clicar fora
        document.addEventListener('click', (e) => {
            if (!campoBusca.contains(e.target) && !resultados.contains(e.target)) {
                resultados.classList.remove('visivel');
            }
        });
    }
});