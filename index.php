<?php
include 'lib/connection.php';
session_start();
include 'head.php';
if (!isset($_SESSION['date'])) {
    $_SESSION['date'] = date("Y-m-d");
}
if (isset($_POST['submit_date'])) {
    $_SESSION['date'] = $_POST['date'];
}
$date = $_SESSION['date'];
?>

<div class="content">
    <form action="" id="date" method="post" name="date">
        <p>            
            <label for="date">Дата: </label>
            <input type="date" id="date" name="date" value="<?php print $date; ?>"/> 
            <button type="submit" name="submit_date" class="operations">Перейти</button>          
        </p> 
    </form>
    <?php
    $days = [
        'Воскресенье', 'Понедельник', 'Вторник', 'Среда',
        'Четверг', 'Пятница', 'Суббота'
    ];

    $day = $days[date("w", strtotime($date))];
    $months = [
        '', 'января', 'февраля', 'марта', 'апреля',
        'мая', 'июня', 'июля', 'августа', 'сентября', 'октября',
        'ноября', 'декабря'
    ];

    $month = $months[date("n", strtotime($date))];
    ?>
    <h1 style="color: blue"><?php
        echo $day . ", " . date("j", strtotime($date)) . " " . $month . " " . date("Y", strtotime($date));
        ?>г.</h1>
    <?php
    if (!isset($_SESSION['session_username'])) {
        ?>
        <a href="auth.php">Вход</a>
        <?php
    } else {
        $type1 = mysqli_fetch_array(mysqli_query($con, "SELECT `Type` FROM `acc_management` WHERE `email`='" . $_SESSION['session_username'] . "'"));
        $type = $type1[0];
        if ($type == 1) {
            echo $_SESSION['name'];
            ?>
            <div class="menu">
                <p>Пользователь деканат</p>
                <a href="logout.php">Выход</a>
            </div>

            <div class="tab">
                <button class="tablinks" onclick="setLesson(event, '1')" id="defaultOpen">1 пара</button>
                <button class="tablinks" onclick="setLesson(event, '2')">2 пара</button>
                <button class="tablinks" onclick="setLesson(event, '3')">3 пара</button>
                <button class="tablinks" onclick="setLesson(event, '4')">4 пара</button>
                <button class="tablinks" onclick="setLesson(event, '5')">5 пара</button>
                <button class="tablinks" onclick="setLesson(event, '6')">6 пара</button>
                <button class="tablinks" onclick="setLesson(event, '7')">7 пара</button>
            </div>
            <div id="booking">
            </div>
            <?php
        } else if ($type == 2) {
            echo $_SESSION['name'];
            ?>
            <div class="menu">
                <p>Пользователь диспетчер</p>
                <a href="logout.php">Выход</a>
            </div>

            <div class="tab">
                <button class="tablinks" onclick="setLesson(event, '1')" id="defaultOpen">1 пара</button>
                <button class="tablinks" onclick="setLesson(event, '2')">2 пара</button>
                <button class="tablinks" onclick="setLesson(event, '3')">3 пара</button>
                <button class="tablinks" onclick="setLesson(event, '4')">4 пара</button>
                <button class="tablinks" onclick="setLesson(event, '5')">5 пара</button>
                <button class="tablinks" onclick="setLesson(event, '6')">6 пара</button>
                <button class="tablinks" onclick="setLesson(event, '7')">7 пара</button>
            </div>

            <div id="booking">
            </div>
            <div id="block1" class="modalDialog">
                <div class="modal">
                </div>
            </div>
            <div id="block2" class="modalDialog">
                <div class="modal">
                    <p>Список заявок</p> /*ajax*/
                    <a href="#close" class="close">Закрыть окно</a>
                </div>
            </div>
            <div id="block3" class="modalDialog">
                <div class="modal">
                    <p> Окно3 </p>
                    <a href="#close" class="close">Закрыть окно</a>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>
<script>
    function produceData(lesson) {
        if (lesson == "") {
            document.getElementById("booking").innerHTML = "";
            return;
        } else {
            xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("booking").innerHTML = this.responseText;
                }
            };
            if (<?php print $type; ?> == 1) {
                xmlhttp.open("GET", "sys_1.php?q=" + lesson + "&d=" + "<?php print $date; ?>", true);
            } else if (<?php print $type; ?> == 2) {
                xmlhttp.open("GET", "sys_2.php?q=" + lesson + "&d=" + "<?php print $date; ?>", true);
            } else {
                xmlhttp.open("GET", "sys_0.php?q=" + lesson + "&d=" + "<?php print $date; ?>", true);
            }
            xmlhttp.send();
        }
    }
    function setLesson(evt, lesson) {
        produceData(lesson);
        var i, tablinks;
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        evt.currentTarget.className += " active";
    }
    document.getElementById("defaultOpen").click();
    function generateform(lesson, date, room) {
        var targetDiv = document.getElementById("block1").getElementsByClassName("modal")[0];
        targetDiv.innerHTML = `
        <div id="error"></div>
        <p>Заявка на аудиторию ${room}, ${date}, ${lesson} пара</p> 
        <p>
            <label for="prepname">ФИО преподавателя
                <input class="input" id="prepname_ar" name="prepname" type="text" value="">
            </label>
        </p>
        <p>
            <label for="aim">Цель
                <input class="input" id="aim_ar" name="aim"  type="text" value="Проведение занятия">
            </label>
        </p> 
        <p>
            <label for="faculty">Факультет
                <input class="input" id="faculty_ar" name="faculty"  type="text" value="Факультет">
            </label>
        </p> 
        <input style="display:none" class="input" id="lesson_ar" name="lesson" type="text" value="${lesson}">
        <input style="display:none" class="input" id="date_ar" name="date" type="date" value="${date}"> 
        <input style="display:none" class="input" id="room_ar" name="room" type="text" value="${room}">  
        <input style="display:none" class="input" id="email_ar" name="email" type="text" value="<?php print $_SESSION['session_username']; ?>">  
        <p class="submit"><input class="button" name="submit_zayavka" type="submit" value="Оставить заявку" onclick="return audrequest();"></p>
        <a href="#close" class="close">Закрыть окно</a>`;
    }

    function audrequest() {
        formData = {
            'room': document.getElementById("room_ar").value,
            'date': document.getElementById("date_ar").value,
            'lesson': document.getElementById("lesson_ar").value,
            'email': document.getElementById("email_ar").value,
            'faculty': document.getElementById("faculty_ar").value,
            'prepname': document.getElementById("prepname_ar").value,
            'aim': document.getElementById("aim_ar").value
        }
        $.ajax({
            type: "POST",
            url: "newAudRequest.php",
            data: formData,
            cache: false,
            success: function (response) {
                if (response == "1") {
                    document.location = "index.php#close";
                    var el = document.getElementsByClassName("tablinks active");
                    produceData(el[0].innerHTML.substr(0, 1));
                } else
                {
                    $('#error').html(response);
                }
            }
        });
        return false;
    }
    function request_table(lesson, date, room) {
        formData = {
            'room': room,
            'date': date,
            'lesson': lesson,
        }
        $.ajax({
            type: "POST",
            url: "get_short_table.php",
            data: formData,
            cache: false,
            success: function (response) {
                if (response == "error") {
                    document.location = "index.php#close";
                    var el = document.getElementsByClassName("tablinks active");
                    produceData(el[0].innerHTML.substr(0, 1));
                } else
                {
                    //document.getElementById("block2").getElementsByClassName("modal")[0].innerHTML=response;
                    $('#block2 .modal').html(response);
                }
            }
        });
    }
    function request_button(element, status) {
        var id = element.closest("tr").id;
        req = {
            'id': id,
            'status': status
        }
        $.ajax({
            type: "POST",
            url: "process_short_table.php",
            data: req,
            cache: false,
            success: function (response) {
                /*if (html != "error")
                 {
                 $('#error').html(response);
                 
                 } else {
                 document.location = "index.php#close";
                 var el = document.getElementsByClassName("tablinks active");
                 produceData(el[0].innerHTML.substr(0, 1));
                 }*/
                document.location = "index.php#close";
                var el = document.getElementsByClassName("tablinks active");
                produceData(el[0].innerHTML.substr(0, 1));
            }
        });
        return false;
    }
</script>
<?php
include 'footer.php';
