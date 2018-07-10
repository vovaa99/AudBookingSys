<?php
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

    $query = mysqli_query($con, "SELECT COUNT(`#`) FROM `acc_management` WHERE `Email`='" . mysqli_real_escape_string($con, $_POST['email']) . "'");
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
    if (!$_POST['name']) {
        $err_email[] = "Пароль не может быть пустым";
    }
    # Если нет ошибок, то добавляем в БД нового пользователя
    if (count($err) == 0) {
        $email = $_POST['email'];
        
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $name = $_POST['name'];
        $type = $_POST['type'];
        $tel = $_POST['tel'];
        $faculty = $_POST['faculty'];
        $rank = $_POST['rank'];

        mysqli_query($con, "INSERT INTO `acc_management` SET `Email`='" . $email . "', `Password`='" . $password . "', `Name`='" . $name . "', `Type`='" . $type . "', `Tel`='" . $tel . "', `Faculty`='" . $faculty . "', `Rank`='" . $rank . "'");

        header("Location: auth.php");
        exit();
    } else {    
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach ($err AS $error) {
            print $error . "<br>";
        }
    }
}
include 'head.php';
?>
<form method="POST">

    E-mail* <input name="email" type="text"><br>
    Пароль* <input name="password" type="password"><br>
    ФИО* <input name="name" type="text"><br>
    Тип* <br>
    <input type="radio" name="type" value="1" />Клиент <br>
    <input type="radio" name="type" value="2" />Администратор <br>

    Рабочий телефон <input name="tel" type="text"><br>
    Отдел <input name="faculty" type="text"><br>
    Должность <input name="rank" type="text"><br>


    <input name="submit" type="submit" value="Зарегистрировать">

</form>

<?php
include 'footer.php';
?>