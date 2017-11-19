<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailHandler {

  function post(){
    $to = 'equipo@soydetemporada.es';
    $to = 'lowfill@gmail.com';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    if(!empty($name) && !empty($email) && !empty($message)){
      $subject = "[Soy de Temporada] Hemos recibido un nuevo comentario de $name";
      //TODO pasar esto a una plantilla
      $body = "Hola,\n$name [$email] nos ha dejado el siguiente mensaje:\n\n$message\n\n No olvidemos responderle pronto ;-)";
      $mail = new PHPMailer(true);
      try{
        //Recipients
        $mail->setFrom('contacto@soydetemporada.es', '[Soy de Temporada]');
        $mail->addAddress($to);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = $body;

        $mail->send();
      }
      catch(Exception $e){
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      }
    }
  }
}
