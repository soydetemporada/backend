<?php
namespace Handlers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHandler {

  function post(){
    global $CONFIG;

    $name = $_POST['name'];
    $email = $_POST['_replyto'];
    $message = $_POST['message'];
    if(!empty($name) && !empty($email) && !empty($message)){
      $subject = "[Soy de Temporada] Hemos recibido un nuevo comentario de $name";
      //TODO pasar esto a una plantilla
      $body = "Hola,\n$name [$email] nos ha dejado el siguiente mensaje:\n\n$message\n\n No olvidemos responderle pronto ;-)";
      $mail = new PHPMailer(true);
      try{
        //Recipients
        $mail->setFrom('contacto@soydetemporada.es', '[Soy de Temporada]');
        $mail->addAddress($CONFIG->contact_email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        error_log("{$CONFIG->contact_email} $subject $body");
        $mail->send();
        header("Location: {$CONFIG->contact_form}#success");
      }
      catch(Exception $e){
        header("Location: {$CONFIG->contact_form}#error");
        error_log('Message could not be sent.');
        error_log('Mailer Error: ' . $mail->ErrorInfo);
      }
    }
  }
}
