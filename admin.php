<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";

// 1. Verifica se está logado
$sessao = "nao";
if(isset($_SESSION['login'])) $sessao = $_SESSION['login'];
teste_login($sessao);

// 2. Verifica se é admin
$logado = $_SESSION['email'];
if(!verifica_admin($server, $user, $password, $db, $logado)){
    header("Location: index.php?erro=acesso_negado");
    exit;
}

$mensagem = "";
$tipo_mensagem = "";
$editando = false;
$produto_edicao = null;

// Remover produto
if(isset($_GET['remover'])){
    $id_remover = (int) $_GET['remover'];
    
    $consulta_img = "SELECT Imagem FROM produtos WHERE Id = $id_remover";
    $res_img = banco($server, $user, $password, $db, $consulta_img);
    $linha_img = $res_img->fetch_assoc();
    
    if($linha_img){
        if(strpos($linha_img['Imagem'], 'uploads/') === 0 && file_exists($linha_img['Imagem'])){
            unlink($linha_img['Imagem']);
        }
        
        $delete = "DELETE FROM produtos WHERE Id = $id_remover";
        banco($server, $user, $password, $db, $delete);
        
        $mensagem = "Produto removido com sucesso!";
        $tipo_mensagem = "sucesso";
    } else {
        $mensagem = "Produto não encontrado.";
        $tipo_mensagem = "erro";
    }
}

// Prepara edição (Só busca os dados no banco)
if(isset($_GET['editar'])){
    $id_editar = (int) $_GET['editar'];
    $consulta_edit = "SELECT * FROM produtos WHERE Id = $id_editar";
    $res_edit = banco($server, $user, $password, $db, $consulta_edit);
    
    if($produto_edicao = $res_edit->fetch_assoc()){
        $editando = true;
    }
}


// Salvar edição

if(isset($_POST['salvar_edicao'])){
    $id_editar = (int) $_POST['id_produto'];
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $badge = $_POST['badge'];
    
    // Busca a imagem atual pra saber se vai trocar ou não
    $consulta_atual = "SELECT Imagem FROM produtos WHERE Id = $id_editar";
    $res_atual = banco($server, $user, $password, $db, $consulta_atual);
    $linha_atual = $res_atual->fetch_assoc();
    $imagem_atual = $linha_atual ? $linha_atual['Imagem'] : '';
    
    $caminho_banco = $imagem_atual; // Por padrão, mantém a atual

    // Se o usuário enviou uma nova imagem, faz o upload e substitui
    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK){
        $arquivo = $_FILES['imagem'];
        $limite = 2 * 1024 * 1024;

        if($arquivo['size'] > $limite){
            $mensagem = "A imagem deve ter no máximo 2MB.";
            $tipo_mensagem = "erro";
            $editando = true;
            $produto_edicao = [
                'Id' => $id_editar, 'Nome' => $nome, 'Preco' => $preco, 
                'Descricao' => $descricao, 'Categoria' => $categoria, 
                'Badge' => $badge, 'Imagem' => $imagem_atual
            ];
        } else {
            $info = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($info, $arquivo['tmp_name']);
            finfo_close($info);

            $tipos_permitidos = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

            if(!isset($tipos_permitidos[$mime])){
                $mensagem = "Formato inválido. Use JPG, PNG ou WEBP.";
                $tipo_mensagem = "erro";
                $editando = true;
                $produto_edicao = [
                    'Id' => $id_editar, 'Nome' => $nome, 'Preco' => $preco, 
                    'Descricao' => $descricao, 'Categoria' => $categoria, 
                    'Badge' => $badge, 'Imagem' => $imagem_atual
                ];
            } else {
                $pasta = __DIR__ . '/uploads/';
                if(!is_dir($pasta)) mkdir($pasta, 0755, true);

                $nome_novo = bin2hex(random_bytes(16)) . '.' . $tipos_permitidos[$mime];
                $destino = $pasta . $nome_novo;

                if(move_uploaded_file($arquivo['tmp_name'], $destino)){
                    // Apaga a imagem antiga SE ela for da pasta uploads
                    if(strpos($imagem_atual, 'uploads/') === 0 && file_exists($imagem_atual)){
                        unlink($imagem_atual);
                    }
                    $caminho_banco = 'uploads/' . $nome_novo;
                }
            }
        }
    }

    // Se não deu erro, atualiza no banco
    if($tipo_mensagem != "erro"){
        $update = "UPDATE produtos SET 
                    Nome = '$nome', 
                    Preco = '$preco', 
                    Descricao = '$descricao', 
                    Categoria = '$categoria', 
                    Badge = '$badge', 
                    Imagem = '$caminho_banco' 
                   WHERE Id = $id_editar";
        banco($server, $user, $password, $db, $update);

        $mensagem = "Produto atualizado com sucesso!";
        $tipo_mensagem = "sucesso";
        $editando = false; // Volta pra lista
    }
}

