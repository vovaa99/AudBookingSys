<?php
include 'head.php';
session_start();
require 'lib/connection.php';

if (isset($_POST['submit'])) {
    $err = array();
    if (!$_POST['email']) {
        $err[] = "Вы не ввели e-mail";
    } else {

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $err[] = "Вы ввели не e-mail";
        }
    }
    # проверяем, не сущестует ли пользователя с таким именем

    $query = mysqli_query($con, "SELECT COUNT(`#`) FROM `acc_management` WHERE email='" . mysqli_real_escape_string($con, $_POST['email']) . "'");
    mysqli_field_seek($query, 0);
    $finfo = mysqli_fetch_assoc($query);
    if ($finfo["COUNT(`#`)"] > 0) {
        $err[] = "Пользователь с таким E-mail уже существует зарегистрирован";
    }
    if (!$_POST['name']) {
        $err[] = "Вы не ввели ФИО";
    }
    if (!isset($_POST['type'])) {
        $err[] = "Вы не указали тип пользователя";
    }
    # Если нет ошибок, то добавляем в БД нового пользователя
    if (count($err) == 0) {
        $email = $_POST['email'];
        # Убераем лишние пробелы и делаем двойное шифрование
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $type = $_POST['type'];
        $tel = $_POST['tel'];
        $department = $_POST['department'];
        $rank = $_POST['rank'];

        mysqli_query($con, "INSERT INTO `acc_management` SET email='" . $email . "', password='" . $password . "', Name='" . $name . "', Type='" . $type . "', Tel='" . $tel . "', Department='" . $department . "', Rank='" . $rank . "'");

        header("Location: auth.php");
        exit();
    } else {    
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach ($err AS $error) {
            print $error . "<br>";
        }
    }
}
?>
<form method="POST">

    E-mail* <input name="email" type="text"><br>
    Пароль* <input name="password" type="password"><br>
    ФИО* <input name="name" type="text"><br>
    Тип* <br>
    <input type="radio" name="type" value="1" />Клиент <br>
    <input type="radio" name="type" value="2" />Администратор <br>

    Рабочий телефон <input name="tel" type="text"><br>
    Отдел <input name="department" type="text"><br>
    Должность <input name="rank" type="text"><br>


    <input name="submit" type="submit" value="Зарегистрировать">

</form>

<?php
include 'footer.php';
?>