<?php 

include 'head.php';
session_start();
require 'lib/connection.php';

if (isset($_SESSION['session_username'])) {
    // вывод "Session is set"; // в целях проверки
    header("Location: index.php");
}

if (isset($_POST['submit'])) {    
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $query = mysqli_query($con, "SELECT `password` FROM `acc_management` WHERE email='".mysqli_real_escape_string($con, $_POST['email'])."'");        
        $data = mysqli_fetch_assoc($query);
        if ( password_verify ($_POST['password'], $data['password']) ){
            // старое место расположения
            //  session_start();
            $_SESSION['session_username'] = $email;
            /* Перенаправление браузера */
            header("Location: index.php");
        
        } else {
            echo "Неверный E-mail и/или пароль!<br>";
            echo $_POST['email'], ' ' , $_POST['password'],' ', $data['password'];
        }
    } else {
        $message = "Необходимо заполнить все поля!";
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
        <p class="regtext"><a href= "register.php">Регистрация</a></p>
    </form>
</div>

<?php
include 'footer.php';
?>