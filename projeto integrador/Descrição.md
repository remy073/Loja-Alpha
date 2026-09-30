# Objetivo do sistema:

A Alpha é uma loja virtual especializada em produtos da marca Black Skull, voltada para o público fitness. O sistema permite que clientes naveguem por um catálogo de roupas, acessórios e suplementos, adicionem produtos ao carrinho, realizem cadastro com endereço completo e finalizem compras, tendo o histórico registrado.

# O que o sistema permite realizar:

• Navegação por produtos separados em categorias (Roupas, Acessórios, Suplementos)
• Filtro de produtos por categoria em tempo real
• Cadastro de usuários com nome, e-mail, senha e endereço completo
• Login de usuários cadastrados
• Adição e remoção de produtos no carrinho
• Finalização de compra com confirmação de endereço
• Visualização do histórico de compras do usuário
• Principais funcionalidades:
• Cadastro de usuário — armazena dados pessoais (nome, e-mail, senha) e endereço (estado, cidade, bairro, rua, número)
• Login — autenticação por e-mail e senha, com criação de sessão
• Carrinho de compras — produtos ficam na sessão do usuário até finalizar
• Finalização de venda — registra o pedido, o endereço de entrega e o valor total
• Histórico de compras — lista todos os pedidos de um cliente
• Informações que precisam ser armazenadas:

# Tabela usuarios:

• Id (identificador único, auto incremental)
• Nome completo
• E-mail (único, não pode repetir)
• Senha
• Estado, Cidade, Bairro, Rua, Número (endereço completo)

# Tabela vendas:

• Id (identificador único, auto incremental)
• E-mail do comprador
• Endereço de entrega (Estado, Cidade, Bairro, Rua, Número)
• Produtos comprados (descrição completa com quantidade e subtotal)
• Total da venda