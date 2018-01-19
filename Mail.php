

<?php
/*
*To the future maintainer of the code.
*I've spent 18 hours to make this code work.
*I've badly commented every line, because if it's hard to write, it should be hard to understand.
*If you wish to change receiving address, Make Sure to make a fresh GMAIL Account. 
*Outlook Accounts without 2FA haven't been tested yet.
*Outlook 365 Give Authentication Error without 2FA
*Outlook Account with 2FA gives Mail body too long Exception, you can try to avoid that by using trim_input() function on PHPMailer code
*Increase the counter with the number of hours you've spent while coding / maintaining / reviewing
*Counter : 18 Hours
*/

    require 'PHPMailer/PHPMailerAutoload.php';
    $yourName = $_POST['yourName'];
    $sender  = $_POST['emailID'];
    $subject  = $_POST['subject'];
    $message  = $_POST['message'];
    $to = 'library@nuv.ac.in';

    header('Refresh: 5; URL=http://karanke.net/lin/contactus.php');

    $mail = new PHPMailer;

    //$mail->SMTPDebug = 2;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'nuvlibraryreplies@gmail.com';                 // SMTP username
    $mail->Password = '*******';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($sender,$yourName);
    $mail->addAddress($to);     // Add a recipient
    $mail->addReplyTo($sender);

    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $subject;
    $mail->Body    = "<b>From: </b>". $sender. "<br>" ." <b>Name: </b>". $yourName. "<br>". "<b> Message Body </b>" .$message;
    $mail->AltBody = "<b>From: </b>". $sender. "<br>" ." <b>Name: </b>". $yourName. "<br>". "<b> Message Body </b>" .$message;

        if(!$mail->send()) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } 
        else {
            echo "Message has been sent....You're being redirected.....";
            }

?> 