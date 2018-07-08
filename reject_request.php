<?php
$id = $_POST['id'];

include 'lib/connection.php';

$query = mysqli_query($con, "UPDATE `booking` SET `Status`='0' WHERE `booking`.`#`=" . mysqli_real_escape_string($con, $id) . "");

if (!$query) {
    $result = "<p>Что-то пошло не так.</p>";
    echo $result . "<br>";
    echo mysqli_error($con);
} else {
    echo "1";
}
