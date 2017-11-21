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
      $mail = new PHPMailer(true);
      try{
        //Recipients
        $mail->setFrom('contacto@soydetemporada.es', '[Soy de Temporada]');
        $mail->addAddress($CONFIG->contact_email);

        //Content
        $m = new \Mustache_Engine;
        $body = $m->render(get_template('contact'), array(
          'name' => $name,
          'email'=>$email,
          'message'=>$message,
          'subject'=>$subject,
          'base_url'=>$CONFIG->base_url
          )
        );
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

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
