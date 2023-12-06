<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $keyword = mysqli_real_escape_string($con, $_POST["keyword"]);

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

    $query = "SELECT lc.logID, lc.email, u.fname, u.lname, u.contNum, ei.userID, ei.eventID, ei.funcRoom, ei.package, ei.eventType, ei.numAttendee, ei.eventDate, ei.eventTimeStart, ei.eventTimeEnd, ei.overtime, ei.request, ei.date_booked, pi.paymentStatus
            FROM user u 
            JOIN eventinfo ei ON u.userID = ei.userID
            JOIN  logcredentials lc ON lc.logID = u.logID
            JOIN paymentinfo pi ON pi.eventID = ei.eventID
            WHERE 
            LOWER(u.fname) LIKE '%$keyword%' OR 
            LOWER(u.lname) LIKE '%$keyword%' OR 
            LOWER(u.contNum) LIKE '%$keyword%' OR 
            LOWER(ei.eventType) LIKE '%$keyword%' OR
            LOWER(lc.email) LIKE '%$keyword%' OR
            LOWER(lc.username) LIKE '%$keyword%' OR
            LOWER(pi.paymentStatus) LIKE '%$keyword%'";

    $result = mysqli_query($con, $query);

    $resultsArray = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $row['package'] = isset($packageNames[$row['package']]) ? $packageNames[$row['package']] : $row['package'];
        $row['eventDate'] = date("F d, Y", strtotime($row['eventDate']));
        $row['eventTimeStart'] = date("h:i A", strtotime($row['eventTimeStart']));
        $row['eventTimeEnd'] = date("h:i A", strtotime($row['eventTimeEnd']));
        $row['date_booked'] = date("F d, Y g:i A", strtotime($row['date_booked']));

        $hours = floor($row['overtime']); 
        $minutes = number_format(($row['overtime'] - $hours) * 60, 0);
    
        $row['overtime'] =  $hours . " hours and " . $minutes . " minutes";

        $resultsArray[] = $row;
    }

    echo json_encode($resultsArray);
} else {
    echo "Invalid request method.";
}
?>
