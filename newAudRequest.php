<?php

$room = $_POST['room'];
//echo $room ."<br>";
$date = $_POST['date'];
//echo $date."<br>";
if(date("Y-m-d") > $date){
    $result =  "<p>Нельзя бронировать аудитории на прошедшую дату.</p>";
    echo $result;
    exit();
}
$lesson = $_POST['lesson'];
//echo $lesson."<br>";
$email = $_POST['email'];
//echo $email."<br>";
$faculty = $_POST['faculty'];
//echo $faculty."<br>";
$prepname = $_POST['prepname'];
//echo $prepname."<br>";
$aim = $_POST['aim'];
//echo $aim."<br>";
include 'lib/connection.php';
if (!empty($room) && !empty($date) && !empty($lesson) && !empty($email) && !empty($faculty) && !empty($prepname) && !empty($aim)) {
    $query = mysqli_query($con, "SELECT Name FROM `acc_management` WHERE email='" . mysqli_real_escape_string($con, $email) . "'");
    $data = mysqli_fetch_assoc($query);
    $askerName = $data['Name'];
    mysqli_query($con, "INSERT INTO `booking` "
            . "(`#`, `Room`, `Date`, `Lesson`, `Email`, `AskerName`, `Faculty`, `PrepName`, `Aim`, `Status`) "
            . "VALUES (NULL, '" . $room . "', '" . $date . "', '" . $lesson . "', '" . $email . "', '" . $askerName . "', '" . $faculty . "', '" . $prepname . "', '" . $aim . "', '1');");
    echo "1";
} else {
    $result =  "<p>Необходимо заполнить все поля</p>";
    echo $result; 
}
