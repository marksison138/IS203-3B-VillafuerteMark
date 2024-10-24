<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if(isset($_POST["send"])){
    $mail = new PHPMailer(true);

    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'villafuertemark60@gmail.com';                    
    $mail->Password   = 'ljdy lmvw ohss wglj';                      
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;    
    
    $mail->setFrom('villafuertemark60@gmail.com');
    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);    
    $mail->Subject = $_POST["subject"];
    $mail->Body    = $_POST["message"];

    try {
        $mail->send();
        echo "<script>alert('Sent Successfully');
        document.location.href = 'email.php';
        </script>";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


?>