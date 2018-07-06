<?php
$q = intval($_GET['q']);
$d = $_GET['d'];
?>

<?php
include 'lib/connection.php';

$query = mysqli_query($con, "SELECT * FROM `rooms`  WHERE `Состояние`='1' AND `Корпус`='А'");
$roomsA = mysqli_fetch_all($query, MYSQLI_ASSOC);
$query = mysqli_query($con, "SELECT * FROM `rooms`  WHERE `Состояние`='1' AND `Корпус`='Б'");
$roomsB = mysqli_fetch_all($query, MYSQLI_ASSOC);
$query = mysqli_query($con, "SELECT * FROM `rooms`  WHERE `Состояние`='1' AND `Корпус`='В'");
$roomsC = mysqli_fetch_all($query, MYSQLI_ASSOC);

$query = mysqli_query($con, "SELECT * FROM `booking` WHERE `Дата`='" . $d . "' AND `№ пары`='" . $q . "'");
$booking = mysqli_fetch_all($query, MYSQLI_ASSOC);
?>
<p style="color: blue"><big>Корпус А</big></p>
<form>
    <?php foreach ($roomsA as $room) { ?>
    
        <a href="#block" class="<?php
        $key = array_search($room["Номер"], array_column($booking, '№ аудитории'));

        if (!isset($key) || $key === false) {
            print "color1";
        } else if ($booking[$key]["Статус"] == 1) {
            print "color2";
        } else if ($booking[$key]["Статус"] == 2) {
            print "color3";
        }
        ?>" onclick="setcoord(event)"><p><?php print $room["Номер"]; ?></p>
            <p><?php print $room["Количество мест"]; ?></p> </a> 
   <?php } ?>
</form>
<p style="color: blue"><big>Корпус Б</big>
</p>
<form>
    <?php foreach ($roomsB as $room) { ?>
    
        <a href="#block" class="<?php
        $key = array_search($room["Номер"], array_column($booking, '№ аудитории'));

        if (!isset($key) || $key === false) {
            print "color1";
        } else if ($booking[$key]["Статус"] == 1) {
            print "color2";
        } else if ($booking[$key]["Статус"] == 2) {
            print "color3";
        }
        ?>" onclick="setcoord(event)"><p><?php print $room["Номер"]; ?></p>
            <p><?php print $room["Количество мест"]; ?></p> </a> 
   <?php } ?>
</form>
<p style="color: blue"><big>Корпус В</big>
</p>
<form>
    <?php foreach ($roomsC as $room) { ?>
    
        <a href="#block" class="<?php
        $key = array_search($room["Номер"], array_column($booking, '№ аудитории'));

        if (!isset($key) || $key === false) {
            print "color1";
        } else if ($booking[$key]["Статус"] == 1) {
            print "color2";
        } else if ($booking[$key]["Статус"] == 2) {
            print "color3";
        }
        ?>" onclick="setcoord(event)"><p><?php print $room["Номер"]; ?></p>
            <p><?php print $room["Количество мест"]; ?></p> </a> 
   <?php } ?>
</form>
