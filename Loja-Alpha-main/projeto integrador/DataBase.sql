
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
    Numero VARCHAR(20) NOT NULL
);


-- TABELA: vendas
-- Armazena os pedidos finalizados
-- Chave estrangeira: Email → usuarios.Email

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

    CONSTRAINT fk_vendas_usuario
        FOREIGN KEY (Email) REFERENCES usuarios(Email)
);


-- POVOAMENTO DE DADOS

-- Usuários de exemplo
INSERT INTO usuarios (Nome, Email, Senha, Estado, Cidade, Bairro, Rua, Numero) VALUES
('Gabriel Vieira',   'gabriel@gmail.com',  '12345', 'BA', 'Eunápolis',      'Centro',             'Rua das Flores',   '260'),
('Reilly Ferreira',    'reilly@gmail.com',   '12345', 'BA', 'Eunápolis',      'Alto da Boa Vista',  'Reino Unido',      '150'),
('Dario Mattos',      'dario@gmail.com',    '12345', 'BA', 'Vitória',        'Centro',             'Av. Brasil',       '742'),
('Luis Felipe',   'luisfelipe@gmail.com',    '12345', 'SP', 'São Paulo',      'Vila Mariana',       'Rua Domingos',     '88'),
('Gabriella Suque',       'gabi@gmail.com',      '12345', 'RJ', 'Rio de Janeiro', 'Copacabana',         'Av. Atlântica',    '1020');

-- Vendas de exemplo
INSERT INTO vendas (Email, Estado, Cidade, Bairro, Rua, Numero, Produtos, Total) VALUES
('gabriel@gmail.com', 'BA', 'Eunápolis', 'Centro',
 'Rua das Flores', '260',
 'Camisa Compressão Black Skull Branca | Quantidade: 1 | Preco: R$ 89,00; Coqueteleira Black Skull | Quantidade: 1 | Preco: R$ 49,00;',
 138.00),

('gabriel@gmail.com', 'BA', 'Eunápolis', 'Centro',
 'Rua das Flores', '260',
 'Whey 100% Black Skull | Quantidade: 2 | Preco: R$ 398,00;',
 398.00),

('reilly@gmail.com', 'BA', 'Eunápolis', 'Alto da Boa Vista',
 'Reino Unido', '150',
 'Creatina Monohidratada Black Skull | Quantidade: 1 | Preco: R$ 129,00; Pré-Treino B.O.P.E Black Skull | Quantidade: 1 | Preco: R$ 149,00;',
 278.00),

('dario@gmail.com', 'BA', 'Vitória', 'Centro',
 'Av. Brasil', '742',
 'Tênis Black Skull Lifter Ipo American | Quantidade: 1 | Preco: R$ 349,00;',
 349.00),

('luisfelipe@gmail.com', 'SP', 'São Paulo', 'Vila Mariana',
 'Rua Domingos', '88',
 'Mochila Black Skull Oficial Clio 50 Litros | Quantidade: 1 | Preco: R$ 349,00; Boné Black Skull Cinza | Quantidade: 2 | Preco: R$ 178,00;',
 527.00),

('gabi@gmail.com', 'RJ', 'Rio de Janeiro', 'Copacabana',
 'Av. Atlântica', '1020',
 'Thermo Flame Cafeína Black Skull | Quantidade: 3 | Preco: R$ 297,00;',
 297.00),

('gabi@gmail.com', 'RJ', 'Rio de Janeiro', 'Copacabana',
 'Av. Atlântica', '1020',
 'Camisa Compressão Black Skull Preta | Quantidade: 1 | Preco: R$ 89,00; Bermuda Compressão Black Skull Preta | Quantidade: 1 | Preco: R$ 79,00;',
 168.00);