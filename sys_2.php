<?php
$q = intval($_GET['q']);
$d = $_GET['d'];
/*

  $q = "1";
  $d = "2018-07-08"; */
include 'lib/connection.php';

$query = mysqli_query($con, "SELECT * FROM `rooms`  WHERE `Status`='1' AND `Building`='А'");
$roomsA = mysqli_fetch_all($query, MYSQLI_ASSOC);
$query = mysqli_query($con, "SELECT * FROM `rooms`  WHERE `Status`='1' AND `Building`='Б'");
$roomsB = mysqli_fetch_all($query, MYSQLI_ASSOC);
$query = mysqli_query($con, "SELECT * FROM `rooms`  WHERE `Status`='1' AND `Building`='В'");
$roomsC = mysqli_fetch_all($query, MYSQLI_ASSOC);

/* $query = mysqli_query($con, "SELECT * FROM `booking` WHERE `Date`='" . $d . "' AND `Lesson`='" . $q . "'");
  $booking = mysqli_fetch_all($query, MYSQLI_ASSOC); */
$query = mysqli_query($con, "SELECT * FROM (SELECT * FROM `booking` WHERE `Date`='" . $d . "' AND `Lesson`='" . $q . "' GROUP BY CONCAT(`Room`, '-',`Status`) ORDER BY `Status` DESC) AS T GROUP BY `Room`");
$booking = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>

<p style="color: blue"><big>Корпус А</big></p>
<form>
    <?php
    foreach ($roomsA as $room) {
        $key = array_search($room["Room"], array_column($booking, 'Room'));
        if (!isset($key) || $key === false || $booking[$key]["Status"] == 0) {
            print "<a href=\"#block1\" class=\"color1\" onclick=\"generateform('" . $q . "','" . $d . "','" . $room["Room"] . "')\">";
        } else if ($booking[$key]["Status"] == 1) {
            print "<a href=\"#block2\" class=\"color2\" onclick=\"request_table('" . $q . "','" . $d . "','" . $room["Room"] . "')\">";
        } else if ($booking[$key]["Status"] == 2) {
            print "<a href=\"#block3\" class=\"color3\">";
        }
        ?><p><?php print $room["Room"]; ?></p>
        <p><?php print $room["Capacity"]; ?></p> </a> 
<?php } ?>
</form>
<p style="color: blue"><big>Корпус Б</big>
</p>
<form>
    <?php
    foreach ($roomsB as $room) {
        $key = array_search($room["Room"], array_column($booking, 'Room'));
        if (!isset($key) || $key === false || $booking[$key]["Status"] == 0) {
            print "<a href=\"#block1\" class=\"color1\" onclick=\"generateform('" . $q . "','" . $d . "','" . $room["Room"] . "')\">";
        } else if ($booking[$key]["Status"] == 1) {
            print "<a href=\"#block2\" class=\"color2\" onclick=\"request_table('" . $q . "','" . $d . "','" . $room["Room"] . "')\">";
        } else if ($booking[$key]["Status"] == 2) {
            print "<a href=\"#block3\" class=\"color3\">";
        }
        ?><p><?php print $room["Room"]; ?></p>
        <p><?php print $room["Capacity"]; ?></p> </a> 
<?php } ?>
</form>
<p style="color: blue"><big>Корпус В</big>
</p>
<form>
    <?php
    foreach ($roomsC as $room) {
        $key = array_search($room["Room"], array_column($booking, 'Room'));
        if (!isset($key) || $key === false || $booking[$key]["Status"] == 0) {
            print "<a href=\"#block1\" class=\"color1\" onclick=\"generateform('" . $q . "','" . $d . "','" . $room["Room"] . "')\">";
        } else if ($booking[$key]["Status"] == 1) {
            print "<a href=\"#block2\" class=\"color2\" onclick=\"request_table('" . $q . "','" . $d . "','" . $room["Room"] . "')\">";
        } else if ($booking[$key]["Status"] == 2) {
            print "<a href=\"#block3\" class=\"color3\">";
        }
        ?><p><?php print $room["Room"]; ?></p>
        <p><?php print $room["Capacity"]; ?></p> </a> 
<?php } ?>
</form>
