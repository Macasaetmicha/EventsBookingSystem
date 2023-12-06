<?php
include 'connection.php';

if (isset($_POST['year'])) {
    $selectedYear = $_POST['year'];

    $query = "SELECT DISTINCT MONTHNAME(eventDate) AS month FROM eventinfo WHERE YEAR(eventDate) = '$selectedYear'";
    $result = mysqli_query($con, $query);

    $bookedMonths = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $bookedMonths[] = $row['month'];
    }

    echo json_encode($bookedMonths);
} else {
    echo json_encode(array("error" => "Year not provided"));
}
?>
