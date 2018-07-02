<?php
include 'head.php';
$err = 0;
$err_line = array();


if (isset($_POST['submit_DB_set'])) {
    $file = fopen('lib/constants.php', 'w+');
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
            $err++;
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
            $err++;
            $err_line[] = mysqli_error($query);
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
            $err_line[] = mysqli_error($query);
            //$err_array[] = mysqli_error_list($con);
            //print_r( mysqli_error_list($con));
        }
    }
    if ($err == 0) {
        $query = mysqli_query($con, "ALTER TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` ADD PRIMARY KEY (`#`)");
        if (!$query) {
            $err++;
            $err_line[] = mysqli_error($query);
            //$err_array[] = mysqli_error_list($con);
            //print_r( mysqli_error_list($con));
        }
    }
    if ($err == 0) {
        $query = mysqli_query($con, "ALTER TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` MODIFY `#` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1 ");

        if (!$query) {
            $err++;
            $err_line[] = mysqli_error($query);
        }
        //$err_array[] = mysqli_error_list($con);
        //print_r( mysqli_error_list($con));
    }

    if ($err > 0) {
        print "<b>Произошли следующие ошибки:</b><br>";
        foreach ($err_line as $error) {
            echo "Value: $error\n";  
        }
        $line = 'define("DB_INSTALLED", 0); '.PHP_EOL;
        file_put_contents('lib/constants.php', $line, FILE_APPEND);
    }
    if ($err == 0) {
        $line = 'define("DB_INSTALLED", 1); '.PHP_EOL;
        file_put_contents('lib/constants.php', $line, FILE_APPEND);
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
include 'footer.php';
?>
