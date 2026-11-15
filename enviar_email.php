<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function enviarEmailRecuperacao($destinatario, $token) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do SMTP do Gmail
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lojaalpha.recuperacao@gmail.com'; 
        $mail->Password   = ''; // LEMBRAR DE ADICIONAR A SENHA NESSE CARAI
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // TLS
        $mail->Port       = 587;
        $mail->CharSet    = 'UTF-8';

        // Remetente e Destinatário
        $mail->setFrom('lojaalpha.recuperacao@gmail.com', 'Loja Alpha');
        $mail->addAddress($destinatario);

        // Conteúdo
        $mail->isHTML(true);
        $mail->Subject = 'Recuperacao de Senha - Loja Alpha';
        $mail->Body    = "Ola!<br><br>Seu codigo de recuperacao e: <b>$token</b><br><br>Insira este codigo no site para criar uma nova senha.";
        $mail->AltBody = "Ola! Seu codigo de recuperacao e: $token";

        $mail->send();
        return true;
    } catch (Exception $e) {
        file_put_contents('erro_email.log', date('Y-m-d H:i:s') . ' - Erro: ' . $mail->ErrorInfo . "\n", FILE_APPEND);
        return false;
    }
}
?>