<?php
session_start();
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['inquire'])){
    try{
        $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $mail = new PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'micasa.cosc75g2@gmail.com'; 
    $mail->Password = 'wtuegngmimozidgg'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress('micasa.cosc75g2@gmail.com');
    $mail->Subject = $subject;

    $emailContent = "
    <html>
    <body>
    Name: $name <br>
    Email: $email <br>
    Message: $message <br>
    </body>
    </html>
    ";

    $mail->Body = $emailContent;

    $mail->send();
    echo 'Message sent!';
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
    
    $successMessage = "We have recieved your query. Rest assured we will get back to you shortly!";

    
    echo "<script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            html: '" . $successMessage . "',
            customClass: {
                popup: 'custom-swal-popup', /* Custom class for the entire popup */
                title: 'custom-swal-title', /* Custom class for the title */
                htmlContainer: 'custom-swal-message' /* Custom class for the message */
            }
        });
    </script>";

    header('Location: About.php?message=' . urlencode($successMessage));
    exit;
    
}
?>