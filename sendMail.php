<?php
//Upgrading to PHP Mailer 6.x.x
if(isset($_POST['submit'])){
    $senderEmail = $_POST['email'];
    $emailMessage = $_POST['emailMessage'];
    echo $emailMessage;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);
try{
    $mail->SMTPDebug = 2;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'mr.karanke@gmail.com';
    $mail->Password = '********';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    
}
catch(Exception $e){

}

?>