// Cadastrar novo produto

if(isset($_POST['cadastrar_produto'])){
    $nome = $_POST['nome'];
    $preco = $_POST['preco'];
    $descricao = $_POST['descricao'];
    $categoria = $_POST['categoria'];
    $badge = $_POST['badge'];

    if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] == UPLOAD_ERR_OK){
        $arquivo = $_FILES['imagem'];
        $limite = 2 * 1024 * 1024;

        if($arquivo['size'] > $limite){
            $mensagem = "A imagem deve ter no máximo 2MB.";
            $tipo_mensagem = "erro";
        } else {
            $info = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($info, $arquivo['tmp_name']);
            finfo_close($info);

            $tipos_permitidos = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

            if(!isset($tipos_permitidos[$mime])){
                $mensagem = "Formato inválido. Use JPG, PNG ou WEBP.";
                $tipo_mensagem = "erro";
            } else {
                $pasta = __DIR__ . '/uploads/';
                if(!is_dir($pasta)) mkdir($pasta, 0755, true);

                $nome_novo = bin2hex(random_bytes(16)) . '.' . $tipos_permitidos[$mime];
                $destino = $pasta . $nome_novo;

                if(move_uploaded_file($arquivo['tmp_name'], $destino)){
                    $caminho_banco = 'uploads/' . $nome_novo;

                    $consulta = "INSERT INTO produtos (Nome, Preco, Descricao, Imagem, Categoria, Badge) 
                                 VALUES ('$nome', '$preco', '$descricao', '$caminho_banco', '$categoria', '$badge')";
                    banco($server, $user, $password, $db, $consulta);

                    $mensagem = "Produto cadastrado com sucesso!";
                    $tipo_mensagem = "sucesso";
                } else {
                    $mensagem = "Erro ao salvar a imagem no servidor.";
                    $tipo_mensagem = "erro";
                }
            }
        }
    } else {
        $mensagem = "Selecione uma imagem válida.";
        $tipo_mensagem = "erro";
    }
}
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel">
        <h2 class="painel-titulo">Painel de Administração</h2>
        
        <?php if(!empty($mensagem)): ?>
            <div style="text-align:center; padding: 15px; margin-bottom: 20px; border-radius: 8px; background: <?php echo $tipo_mensagem == 'sucesso' ? 'rgba(61, 220, 132, 0.15)' : 'rgba(229, 9, 20, 0.15)'; ?>; color: <?php echo $tipo_mensagem == 'sucesso' ? '#3ddc84' : '#e50914'; ?>;">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <?php if($editando && $produto_edicao): ?>
            <!-- Formulário de Edição -->
            <h3 class="form-secao-titulo">Editando Produto: <?php echo $produto_edicao['Nome']; ?></h3>

            <form action="admin.php" method="post" enctype="multipart/form-data" class="formulario">
                <input type="hidden" name="id_produto" value="<?php echo $produto_edicao['Id']; ?>">

                <div class="campo">
                    <label>Nome do Produto:</label>
                    <input type="text" name="nome" value="<?php echo $produto_edicao['Nome']; ?>" required>
                </div>
                <div class="campo">
                    <label>Preço (ex: 89.90):</label>
                    <input type="number" step="0.01" name="preco" value="<?php echo $produto_edicao['Preco']; ?>" required>
                </div>
                <div class="campo">
                    <label>Descrição:</label>
                    <input type="text" name="descricao" value="<?php echo $produto_edicao['Descricao']; ?>">
                </div>
                <div class="campo">
                    <label>Categoria:</label>
                    <select name="categoria" required style="padding: 15px; background: var(--bg); color: white; border: 1px solid var(--borda-forte); border-radius: 10px;">
                        <option value="roupas" <?php echo $produto_edicao['Categoria'] == 'roupas' ? 'selected' : ''; ?>>Roupas</option>
                        <option value="acessorios" <?php echo $produto_edicao['Categoria'] == 'acessorios' ? 'selected' : ''; ?>>Acessórios</option>
                        <option value="suplementos" <?php echo $produto_edicao['Categoria'] == 'suplementos' ? 'selected' : ''; ?>>Suplementos</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Badge (Opcional - Ex: Novo, Top):</label>
                    <input type="text" name="badge" value="<?php echo $produto_edicao['Badge']; ?>">
                </div>
                <div class="campo">
                    <label>Imagem Atual:</label>
                    <img src="<?php echo $produto_edicao['Imagem']; ?>" style="width: 80px; height: 80px; object-fit: contain; background: #fff; border-radius: 8px; padding: 5px; margin-bottom: 10px;">
                    <label>Trocar Imagem (Opcional - máx 2MB):</label>
                    <input type="file" name="imagem" accept="image/jpeg, image/png, image/webp" style="padding: 10px; background: var(--bg); color: white; border: 1px solid var(--borda-forte);">
                    <small style="color: var(--texto-suave); margin-top: 5px; display: block;">Deixe em branco para manter a imagem atual.</small>
                </div>
                
                <div class="acoes mt-40">
                    <input type="submit" name="salvar_edicao" value="Salvar Alterações" style="background: var(--verde); color: #000;">
                    <a href="admin.php" class="botao" style="text-decoration: none; padding: 16px 44px; background: var(--bg-3); color: white; border: 1px solid var(--borda-forte);">Cancelar</a>
                </div>
            </form>

        <?php else: ?>
            <!-- Formulário de Cadastro e Listagem -->
            <h3 class="form-secao-titulo">Adicionar Novo Produto</h3>

            <form action="admin.php" method="post" enctype="multipart/form-data" class="formulario">
                <div class="campo">
                    <label>Nome do Produto:</label>
                    <input type="text" name="nome" required>
                </div>
                <div class="campo">
                    <label>Preço (ex: 89.90):</label>
                    <input type="number" step="0.01" name="preco" required>
                </div>
                <div class="campo">
                    <label>Descrição:</label>
                    <input type="text" name="descricao">
                </div>
                <div class="campo">
                    <label>Categoria:</label>
                    <select name="categoria" required style="padding: 15px; background: var(--bg); color: white; border: 1px solid var(--borda-forte); border-radius: 10px;">
                        <option value="roupas">Roupas</option>
                        <option value="acessorios">Acessórios</option>
                        <option value="suplementos">Suplementos</option>
                    </select>
                </div>
                <div class="campo">
                    <label>Badge (Opcional - Ex: Novo, Top):</label>
                    <input type="text" name="badge">
                </div>
                <div class="campo">
                    <label>Imagem do Produto (JPG, PNG ou WEBP - máx 2MB):</label>
                    <input type="file" name="imagem" accept="image/jpeg, image/png, image/webp" required style="padding: 10px; background: var(--bg); color: white; border: 1px solid var(--borda-forte);">
                </div>
                
                <div class="acoes mt-40">
                    <input type="submit" name="cadastrar_produto" value="Cadastrar Produto">
                </div>
            </form>

            <hr style="border-color: var(--borda); margin: 40px 0;">

            <h3 class="form-secao-titulo">Produtos Cadastrados</h3>
            
            <div class="lista-admin-produtos">
                <?php
                $consulta_lista = "SELECT * FROM produtos ORDER BY Id DESC";
                $resultado_lista = banco($server, $user, $password, $db, $consulta_lista);
                
                if($resultado_lista->num_rows > 0){
                    while($prod = $resultado_lista->fetch_assoc()){
                        ?>
                        <div class="admin-produto-item">
                            <img src="<?php echo $prod['Imagem']; ?>" alt="<?php echo $prod['Nome']; ?>" class="admin-produto-img">
                            <div class="admin-produto-info">
                                <strong><?php echo $prod['Nome']; ?></strong>
                                <span>R$ <?php echo number_format($prod['Preco'], 2, ',', '.'); ?> | <?php echo ucfirst($prod['Categoria']); ?></span>
                            </div>
                            <div class="admin-produto-botoes">
                                <a href="admin.php?editar=<?php echo $prod['Id']; ?>" class="botao editar">Editar</a>
                                <a href="admin.php?remover=<?php echo $prod['Id']; ?>" class="botao remover" onclick="return confirm('Tem certeza que deseja remover este produto?');">Remover</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p class='vazio'>Nenhum produto cadastrado.</p>";
                }
                ?>
            </div>
            
            <div class="painel-acoes" style="margin-top: 20px;">
                <a href="index.php" class="botao">Ver Loja</a>
            </div>
        <?php endif; ?>
    </section>
</main>

<?php include "footer.php"; ?>