<?php
    require("constants.php");
    $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    mysqli_set_charset($con, 'utf8');
?>