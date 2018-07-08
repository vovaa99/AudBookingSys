<?php
$room = $_POST['room'];
$date = $_POST['date'];
$lesson = $_POST['lesson'];
include 'lib/connection.php';

$query = mysqli_query($con, "SELECT * FROM `booking`  WHERE `Date`='" . $date . "' AND `Lesson`='" . $lesson . "' AND `Room`='" . $room . "'  AND `Status` != '0'");
$bookings = mysqli_fetch_all($query, MYSQLI_ASSOC);

print "<p>Заявки на аудиторию " . $room . ", " . $date . ", " . $lesson . " пара</p>"
?>
<div id="error"></div>
<table class="bordered" id="req_table">
    <thead>
        <tr>
            <th>№ Заявки</th>
            <th>ФИО просящего</th>
            <th>ФИО преподавателя</th>
            <th>Цель</th>
            <th>Статус</th>
        </tr>
    </thead>

    <?php
    foreach ($bookings as $booking) {
        ?>
        <tr class="req" id="<?php echo $booking['#']; ?>">
            <?php
            print "<td class=\"num_tbl\">" . $booking['#'] . "</td>" . PHP_EOL
                    . "<td class=\"askname_tbl\">" . $booking['AskerName'] . "</td>" . PHP_EOL
                    . "<td class=\"prepname_tbl\">" . $booking['PrepName'] . "</td>" . PHP_EOL
                    . "<td class=\"aim_tbl\">" . $booking['Aim'] . "</td>" . PHP_EOL
                    . "<td><button class=\"divert_tbl\" type=\"submit\" onclick=\"request_button(this, 0);\">Отклонить</button>"
                    . "<button class=\"approve_tbl\" type=\"submit\" onclick=\"request_button(this, 2);\">Подтвердить</button></td>";
            ?>
        </tr>
        <?php
    }
    ?>
</table>
<a href="#close" class="close">Закрыть окно</a>