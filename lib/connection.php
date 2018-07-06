<?php
    require("constants.php");
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    if(mysqli_connect_errno()){
    echo 'Ошибка подключения к базе данных ('.mysqli_connest_errno().'):' .mysqli_connect_error();
        exit();
    }
    mysqli_set_charset($con, 'utf8');

