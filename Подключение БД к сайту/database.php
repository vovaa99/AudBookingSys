<?php

$link=mysqli_connect('localhost','root','','bd');
mysqli_query($link, "SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
mysqli_query($link, "SET CHARACTER SET 'utf8'");
if(mysqli_connect_errno()){
    echo 'Ошибка подключения к базе данных ('.mysqli_connest_errno().'):' .mysqli_connect_error();
    exit();
}


