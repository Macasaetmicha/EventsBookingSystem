<?php
require_once('connection.php');

if (isset($_POST['package']) && isset($_POST['FRoom'])) {
    $package = $_POST['package'];
    $funcRoom = $_POST['FRoom'];
    $eventSTime = $_POST['sTime'];
    $eventETime = $_POST['eTime'];

    $baseprice=0;
    $additionalHours = 0;
    $ot_pay = 0;
    $total=0;
    $down=0;
    $full=0;

    $querry2 = "SELECT BasePrice, OTFee FROM pricinginfo WHERE Package ='$package' AND Ballroom = '$funcRoom'";

    $result2 = mysqli_query($con,$querry2);

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

    $base = number_format($baseprice, 2);
    $ot = number_format($ot_pay, 2);
    $total = number_format($total, 2);
    $down = number_format($down, 2);
    $full = number_format($full, 2);

    $hours = floor($additionalHours); 
    $minutes = number_format(($additionalHours - $hours) * 60, 0);
    
    $addhours =  $hours . " hours and " . $minutes . " minutes";


    $data = array(
        'base' => $base,
        'time' => $addhours,
        'ot' => $ot,
        'total' => $total,
        'down' => $down,
        'full' => $full,
    );

    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    echo json_encode(['error' => 'Missing POST data']);
}
?>