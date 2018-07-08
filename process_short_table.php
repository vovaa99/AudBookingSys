<?php

$id = $_POST['id'];
$status = $_POST['status'];
include 'lib/connection.php';

$query = mysqli_query($con, "UPDATE `booking` SET `Status` = '" . $status . "' WHERE `booking`.`#` = " . $id . ";");
/*$bookings = mysqli_fetch_all($query, MYSQLI_ASSOC);
foreach ($bookings as $booking) {

    echo $booking . PHP_EOL;
}

*/