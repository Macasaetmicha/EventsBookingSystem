<?php
session_start();
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$email = $_POST['email'];

$query = "SELECT username FROM logcredentials WHERE email = '$email';";

$result = mysqli_query($con,$query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $username = $row["username"];
} 

if ($result) {
    $row = mysqli_fetch_assoc($result);

    $token = bin2hex(random_bytes(16));
    $token_hash = hash("sha256", $token);
    date_default_timezone_set('Asia/Manila');
    $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

    $sql = "UPDATE logcredentials SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sss", $token_hash, $expiry, $email);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $mail = new PHPMailer(true);

        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->isSMTP();
        $mail->SMTPAuth = true;

        $mail->Host = "smtp.gmail.com";
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->Username = "micasa.cosc75g2@gmail.com";
        $mail->Password = "wtuegngmimozidgg";

        $mail->isHtml(true);

        $mail->setFrom('micasa.cosc75g2@gmail.com', 'MiCasa');
        $mail->addAddress($email, $username); 
        $mail->Subject = "Password Change Request Confirmation";

        $emailContent = "
        <html>
        <body>
        
        <p>Dear $username,</p>
        <p>We have received a request to change the password associated with your account. 
        To ensure the security of your account, we require your confirmation before proceeding with this change.</p>

        <p>If you initiated this request, please click <a href='http://localhost/COSC75Project/reset-password.php?token=$token'>here</a> to confirm the password change.</p>

        <p>If you did not request a password change or believe this request was made in error, please ignore this email. 
        Your current password will remain unchanged, and your account will continue to be secure.</p>

        <p>Thank you for your prompt attention to this matter. If you have any questions or concerns, 
        please do not hesitate to contact our support team at micasa.cosc75g2@gmail.com or 09123456789.</p>

        <p>Warm regards,<br>Mica<br>MiCasa Events</p>
        </body>
        </html>
        ";

        $mail->Body = $emailContent;

        try {
            $mail->send();
            $_SESSION['successMessage'] = "Message sent. Please check your email.";
        } catch (Exception $e) {
            $_SESSION['errorMessage'] = "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['errorMessage'] = "Email not found.";
    }

    $stmt->close();
} else {
    $_SESSION['errorMessage'] = "Failed to fetch user information from the database.";
}

mysqli_close($con);

header("Location: fpass.php"); 
exit();

?>
