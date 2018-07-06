<?php

function get_bron($link){
    $sql = "SELECT * FROM test";
    $result= mysqli_query($link, $sql);
    //mysql_query("SET NAMES utf8");
    $bron= mysqli_fetch_all($result,1);
    return $bron;
}
$bron= get_bron($link);