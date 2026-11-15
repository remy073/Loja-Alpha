<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";

// Se o usuário tentar acessar direto, volta pro login
if(!isset($_SESSION['recuperar_email'])){
    header("Location: login.php");
    exit;
}

$erro = "";

if(isset($_POST['trocar'])){
    $token_digitado = $_POST['token'];
    $nova_senha = $_POST['nova_senha'];
    $email = $_SESSION['recuperar_email'];

    // Verifica se o token bate com o do banco
    $consulta = "SELECT * FROM usuarios WHERE Email = '$email' AND Token_Recuperacao = '$token_digitado'";
    $resultado = banco($server, $user, $password, $db, $consulta);

    if($linha = $resultado->fetch_assoc()){
        // Atualiza a senha e limpa o token por segurança
        $update = "UPDATE usuarios SET Senha = '$nova_senha', Token_Recuperacao = NULL WHERE Email = '$email'";
        banco($server, $user, $password, $db, $update);
        
        // Destrói a sessão temporária de recuperação
        unset($_SESSION['recuperar_email']);
        
        header("Location: login.php");
        exit;
    } else {
        $erro = "Código inválido! Verifique o e-mail e tente novamente.";
    }
}
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel painel-estreito">
        <h2 class="painel-titulo">Nova Senha</h2>
        <p class="cliente-logado" style="text-align: center; color: var(--texto-suave); margin-bottom: 20px;">Digite o código que enviamos para o seu e-mail.</p>

        <?php if(!empty($erro)): ?>
            <p style="color: var(--destaque); text-align: center; margin-bottom: 15px;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="trocar_senha.php" method="post" class="formulario">
            <div class="campo">
                <label for="token">Código de 6 dígitos</label>
                <input type="text" name="token" id="token" required maxlength="6" placeholder="Ex: 123456">
            </div>
            <div class="campo">
                <label for="nova_senha">Nova Senha</label>
                <input type="password" name="nova_senha" id="nova_senha" required placeholder="Digite a nova senha">
            </div>
            <div class="acoes mt-40">
                <input type="submit" name="trocar" value="Alterar Senha">
            </div>
        </form>
    </section>
</main>

<?php include "footer.php"; ?>