<?php

$err = 0;
session_start();
session_destroy();

unlink('index.php');
rename('install/index.php', 'index.php');

if (is_file('index.php') && filesize('index.php') != 13746) {   ///вес install.php в байтах
    include 'head.php';
    print "<b>Замените файл index.php файлом install/index.php, удалите папку install, удалите файл result.php, чтобы завершить установку. </b><br>";
    $err++;
} elseif (!is_file('index.php')) {
    include 'head.php';
    print "<b>Переместите файл  install/index.php в корневую директорию, удалите папку install и удалите файл result.php, чтобы завершить установку. </b><br>";
    $err++;
    include 'footer.php';
} else {
    unlink('install');
    unlink('result.php');
}
if ($err == 0 && is_dir('install') && is_file('result.php')) {
    include 'head.php';
    print "<b>Удалите папку install и удалите файл result.php, чтобы завершить установку. </b><br>";
    $err++;
    include 'footer.php';
}
if ($err == 0 && is_dir('install') && !is_file('result.php')) {
    include 'head.php';
    print "<b>Удалите папку install, чтобы завершить установку. </b><br>";
    $err++;
    include 'footer.php';
}
if ($err == 0) {
    //print "<b>Установка прошла успешно.</b><br>";
    //sleep(30);
    header('Loaction: index.php');
    die();
}
