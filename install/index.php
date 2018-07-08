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
    <div id="header">
        <div id="left_head"> 

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
            $type = 0;
            if (!isset($_SESSION['session_username'])) {
                ?>
            </div>
            <div class="menu">
                <a href="auth.php">Вход</a>
            </div>
        </div>

        <div id="info"></div>
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
    } else {
        $type1 = mysqli_fetch_array(mysqli_query($con, "SELECT `Type` FROM `acc_management` WHERE `email`='" . $_SESSION['session_username'] . "'"));
        $type = $type1[0];

        /*
         * 
          Деканат
         * 
         */
        if ($type == 1) {
            ?>
        </div>
        <div class="menu">
            <?php
            echo $_SESSION['name'];
            ?>
            <p>Пользователь деканат</p>
            <p class="regtext"><a href= "accManager.php">Изменить аккаунт</a></p>
            <a href="logout.php">Выход</a>
        </div>
        </div>
        <div id="info"></div>
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
        <?php
        /*
         * 
          Диспетчер
         * 
         */
    } else if ($type == 2) {
        ?>
        </div>
        <div class="menu">
            <?php
            echo $_SESSION['name'];
            ?>
            <p>Пользователь диспетчер</p>
            <p class="regtext"><a href= "signup.php">Регистрация нового пользователя</a></p>
            <p class="regtext"><a href= "table.php">Заявки</a></p>
            <p class="regtext"><a href= "table.php">Аудитории</a></p>
            <p class="regtext"><a href= "accManager.php">Изменить аккаунт</a></p>
            <a href="logout.php">Выход</a>
        </div>
        </div>
        <div id="info"></div>
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
                <p>Список заявок</p>
                <a href="#close" class="close">Закрыть окно</a>
            </div>
        </div>
        <div id="block3" class="modalDialog">
            <div class="modal">
                <p>Отклонить заявку</p>
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
</script>
<script>
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
    <input style="display:none" class="input" id="email_ar" name="email" type="text" value="<?php
if ($type != 0) {
    print $_SESSION['session_username'];
} else {
    print "";
}
?>">  
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
    function generate_reject(id, lesson, date, room) {
        var targetDiv = document.getElementById("block3").getElementsByClassName("modal")[0];
        targetDiv.innerHTML = `
    <div id="error_rj"></div>
    <p>Заявка на аудиторию # ${id}, ${room}, ${date}, ${lesson} пара</p>
    <input style="display:none" class="input" id="id_rj" name="id_rj" type="text" value="${id}">        
    <p class="submit"><input class="button" name="reject_zayavka" type="submit" value="Отклонить заявку" onclick="return audrejectrequest()"></p>
    <a href="#close" class="close">Закрыть окно</a>`;
    }
    function audrejectrequest()
    {
        formData = {
            'id': document.getElementById("id_rj").value
        }
        /*alert(formData['id']);*/
        $.ajax({
            type: "POST",
            url: "reject_request.php",
            data: formData,
            cache: false,
            success: function (response) {
                if (response == "1") {
                    document.location = "index.php#close";
                    var el = document.getElementsByClassName("tablinks active");
                    produceData(el[0].innerHTML.substr(0, 1));
                } else
                {
                    $('#error_rj').html(response);
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
                document.location = "index.php#close";
                var el = document.getElementsByClassName("tablinks active");
                produceData(el[0].innerHTML.substr(0, 1));
            }
        });
        return false;
    }
    function get_booking_info(element) {
        var id = element.className.split(" ").pop();
        req = {
            'id': id
        }
        $.ajax({
            type: "POST",
            url: "get_booking_info.php",
            data: req,
            cache: false,
            success: function (response) {
                $("#info").html(response);
            }
        });
    }
    function clear_info()
    {
        $("#info").empty();
    }

</script>

<?php
include 'footer.php';
