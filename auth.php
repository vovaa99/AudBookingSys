<?php

include 'head.php';
session_start();
require 'lib/connection.php';

if (isset($_SESSION['session_username'])) 
{    
    header("Location: index.php");
}

if (isset($_POST['submit'])) {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $query = mysqli_query($con, "SELECT Name, Type, password FROM `acc_management` WHERE email='".mysqli_real_escape_string($con, $_POST['email'])."'");        
        $data = mysqli_fetch_assoc($query);
        if ( password_verify ($_POST['password'], $data['password']) ){
            // старое место расположения
            //  session_start();
            $_SESSION['session_username'] = $_POST['email'];
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            //$_SESSION['type'] = $data['Type'];
            $_SESSION['name'] = $data['Name'];
            /* Перенаправление браузера */
            header("Location: index.php");
        
        } else {
            echo "Неверный E-mail и/или пароль!<br>";
            //echo $_POST['email'], ' ' , $_POST['password'],' ', $data['password'], ' ', $data['Name'];
        }
    } else {
         print "<p>Необходимо заполнить все поля</p>";
    }
}
?>
<div id="login">
    <h1>Вход</h1>
    <form action="" id="loginform" method="post" name="loginform">
        <p>
            <label for="user_login">E-mail
                <input class="input" id="email" name="email"size="20" type="text" value="">
            </label>
        </p>
        <p>
            <label for="user_pass">Пароль
                <input class="input" id="password" name="password" size="20"  type="password" value="">
            </label>
        </p> 
        <p class="submit"><input class="button" name="submit" type="submit" value="Войти"></p>
        <p class="regtext"><a href= "signup.php">Регистрация</a></p>
    </form>
</div>

<?php
include 'footer.php';
?>