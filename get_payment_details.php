<?php
session_start(); 

include 'connection.php';

if (isset($_POST['eventId'])) {
    $eventId = $_POST['eventId'];
    $_SESSION['eventID'] = $eventId;

    $query = "SELECT ei.eventID, ei.eventType, ei.date_booked, ei.eventDate, pi.paymentStatus, pi.total_bill, pi.downpayment, pi.balance
            FROM paymentinfo pi 
            JOIN eventinfo ei ON pi.eventID = ei.eventID
            WHERE ei.eventID = '$eventId'";

    $result = mysqli_query($con, $query);

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $row['balance'] = $row['total_bill'] - $row['downpayment'];
        $data[] = $row;
    }

    echo json_encode($data);

    $query2 = "SELECT lc.email
            FROM logcredentials lc
            JOIN user u ON lc.logID = u.logID
            JOIN eventinfo ei ON ei.userID = u.userID
            WHERE ei.eventID = '$eventId'";
    $userEmail = mysqli_query($con, $query2);

    $emailRow = mysqli_fetch_assoc($userEmail);
    $_SESSION['userEmail'] = $emailRow['email'];

    
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'EventID not specified.']);
}

mysqli_close($con);
?>
