<?php
session_start();
include "app/cons.php";
require_once "app/DLL.php";
require_once "enviar_email.php"; 

$erro = "";

if(isset($_POST['enviar'])){
    $email = $_POST['email'];
    $consulta = "SELECT * FROM usuarios WHERE Email = '$email'";
    $resultado = banco($server, $user, $password, $db, $consulta);
    
    if($linha = $resultado->fetch_assoc()){
        // Gera um código de 6 dígitos
        $token = rand(100000, 999999);
        
        // Salva o token no banco
        $update = "UPDATE usuarios SET Token_Recuperacao = '$token' WHERE Email = '$email'";
        banco($server, $user, $password, $db, $update);
        
        // Chama a função do PHPMailer
        if(enviarEmailRecuperacao($email, $token)){
            $_SESSION['recuperar_email'] = $email;
            header("Location: trocar_senha.php");
            exit;
        } else {
            $erro = "Erro ao enviar o e-mail. Tente novamente.";
        }
    } else {
        $erro = "E-mail não encontrado no sistema.";
    }
}
?>
<?php include "header.php"; ?>

<main class="conteudo">
    <section class="painel painel-estreito">
        <h2 class="painel-titulo">Recuperar Senha</h2>
        <p class="cliente-logado" style="text-align: center; color: var(--texto-suave); margin-bottom: 20px;">Enviaremos um código de 6 dígitos para o seu e-mail.</p>

        <?php if(!empty($erro)): ?>
            <p style="color: var(--destaque); text-align: center; margin-bottom: 15px;"><?php echo $erro; ?></p>
        <?php endif; ?>

        <form action="recuperar.php" method="post" class="formulario">
            <div class="campo">
                <label for="email">E-mail Cadastrado</label>
                <input type="email" name="email" id="email" required placeholder="Digite seu e-mail">
            </div>
            <div class="acoes mt-40">
                <input type="submit" name="enviar" value="Enviar Código">
            </div>
        </form>

        <div class="painel-rodape">
            <p><a href="login.php">← Voltar para o Login</a></p>
        </div>
    </section>
</main>

<?php include "footer.php"; ?>