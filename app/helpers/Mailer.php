<?php

use PHPMailer\PHPMailer\PHPMailer;

class Mailer
{
    public function send($address, $body)
    {

        try {
            $mail = new PHPMailer;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->CharSet = 'UTF-8';
            // $mail->SMTPDebug  = 1;
            $mail->IsSMTP(); // SMTP-n keresztüli küldés
            $mail->SMTPAuth = false;

            $mail->Host = "owa.rufusz.hu";

            $mail->setFrom("regisztracio@zold22.hu", "Budafok-Tétényért Városfejlesztő Kft.");
            $mail->addAddress($address, $address);     //Add a recipient
            $mail->addReplyTo("regisztracio@zold22.hu", "Budafok-Tétényért Városfejlesztő Kft.");

            //Content
            $mail->isHTML(true); //Set email format to HTML

            $mail->Subject = 'Regisztráció megerősítése!';
            $mail->Body = $body;
            $mail->AltBody = strip_tags($body);

            $mail->Send();
        } catch (Exception $e) {
            var_dump($e);
            return false;
        }
    }
}