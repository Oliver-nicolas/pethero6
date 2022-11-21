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

    public function sendMail($reserve,$owner){

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.outlook.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'petheromdq@outlook.com';                     //SMTP username
            $mail->Password   = 'Nicomarco2022';                               //SMTP password
            $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
            //7R299-HCQM9-GC5AX-5YPH2-FJBQW 

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

//************************************************codigo de dolo */
if(!empty($personalEmail) && $register==true){
    $message = "Succesful registration and email sent to " . "<br>" . $personalEmail;
    $this->viewController->Home($message);

    $this->StudentDAO->generateEmail($personalEmail, $student);
}
Dolo Bruzzone18:56
public function generateEmail($emailInfo, $student){

    if(!empty($emailInfo)){
        
        $mail = new Mail();
        $mail->sendMail($emailInfo,$student); 
    }
}
esto yo lo tengo en studentDAO
Dolo Bruzzone19:03
public function GetJobOfferXid($idJobOffer){

    $query = " SELECT * FROM joboffer WHERE id_JobOffer = (:idJobOffer)"; //company WHERE id_Company = :idCompany";

    $parameters['idJobOffer'] = $idJobOffer;

    try {
        $result = $this->connection->Execute($query, $parameters);

    } catch (Exception $ex) {
        throw $ex;
    }

    $jobOffer = null;

    if(!empty($result)){
Dolo Bruzzone19:06
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Models\Student as Student;


require './Vendor/PHPMailer/Exception.php';
require './Vendor/PHPMailer/PHPMailer.php';
require './Vendor/PHPMailer/SMTP.php';

class Mail
{

public function sendMail($email,$student)
{

$mail = new PHPMailer(true);

try {
        //Server settings
    // $mail->SMTPDebug =0;                      // Enable verbose debug o