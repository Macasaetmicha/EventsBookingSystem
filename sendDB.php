<?php
session_start();
include 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if(isset($_POST['submit'])) {
    $package = $_POST['package'];
    $funcRoom = $_POST['FRoom'];
    $eventName = $_POST['event'];
    $guestNum = $_POST['number'];
    $noFormateventDate = $_POST['dateEvent'];
    $eventDate = date('Y-m-d', strtotime($noFormateventDate));
    $eventSTime = $_POST['sTime'];
    $eventETime = $_POST['eTime'];
    $request = $_POST['reqs'];

    $refNumber = $_POST['refNum'];
    $cardNum = $_POST['cardNum'];
    $cvv = $_POST['cvv'];
    $expDate = $_POST['expDate'];

    $contNum = $_POST['contNum'];

    $userEmail = $_SESSION['email'];

    $querry1 = "SELECT u.userID FROM user u
    INNER JOIN logCredentials lc ON u.logID = lc.logID
    WHERE lc.email = '$userEmail'";

    $result1 = mysqli_query($con,$querry1);

    if ($result1->num_rows > 0) {
        $row = $result1->fetch_assoc();
        $userID = $row["userID"];
    } 

    echo "Package: " . $package . "<br>";
    echo "Function Room: " . $funcRoom . "<br>";
    echo "Event Name: " . $eventName . "<br>";
    echo "Guest Num: " . $guestNum . "<br>";
    echo "Event Date: " . $eventDate . "<br>";
    echo "Start Time: " . $eventSTime . "<br>";
    echo "End Time: " . $eventETime . "<br>";
    echo "request: " . $request . "<br>";
    echo "Contact Number: " . $contNum . "<br>";

    $querry2 = "SELECT BasePrice, OTFee FROM pricinginfo WHERE Package ='$package' AND Ballroom = '$funcRoom'";

    $result2 = mysqli_query($con,$querry2);

    $baseprice=0;
    $ot_pay = 0;

    $total=0;
    $down=0;
    $full=0;

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $otFee = $row["OTFee"];
        $baseprice = $row["BasePrice"];
        

        $startDateTime = new DateTime($eventSTime);
        $endDateTime = new DateTime($eventETime);

        $interval = $startDateTime->diff($endDateTime);

        $totalHours = $interval->h + ($interval->i / 60); 

        if ($totalHours > 4) {
            $additionalHours = $totalHours - 4;
            $ot_pay = $additionalHours * $otFee;
        }

        $total = $baseprice + $ot_pay;

        $percentage = 0.3; 
        $down = $percentage * $total;

        $full = $total - $down;
    } 

    
    $sql2 = "INSERT INTO eventinfo (userID, package, funcRoom, eventType, numAttendee, eventDate, eventTimeStart, eventTimeEnd, overTime, request) 
            VALUES ('$userID', '$package', '$funcRoom', '$eventName','$guestNum', '$eventDate', '$eventSTime', '$eventETime', '$additionalHours','$request')";
    mysqli_query($con, $sql2);

    $eventID = mysqli_insert_id($con);

    if (isset($_POST["contactChoice"]) && $_POST["contactChoice"] === "yes") {
        $sql6 = "UPDATE user
        SET contNum = '$contNum'
        WHERE userID = $userID";
        mysqli_query($con, $sql6);
    } else{

    }

    $type = $_POST['payType'];

    $sql4 = "INSERT INTO paymentinfo (eventID, total_bill, downpayment, paymentType, balance, paymentStatus) 
            VALUES ('$eventID', '$total', '$down', '$type','$full', 'not paid')";
    mysqli_query($con, $sql4);

    $paymentID = mysqli_insert_id($con);

    echo "type: " . $type . "<br>";
    echo "refNum: " . $refNumber . "<br>";
    echo "cardNum: " . $cardNum . "<br>";
    echo "cvv: " . $cvv . "<br>";
    echo "expdate: " . $expDate . "<br>";

    if ($type === "gcash" || $type === "maya") {
        $sql5 = "INSERT INTO onlineinfo (paymentID, referenceNum) VALUES ('$paymentID','$refNumber')";
        mysqli_query($con, $sql5);
    } else if ($type  === "pA" || $type  === "pB") {
        $sql6 = "INSERT INTO cardinfo (paymentID, cardNum, cvv, expDate) VALUES ('$paymentID','$cardNum','$cvv','$expDate')";
        mysqli_query($con, $sql6);
    }

    $querry3 = "SELECT username FROM logcredentials WHERE email = '$userEmail';";

    $result3 = mysqli_query($con,$querry3);

    if ($result3->num_rows > 0) {
        $row = $result3->fetch_assoc();
        $username = $row["username"];
    } 

    echo "email: " . $userEmail . "<br>";
    echo "name: " . $username . "<br>";

    $packageNames = array(
        "ip" => "Intimate Package",
        "cp" => "Classic Package",
        "dp" => "Deluxe Package",
        "kp" => "Kiddie Package",
        "dep" => "Debut Package",
        "bp" => "Basic Package",
        "pA" => "Package A",
        "pB" => "Package B",
        "frm" => "Function Room",
    );

    $funcNames = array(
        "sb" => "Silver Ballroom",
        "gb" => "Golden Ballroom",
        "pb" => "Platinum Ballroom",
        "db" => "Diamond Ballroom",
        
    );

    $packageAvail = $packageNames[$package];
    $funcAvail = $funcNames[$funcRoom];

    $fbase = number_format($baseprice, 2);
    $fot = number_format($ot_pay, 2);
    $ftotal = number_format($total, 2);
    $fdown = number_format($down, 2);
    $ffull = number_format($full, 2);

    $date=date_create($eventDate);
    $fdate=date_format($date,"F j, Y");

    $time1=date_create($eventSTime);
    $time2=date_create($eventETime);

    $ftime1=date_format($time1, "g:i A");
    $ftime2=date_format($time2, "g:i A");

    $hours = floor($additionalHours); 
    $minutes = number_format(($additionalHours - $hours) * 60, 0);
    
    $addhours =  $hours . " hours and " . $minutes . " minutes";

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
        $mail->Subject = 'Booking Details';
        
        $emailContent = "
        <html>
        <body>
        
        <p>Dear $username,</p>
        <p>We hope this email finds you well. We wanted to take a moment to express our sincere gratitude for choosing MiCasa Events for your upcoming special day. 
        It is our pleasure to assist you in making this day a memorable and stress-free experience.</p>

        <p>Here are the details of your booking:</p>

        <strong>Event Information:</strong>
        <ul>
            <li>Event Name: $eventName</li>
            <li>Event Date: $eventDate</li>
            <li>Start Time: $ftime1</li>
            <li>End Time: $ftime2</li>
            <li>Overtime Hours: $addhours</li>
            <li>Number of Guests: $guestNum</li>
        </ul>

        <strong>Package & Function Room:</strong>
        <ul>
            <li>Package Selected: $packageAvail</li>
            <li>Function Room: $funcAvail</li>
        </ul>

        <strong>Payment Details:</strong>
        <ul>
            <li>Base Pay: Php $fbase</li>
            <li>Overtime Pay: Php $fot</li>
            <li>Total Amount: Php $ftotal</li>
            <li>Downpayment (30%): Php $fdown</li>
            <li>Amount to be Paid on the Day of the Event: Php $ffull</li>
        </ul>

        <p>If you have any special requests or additional information you'd like to share with us, please don't hesitate to let us know. 
        We are committed to ensuring that your event is tailored to your preferences and meets your expectations.</p>

        <p>Your trust in us is greatly appreciated, and we look forward to working with you to create a memorable event. 
        If you have any questions or need further assistance, please feel free to contact our team at 09123456789.</p>

        <p>Thank you once again for choosing MiCasa Events. We can't wait to make your event extraordinary!</p>

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

        $successMessage = "Booking was successful! Thank you for choosing us. 
        \n\n An email was sent to you with Event details. Mark your Calendar!";

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

        header('Location: home.php?message=' . urlencode($successMessage));
        exit;

}
?>