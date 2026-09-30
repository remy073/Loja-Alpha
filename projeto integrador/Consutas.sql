-- Consulta 1: Listar todos os pedidos de um usuário específico 
SELECT
    v.Id AS Pedido,
    v.Produtos,
    v.Total,
    v.Cidade,
    v.Estado
FROM vendas v
WHERE v.Email = 'exemplousuario@gmail.com' -- Substitua pelo email do usuário desejado
ORDER BY v.Id DESC;

-- Consulta 2: Total de valor gasto por cada usuário
SELECT
    u.Nome,
    u.Email,
    COUNT(v.Id) AS Quantidade_Pedidos,
    SUM(v.Total) AS Total_Gasto
FROM usuarios u
INNER JOIN vendas v ON u.Email = v.Email
GROUP BY u.Id, u.Nome, u.Email
ORDER BY Total_Gasto DESC;

-- Consulta 3: Listar vendas por estado
SELECT
    Estado,
    COUNT(*) AS Quantidade_Vendas,
    SUM(Total) AS Total_Arrecadado
FROM vendas
GROUP BY Estado
ORDER BY Total_Arrecadado DESC;

-- Consulta 4: Outras consultas basicas
SELECT * FROM usuarios;
SELECT * FROM vendas;