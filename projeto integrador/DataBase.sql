DROP DATABASE IF EXISTS loja4;

CREATE DATABASE loja4
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE loja4;

CREATE TABLE usuarios (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(100) NOT NULL,
    Email VARCHAR(150) NOT NULL UNIQUE,
    Senha VARCHAR(255) NOT NULL,
    Estado VARCHAR(100) NOT NULL,
    Cidade VARCHAR(100) NOT NULL,
    Bairro VARCHAR(100) NOT NULL,
    Rua VARCHAR(150) NOT NULL,
    Numero VARCHAR(20) NOT NULL,
    Token_Recuperacao VARCHAR(255) NULL,
    Admin TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE vendas (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Email VARCHAR(150) NOT NULL,
    Estado VARCHAR(100) NOT NULL,
    Cidade VARCHAR(100) NOT NULL,
    Bairro VARCHAR(100) NOT NULL,
    Rua VARCHAR(150) NOT NULL,
    Numero VARCHAR(20) NOT NULL,
    Produtos TEXT NOT NULL,
    Total DECIMAL(10,2) NOT NULL,
    Pagamento VARCHAR(20) NOT NULL DEFAULT 'pix', -- NOVA COLUNA AQUI

    CONSTRAINT fk_vendas_usuario
        FOREIGN KEY (Email) REFERENCES usuarios(Email)
);

CREATE TABLE produtos (
    Id INT AUTO_INCREMENT PRIMARY KEY,
    Nome VARCHAR(150) NOT NULL,
    Preco DECIMAL(10,2) NOT NULL,
    Descricao TEXT,
    Imagem VARCHAR(255),
    Categoria VARCHAR(50),
    Badge VARCHAR(50) DEFAULT NULL
);

-- Usuarios de exemplo (1 admin e 5 usuários normais)

INSERT INTO usuarios (Nome, Email, Senha, Estado, Cidade, Bairro, Rua, Numero, Admin) VALUES
('Starke (Admin)',   'starke120hz@gmail.com', '12345', 'BA', 'Eunápolis',      'Centro',             'Rua Admin',        '1',   1),
('Gabriel Vieira',   'gabriel@gmail.com',     '12345', 'BA', 'Eunápolis',      'Centro',             'Rua das Flores',   '260', 0),
('Reilly Ferreira',  'reilly@gmail.com',      '12345', 'BA', 'Eunápolis',      'Alto da Boa Vista',  'Reino Unido',      '150', 0),
('Dario Mattos',     'dario@gmail.com',       '12345', 'BA', 'Vitória',        'Centro',             'Av. Brasil',       '742', 0),
('Luis Felipe',      'luisfelipe@gmail.com',  '12345', 'SP', 'São Paulo',      'Vila Mariana',       'Rua Domingos',     '88',  0),
('Gabriella Suque',  'gabi@gmail.com',        '12345', 'RJ', 'Rio de Janeiro', 'Copacabana',         'Av. Atlântica',    '1020',0);


-- Vendas de exemplo 

INSERT INTO vendas (Email, Estado, Cidade, Bairro, Rua, Numero, Produtos, Total, Pagamento) VALUES
('gabriel@gmail.com', 'BA', 'Eunápolis', 'Centro',
 'Rua das Flores', '260',
 'Camisa Compressão Black Skull Branca | Quantidade: 1 | Preco: R$ 89,00; Coqueteleira Black Skull | Quantidade: 1 | Preco: R$ 49,00;',
 138.00, 'pix'),

('gabriel@gmail.com', 'BA', 'Eunápolis', 'Centro',
 'Rua das Flores', '260',
 'Whey 100% Black Skull | Quantidade: 2 | Preco: R$ 398,00;',
 398.00, 'credito'),

('reilly@gmail.com', 'BA', 'Eunápolis', 'Alto da Boa Vista',
 'Reino Unido', '150',
 'Creatina Monohidratada Black Skull | Quantidade: 1 | Preco: R$ 129,00; Pré-Treino B.O.P.E Black Skull | Quantidade: 1 | Preco: R$ 149,00;',
 278.00, 'debito'),

('dario@gmail.com', 'BA', 'Vitória', 'Centro',
 'Av. Brasil', '742',
 'Tênis Black Skull Lifter Ipo American | Quantidade: 1 | Preco: R$ 349,00;',
 349.00, 'pix'),

('luisfelipe@gmail.com', 'SP', 'São Paulo', 'Vila Mariana',
 'Rua Domingos', '88',
 'Mochila Black Skull Oficial Clio 50 Litros | Quantidade: 1 | Preco: R$ 349,00; Boné Black Skull Cinza | Quantidade: 2 | Preco: R$ 178,00;',
 527.00, 'credito'),

('gabi@gmail.com', 'RJ', 'Rio de Janeiro', 'Copacabana',
 'Av. Atlântica', '1020',
 'Thermo Flame Cafeína Black Skull | Quantidade: 3 | Preco: R$ 297,00;',
 297.00, 'pix'),

('gabi@gmail.com', 'RJ', 'Rio de Janeiro', 'Copacabana',
 'Av. Atlântica', '1020',
 'Camisa Compressão Black Skull Preta | Quantidade: 1 | Preco: R$ 89,00; Bermuda Compressão Black Skull Preta | Quantidade: 1 | Preco: R$ 79,00;',
 168.00, 'debito');

-- Produtos de exemplo

INSERT INTO produtos (Nome, Preco, Descricao, Imagem, Categoria, Badge) VALUES
-- ROUPAS
('Camisa Compressão Black Skull Branca', 89.00, 'Camisa de compressão com tecido respirável de alta performance. Modelagem justa que acompanha o corpo, ideal para treinos intensos. Logo Black Skull aplicado nas costas.', 'img/camisabs.webp', 'roupas', NULL),
('Camisa Compressão Black Skull Preta', 89.00, 'Versão preta da camisa de compressão oficial Black Skull. Tecido com elasticidade e secagem rápida, perfeita para musculação e crossfit.', 'img/camisabs2.webp', 'roupas', 'Novo'),
('Bermuda Compressão Black Skull Preta', 79.00, 'Bermuda de compressão preta com elástico na cintura e cordão de ajuste. Tecido leve e resistente, ideal para treinos de alta intensidade.', 'img/shortbsblack.webp', 'roupas', NULL),
('Bermuda Compressão Black Skull Cinza', 79.00, 'Bermuda de compressão cinza com logo Black Skull. Conforto e mobilidade para o dia a dia ou para a academia.', 'img/shortbsgray.webp', 'roupas', NULL),
-- ACESSÓRIOS
('Coqueteleira Black Skull', 49.00, 'Coqueteleira oficial Black Skull com capacidade para 700ml. Tampa com trava e mola misturadora para shakes e suplementos.', 'img/copobs.webp', 'acessorios', 'Top'),
('Mochila Black Skull Oficial Clio 50L', 349.00, 'Mochila tática Black Skull com 50 litros de capacidade. Diversos compartimentos, tecido resistente e patches bordados. Ideal para treino e viagem.', 'img/mochila.webp', 'acessorios', NULL),
('Boné Black Skull Cinza', 89.00, 'Boné Black Skull cinza com aba curva e ajuste traseiro. Logo bordado em destaque. Estilo e proteção para o dia a dia.', 'img/bone.webp', 'acessorios', NULL),
('Bolsa Esportiva Black Skull', 149.00, 'Bolsa esportiva Black Skull com cordão ajustável. Leve e prática, ideal para carregar itens de treino. Logo estampado em destaque.', 'img/bolsabs.webp', 'acessorios', NULL),
('Tênis Black Skull Urban Camo Branco', 299.00, 'Tênis Black Skull Urban Camo na versão branca. Solado em borracha, cabedal em camurça e detalhes em camouflage. Conforto e estilo urbano.', 'img/tenisbranco.webp', 'acessorios', 'Novo'),
('Tênis Black Skull Urban Camo Cinza', 299.00, 'Tênis Black Skull Urban Camo na versão cinza. Mesma construção do modelo branco, com acabamento em tons escuros para o dia a dia.', 'img/tenispreto.webp', 'acessorios', NULL),
('Tênis Black Skull Lifter Ipo American', 349.00, 'Tênis Black Skull Lifter Ipo American com bandeira dos EUA. Estrutura reforçada para treinos de força e uso diário.', 'img/americatenis.webp', 'acessorios', NULL),
-- SUPLEMENTOS
('Creatina Monohidratada Black Skull', 129.00, 'Creatina monohidratada Black Skull em pó (300g). Auxilia no ganho de força e massa muscular. Sabor neutro, ideal para misturar com shakes.', 'img/creatina.webp', 'suplementos', 'Mais vendido'),
('Pré-Treino B.O.P.E Black Skull', 149.00, 'Pré-treino B.O.P.E Black Skull (150g). Fórmula com cafeína e beta-alanina para mais energia, foco e resistência nos treinos.', 'img/pretreino.webp', 'suplementos', NULL),
('Whey 100% Black Skull', 199.00, 'Whey protein 100% Black Skull (837g). Alto teor de proteína por dose, sabor baunilha. Auxilia na recuperação muscular e ganho de massa.', 'img/whey.webp', 'suplementos', 'Mais vendido'),
('Thermo Flame Cafeína Black Skull', 99.00, 'Termogênico Thermo Flame Black Skull (120 cápsulas). Fórmula com cafeína para acelerar o metabolismo e aumentar a disposição.', 'img/cafeina.webp', 'suplementos', 'Novo');