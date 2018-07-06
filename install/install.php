<?php
include '../head.php';
$err = 0;
$err_line = array();

if (isset($_POST['submit_DB_set'])) {

    $file = fopen('../lib/constants.php', 'w+');
    
    if (!$file) {
        $err++;
        $err_line[] = "Что-то пошло не так. Проверьте права на изменение файлов.";
    }
    if ($err == 0) {
        if (!empty($_POST['DB_SERVER']) && !empty($_POST['DB_NAME'])) {

            $line = '<?php '.PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_SERVER", "' . $_POST['DB_SERVER'] . '"); '.PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_USER", "' . $_POST['DB_USER'] . '"); '.PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_PASS", "' . $_POST['DB_PASS'] . '"); '.PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_NAME", "' . $_POST['DB_NAME'] . '"); '.PHP_EOL;
            fwrite($file, $line);
            fclose($file);
        } else {
            $err++;
            $err_line[] = "Поля Сервер БД и Имя БД должны быть заполнены.";
        }
    }
    /*  СОЗДАНИЕ ТАБЛИЦЫ БД */
    if ($err == 0) {

        $con = @mysqli_connect($_POST['DB_SERVER'], $_POST['DB_USER'], $_POST['DB_PASS']);
        //$con = @mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        if (mysqli_connect_errno()) {
            //$err++;
            $err_line[] = mysqli_connect_error();
            //$err_array[] = mysqli_connect_error();
            //print_r( mysqli_error_list($con));
        } else {
            mysqli_set_charset($con, 'utf8');
        }
    }
    if ($err == 0) {
        $query = mysqli_query($con, "CREATE DATABASE IF NOT EXISTS `" . $_POST['DB_NAME'] . "` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci");
        if (!$query) {
            $err_line[] = mysqli_error($con);
            //$err_array[] = mysqli_error_list($con);
            //print_r( mysqli_error_list($con));
        }
    }
    if ($err == 0) {
        $query = mysqli_query($con, "CREATE TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` (
  `#` int(10) UNSIGNED NOT NULL,
  `Type` tinyint(1) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` longtext COLLATE utf8mb4_unicode_ci,
  `Name` longtext COLLATE utf8mb4_unicode_ci,
  `Tel` longtext COLLATE utf8mb4_unicode_ci,
  `Department` longtext COLLATE utf8mb4_unicode_ci,
  `Rank` longtext COLLATE utf8mb4_unicode_ci
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        if (!$query) {
            $err++;
            $err_line[] = mysqli_error($con);
            //$err_array[] = mysqli_error_list($con);
            //print_r( mysqli_error_list($con));
        }
    }
    if ($err == 0) {
        $query = mysqli_query($con, "ALTER TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` ADD PRIMARY KEY (`#`)");
        if (!$query) {
            $err++;
            $err_line[] = mysqli_error($con);
            //$err_array[] = mysqli_error_list($con);
            //print_r( mysqli_error_list($con));
        }
    }
    if ($err == 0) {
        $query = mysqli_query($con, "ALTER TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` MODIFY `#` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ");

        if (!$query) {
            $err++;
            $err_line[] = mysqli_error($con);
        }
        //$err_array[] = mysqli_error_list($con);
        //print_r( mysqli_error_list($con));
    }
    /*
CREATE TABLE IF NOT EXISTS `" . $_POST['DB_NAME'] . "`.`booking` (
  `№ заявки` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `№ аудитории` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Дата` date NOT NULL,
  `№ пары` int(1) UNSIGNED NOT NULL,
  `Логин` varchar(255) NOT NULL,
  `ФИО просящего` varchar(255) CHARACTER SET utf8 NOT NULL,
  `ФИО преподавателя` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Цель` varchar(255) CHARACTER SET utf8 NOT NULL,
  `Статус` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`№ заявки`),
  KEY `№ аудитории` (`№ аудитории`),
  KEY `№ пары` (`№ пары`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;  
*/
    /*

     CREATE TABLE IF NOT EXISTS `rooms` (
  `Номер` text(9) DEFAULT NULL,
  `Корпус` char(1) DEFAULT NULL,
  `Состояние` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
     * 
     * INSERT INTO `rooms` (`Номер`, `Корпус`, `Состояние`) VALUES
('17-А', 'A', '1'),
('107-А', 'A', '1'),
('209-А', 'A', '1'),
('304-А', 'A', '1'),
('305-А', 'A', '1'),
('315-А', 'A', '1'),
('323-А', 'A', '1'),
('332-А', 'A', '1'),
('334-А', 'A', '1'),
('335-А', 'A', '1'),
('401-А', 'A', '1'),
('402-А', 'A', '1'),
('404-А', 'A', '1'),
('423-А', 'A', '1'),
('504-А', 'A', '1'),
('508-А', 'A', '1'),
('601-А', 'A', '1'),
('602-А', 'A', '1'),
('603-А', 'A', '1'),
('604-А', 'A', '1'),
('607-А', 'A', '1'),
('701-А', 'A', '1'),
('702-А', 'A', '1'),
('708-А', 'A', '1'),
('806-А', 'A', '1'),
('808-А', 'A', '1'),
('901-А', 'A', '1'),
('902-А', 'A', '1'),
('908-А', 'A', '1'),
('1001-А', 'A', '1'),
('1002-А', 'A', '1'),
('1005-А', 'A', '1'),
('1006-А', 'A', '1'),
('2401-А', 'A', '1'),
('101-Б', 'Б', '1'),
('105-Б', 'Б', '1'),
('201-Б', 'Б', '1'),
('203-Б', 'Б', '1'),
('207-Б', 'Б', '1'),
('209-Б', 'Б', '1'),
('228-Б', 'Б', '1'),
('303-Б', 'Б', '1'),
('311-Б', 'Б', '1'),
('315-Б', 'Б', '1'),
('319-Б', 'Б', '1'),
('321-Б', 'Б', '1'),
('323-Б', 'Б', '1'),
('513-Б', 'Б', '1'),
('515-Б', 'Б', '1'),
('517-Б', 'Б', '1'),
('518-Б', 'Б', '1'),
('1000-Б', 'Б', '1'),
('1-В', 'В', '1'),
('205-В', 'В', '1'),
('301-В', 'В', '1'),
('302-В', 'В', '1'),
('305-В', 'В', '1'),
('306-В', 'В', '1'),
('309-В', 'В', '1'),
('310-В', 'В', '1'),
('311-В', 'В', '1'),
('401-В', 'В', '1'),
('405-В', 'В', '1'),
('406-В', 'В', '1'),
('408-В', 'В', '1'),
('409-В', 'В', '1'),
('411-В', 'В', '1'),
('412-В, В, 1);


     *      */
    if ($err > 0) {
        print "<b>Произошли следующие ошибки:</b><br>";
        foreach ($err_line as $error) {
            echo "Value: $error\n";  
        }
        $line = 'define("DB_INSTALLED", 0); '.PHP_EOL;
        file_put_contents('../lib/constants.php', $line, FILE_APPEND);
        $err_file = fopen('../errors.txt', 'w+');
        foreach($err_line as $err)
        {
            fwrite($err_file, $err.PHP_EOL);    
        }
        fclose($err_file);

    }
    if ($err == 0) {
        $line = 'define("DB_INSTALLED", 1); '.PHP_EOL;
        file_put_contents('../lib/constants.php', $line, FILE_APPEND);
        header("Location: first_signup.php");
        exit();
    }
}
?>
<div id="DB_set" >
    <form action="" method="post" name="DB_set">
        <p>
            <label for="DB_SERVER">Сервер БД*
                <input class="input" id="DB_SERVER" name="DB_SERVER" type="text" value="">
            </label>
        </p>
        <p>
            <label for="DB_USER">Имя пользователя БД
                <input class="input" id="DB_USER" name="DB_USER" type="text" value="">
            </label>
        </p>
        <p>
            <label for="DB_PASS">Пароль к БД
                <input class="input" id="DB_PASS" name="DB_PASS" type="password" value="">
            </label>
        </p>
        <p>
            <label for="DB_NAME">Имя БД*
                <input class="input" id="DB_NAME" name="DB_NAME" type="text" value="">
            </label>
        </p>
        <p class="submit"><input class="button" name="submit_DB_set" type="submit" value="Продолжить"></p>
    </form>
</div>
<?php
include '../footer.php';
?>
