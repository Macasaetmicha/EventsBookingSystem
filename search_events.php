<?php
    
    include 'connection.php';

    $selectedMonth = $_POST['month'];
    $selectedRoom = $_POST['room'];
    $selectedYear = $_POST['year'];
    $searchQuery = isset($_POST['search']) ? $_POST['search'] : '';

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
            FROM logcredentials lc
            JOIN user u ON lc.logID = u.logID
            JOIN eventinfo ei ON u.userID = ei.userID
            JOIN paymentinfo pi ON pi.eventID = ei.eventID
            WHERE YEAR(ei.eventDate) = '$selectedYear' AND MONTHNAME(ei.eventDate) = '$selectedMonth' AND ei.funcRoom = '$selectedRoom'";

    $result = mysqli_query($con, $query);

    $data = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $row['package'] = isset($packageNames[$row['package']]) ? $packageNames[$row['package']] : $row['package'];
        
        $row['eventDate'] = date("F d, Y", strtotime($row['eventDate']));
        $row['eventTimeStart'] = date("h:i A", strtotime($row['eventTimeStart']));
        $row['eventTimeEnd'] = date("h:i A", strtotime($row['eventTimeEnd']));
        $row['date_booked'] = date("F d, Y g:i A", strtotime($row['date_booked']));

        $hours = floor($row['overtime']); 
        $minutes = number_format(($row['overtime'] - $hours) * 60, 0);
    
        $row['overtime'] =  $hours . " hours and " . $minutes . " minutes";

        $data[] = $row;
    }

    echo json_encode($data);

    mysqli_close($con);
?>
