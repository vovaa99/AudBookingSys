<?php
include 'lib/connection.php';
include 'head.php';
session_start();

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

    <h1 style="color: blue">ВОСКРЕСЕНЬЕ 1 ИЮЛЯ 2018г.</h1>
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
            <div id="block" class="modalDialog">
                <div id="modal">
                    <p>Окно с действиями</p>
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
   /* function setcoord(evt) {
        var x,y,line;
        x = evt.pageX;
        y = evt.pageY;
     
       
        line = y+"px auto auto "+x+"px";
      
        document.getElementById("modal").style.margin = line;
    }*/
</script>
<?php
include 'footer.php';
