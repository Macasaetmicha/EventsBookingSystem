<?php
session_start();
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['submit'])) {
    $refNumber = $_POST['refNum'];
    $cardNum = $_POST['cardNum'];
    $cvv = $_POST['cvv'];
    $expDate = $_POST['expDate'];
    $receiptNum = $_POST['receiptNum'];

    $userEmail = $_SESSION['userEmail'];
    
    $eventID = $_SESSION['eventID'];

    echo "Email: " . $userEmail . "<br>";
    echo "ID: " . $eventID . "<br>";

    $type = $_POST['payType'];

    $sql1 = "UPDATE paymentinfo
            SET paymentStatus = 'paid'
            WHERE eventID = $eventID";
    $result1= mysqli_query($con, $sql1);

    $sql2 = "SELECT paymentID FROM paymentinfo
            WHERE eventID = $eventID";
        $result2 = mysqli_query($con, $sql2);

        if ($result2) {
            $row = mysqli_fetch_assoc($result2);
            $paymentID = $row['paymentID'];

            echo "PaymentID: " . $paymentID . "<br>";
        } else {
            echo "Error: " . mysqli_error($con);
        }

    echo "type: " . $type . "<br>";
    echo "refNum: " . $refNumber . "<br>";
    echo "cardNum: " . $cardNum . "<br>";
    echo "cvv: " . $cvv . "<br>";
    echo "expdate: " . $expDate . "<br>";
    echo "recieptNum: " . $receiptNum . "<br>";

    $sql4 = "UPDATE paymentinfo
            SET fullPaymentType = '$type', balance = 0
            WHERE paymentID = '$paymentID'";
    mysqli_query($con, $sql4);

    if ($type === "gcash" || $type === "maya") {
        $sql5 = "INSERT INTO onlineinfo (paymentID, referenceNum, payment_purpose) VALUES ('$paymentID','$refNumber', 'fp')";
        mysqli_query($con, $sql5);
    } else if ($type  === "pA" || $type  === "pB") {
        $sql6 = "INSERT INTO cardinfo (paymentID, cardNum, cvv, expDate, payment_purpose) VALUES ('$paymentID','$cardNum','$cvv','$expDate', 'fp')";
        mysqli_query($con, $sql6);
    } else if ($type  === "cash") {
        $sql6 = "INSERT INTO cashinfo (paymentID, receiptNum, receiptImg, payment_purpose) VALUES ('$paymentID','$receiptNum','$receiptImg', 'fp')";
        mysqli_query($con, $sql6);
    }

    $querry3 = "SELECT username FROM logcredentials WHERE email = '$userEmail';";

    $result3 = mysqli_query($con,$querry3);

    if ($result3->num_rows > 0) {
        $row = $result3->fetch_assoc();
        $username = $row["username"];
    } 

    $querry4 = "SELECT eventType, eventDate FROM eventinfo WHERE eventID = '$eventID';";

    $result4 = mysqli_query($con,$querry4);

    if ($result4->num_rows > 0) {
        $row = $result4->fetch_assoc();
        $eventName = $row["eventType"];
        $eventDate = $row["eventDate"];
    } 

    $querry5 = "SELECT total_bill - downpayment AS balance FROM paymentinfo WHERE eventID ='$eventID'";

    $result5 = mysqli_query($con,$querry5);

    if ($result5->num_rows > 0) {
        $row = $result5->fetch_assoc();
        $bal = $row["balance"];
    } 

    $date=date_create($eventDate);
    $payDate=date_format($date,"F j, Y");

    $balance = number_format($bal, 2);

    echo "email: " . $userEmail . "<br>";
    echo "name: " . $username . "<br>";
    echo "event: " . $eventName . "<br>";
    echo "date: " . $payDate . "<br>";
    echo "amount : " . $balance . "<br>";

    try {
        $mail = new PHPMailer(true);

        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'micasa.cosc75g2@gmail.com'; 
        $mail->Password = 'wtuegngmimozidgg'; 
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('micasa.cosc75g2@gmail.com', 'MiCasa');
        $mail->addAddress($userEmail, $username);

        $mail->isHTML(true);
        $mail->Subject = "Payment Received for $eventName";
        
        $emailContent = "
        <html>
        <body>
        
        <p>Dear $username,</p>
        <p>I hope this message finds you well. We would like to express our gratitude for your 
        prompt payment for the upcoming event '$eventName.' 
        We have received your payment, and your transaction has been successfully processed.</p>

        <p>Payment Details:<br>

        Event Name: $eventName<br>
        Payment Amount: Php $balance<br>
        Payment Date: $payDate</p>

        <p>Your continued support is vital to the success of our events, 
        and we look forward to delivering more outstanding experiences for you and your guests.</p>

        <p>Your trust in us is greatly appreciated, and we look forward to working with you again to create a memorable event. 
        If you have any questions or need further assistance, please feel free to contact our team at 09123456789.</p>

        <p>Thank you once again for choosing MiCasa Events.</p>

        <p>Warm regards,<br>Mica<br>MiCasa Events</p>
        </body>
        </html>
        ";

        $mail->Body = $emailContent;

            $mail->send();

            echo 'Message sent!';
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }

        mysqli_close($con);

        $successMessage = "Payment was successful!";

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

        header('Location: Archive.php?message=' . urlencode($successMessage));
        exit;

    }
?>