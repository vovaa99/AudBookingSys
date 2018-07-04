<?php
$err=0;
    unlink('index.php');
    rename('install/index.php', 'index.php');

    if (is_file('index.php') && filesize('index.php') != 661){   
        print "<b>Замените файл index.php файлом install/index.php, удалите папку install, удалите файл result.php, чтобы завершить установку. </b><br>";   
        $err++;
    } elseif (!is_file('index.php')) {    
        print "<b>Переместите файл  install/index.php в корневую директорию, удалите папку install и удалите файл result.php, чтобы завершить установку. </b><br>";   
        $err++;
    }
    else {
        unlink('install');
        unlink('result.php');
    }
    if($err == 0 && is_dir('install')&& is_file('result.php'))
    {        
        print "<b>Удалите папку install и удалите файл result.php, чтобы завершить установку. </b><br>";
        $err++;
    }
    if($err == 0 && is_dir('install')&& !is_file('result.php'))
    {        
        print "<b>Удалите папку install, чтобы завершить установку. </b><br>";
        $err++;
    }
    if($err == 0)
    {
         print "<b>Удалите папку install, чтобы завершить установку. </b><br>";
         sleep(30);
         header('Loaction: index.php');
    }
