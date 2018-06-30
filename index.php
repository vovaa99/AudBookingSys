<?php 
include 'head.php';
session_start();
if(!isset($_SESSION['session_username']))
{
?>

<a href="auth.php">Вход</a>

<?php

}
else if($_SESSION['type'] == 1){
    echo $_SESSION['name'];
?>
<p>Пользователь деканат</p>
<a href="logout.php">Выход</a>
<?php
}
else if($_SESSION['type'] == 2){
    echo $_SESSION['name'];

?>
<p>Пользователь диспетчер</p>
<a href="logout.php">Выход</a>
<?php
}
include 'footer.php';
?>
