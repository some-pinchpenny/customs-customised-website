<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'send.one.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tanya@holdei.se';
        $mail->Password = 'Otkydach1958';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
   
        $mail->setFrom('tanya@holdei.se', 'New application from the site!');
        $mail->addAddress('tanya@holdei.se', 'Tanya Holst');

        $mail->isHTML(true);
        $mail->Subject = "New Form Submission from $name";
        $mail->Body    = "Name: $name<br>Email: $email<br><br>Message:<br>$message";

     
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>