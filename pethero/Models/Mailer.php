<?php
 namespace Models;

use PhpMailer\phpMailer\PHPMailer;
use PhpMailer\phpMailer\SMTP;
use PhpMailer\phpMailer\Exception;
use Models\Owner as Owner;
use Models\Reserve as Reserve;

require_once(VIEWS_PATH . "phpmailer/Exception.php");
require_once(VIEWS_PATH . "phpmailer/PHPMailer.php");
require_once(VIEWS_PATH . "phpmailer/SMTP.php");

class Mailer {

    public function sendMail($reserve){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        $owner = $reserve->getOwner();

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.outlook.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   =// 'petheromdq@outlook.com';                     //SMTP username
            $mail->Password   =// 'Pethero2022';                               //SMTP password
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //MYF4J-VU9G5-4CMJB-E67CM-HRAQL

            //Recipients
            $mail->setFrom('petheromdq@outlook.com', 'Pet Hero');
            if ($owner !== false){ 
            $mail->addAddress($owner->getEmail(), 'Owner');  
            }
            //Content
            $mail->isHTML(true);   //Set email format to HTML
            $i=1;                               
            $mail->Subject = 'Reserve confirmation Pet Hero';
            $body = "Invoice payment" . $owner->getName() . " " . $owner->getLastName() . " your email is the web side is: " . $owner->getEmail();
            $mail->Body = $body; 
            $mail->send();

            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}