<?php
include '../lib/connection.php';
include '../head.php';

if (isset($_POST['submit_adm_signup'])) {
    $err_signup = array();
    if (empty($_POST['email'])) {
        $err_signup[] = "Вы не ввели e-mail";
    } else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $err_signup[] = "Вы ввели не e-mail";
        }
    }
    if (!$_POST['password']) {
        $err_signup[] = "Пароль не может быть пустым.";
    }
    if (!$_POST['name']) {
        $err_signup[] = "Вы не ввели ФИО";
    }
    if (!$_POST['tel']) {
        $err_signup[] = "Вы не ввели рабочий телефон";
    }
    if (!$_POST['faculty']) {
        $err_signup[] = "Вы не ввели Отдел";
    }
    if (!$_POST['rank']) {
        $err_signup[] = "Вы не ввели должность";
    }
    if (count($err_signup) == 0) {
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $type = 2;
        $tel = $_POST['tel'];
        $faculty = $_POST['faculty'];
        $rank = $_POST['rank'];

        if(!mysqli_query($con, "INSERT INTO `acc_management` SET email='" . $email . "', password='" . $password . "', Name='" . $name . "', Type='" . $type . "', Tel='" . $tel . "', Faculty='" . $faculty . "', Rank='" . $rank . "'"))
        {
            print "<b>Не удалось выполнить запрос.</b><br>";   
            printf("Errormessage: %s\n", mysqli_error($con));
        }else{
            header('Location: ../result.php');
        }
        
        /*  УДАЛЕНИЕ INDEX.PHP, INSTALL.PHP, ПЕРЕИМЕНОВАНИЕ INDEX_INSTALL.PHP -> INDEX.PHP */
    } else {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach ($err_signup AS $error) {
            print $error . "<br>";
        }
    }
}
?>
<div id="adm_signup">
    <form method="POST" name="adm_signup">
        <p>
            <label for="email">E-mail* <input name="email" type="text"></label>
        </p>
        <p>
            <label for="password">Пароль* <input name="password" type="password"></label>
        </p>
        <p>
            <label for="name">ФИО* <input name="name" type="text"></label>
        </p>
        <p>
            <label for="tel">Рабочий телефон*<input name="tel" type="text"></label>
        </p>
        <p>
            <label for="faculty">Отдел* <input name="faculty" type="text"></label>
        </p>
        <p>
            <label for="rank">Должность* <input name="rank" type="text"></label>
        </p>
        <input name="submit_adm_signup" type="submit" value="Зарегистрировать">
    </form>
</div>
<?php
include '../footer.php';

