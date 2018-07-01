<?php
include 'head.php';
$err = array();
//if (isset($_POST['submit_DB_set'])) {
 if (isset($_POST['submit_adm_signup'])) {   
    $file = fopen('lib/constants.php', 'w+');
    if (isset($_POST['DB_SERVER']) && isset($_POST['DB_NAME'])) {
        if (file_exists('lib/constants.php')) {
            $line = '<?php ';
            fwrite($file, $line);
            $line = 'define("DB_SERVER", "' . $_POST['DB_SERVER'] . '"); ';
            fwrite($file, $line);
            $line = 'define("DB_USER", "' . $_POST['DB_USER'] . '"); ';
            fwrite($file, $line);
            $line = 'define("DB_PASS", "' . $_POST['DB_PASS'] . '"); ';
            fwrite($file, $line);
            $line = 'define("DB_NAME", "' . $_POST['DB_NAME'] . '"); ';
            fwrite($file, $line);
            $line = 'define("DB_INSTALLED", 1); ';
            fwrite($file, $line);
            $line = '?>';
            fwrite($file, $line);

            fclose($file);
        } else {
            $err[] = "Что-то пошло не так. Проверьте права на изменение файлов.";
        }
    } else {
        $err[] = "Поля Сервер БД и Имя БД должны быть заполнены.";
    }

    include 'lib/constants.php';
    /*  СОЗДАНИЕ ТАБЛИЦЫ БД */
    if (count($err) == 0) {

        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS);
        mysqli_set_charset($con, 'utf8');


        mysqli_query($con, "CREATE DATABASE IF NOT EXISTS `" . $_POST['DB_NAME'] . "` DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci");
        mysqli_query($con, "CREATE TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` (
  `#` int(10) UNSIGNED NOT NULL,
  `Type` tinyint(1) UNSIGNED DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` longtext COLLATE utf8mb4_unicode_ci,
  `Name` longtext COLLATE utf8mb4_unicode_ci,
  `Tel` longtext COLLATE utf8mb4_unicode_ci,
  `Department` longtext COLLATE utf8mb4_unicode_ci,
  `Rank` longtext COLLATE utf8mb4_unicode_ci
   ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
        mysqli_query($con, "ALTER TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` ADD PRIMARY KEY (`#`)");
        mysqli_query($con, "ALTER TABLE `" . $_POST['DB_NAME'] . "`.`acc_management` MODIFY `#` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5 ");

        echo '<script type="text/javascript">',
        ' alert("Текст окна оповещения");',
        '</script>';
        echo '<script type="text/javascript">',
        'document.getElementById("DB_set").style.display = "none";',
        '</script>';
        echo '<script type="text/javascript">',
        'document.getElementById("adm_signup").style.display = "block";',
        '</script>';
       // if (isset($_POST['submit_adm_signup'])) {
            $err_email = array();
            if (!$_POST['email']) {
                $err_email[] = "Вы не ввели e-mail";
            } else {

                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $err_email[] = "Вы ввели не e-mail";
                }
            }
            if (!$_POST['password']) {
                $err_email[] = "Пароль не может быть пустым.";
            }
            if (!$_POST['name']) {
                $err_email[] = "Вы не ввели ФИО";
            }
            if (!$_POST['tel']) {
                $err_email[] = "Вы не ввели рабочий телефон";
            }
            if (!$_POST['department']) {
                $err_email[] = "Вы не ввели Отдел";
            }
            if (!$_POST['rank']) {
                $err_email[] = "Вы не ввели должность";
            }
            if (count($err_email) == 0) {
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $name = $_POST['name'];
                $type = 2;
                $tel = $_POST['tel'];
                $department = $_POST['department'];
                $rank = $_POST['rank'];

                mysqli_query($con, "INSERT INTO `acc_management` SET email='" . $email . "', password='" . $password . "', Name='" . $name . "', Type='" . $type . "', Tel='" . $tel . "', Department='" . $department . "', Rank='" . $rank . "'");

                /*  УДАЛЕНИЕ INDEX.PHP, INSTALL.PHP, ПЕРЕИМЕНОВАНИЕ INDEX_INSTALL.PHP -> INDEX.PHP*/

                unlink('index.php');
                rename('index_install.php', 'index.php');
                unlink('install.php');
                echo "Установка выполнена успешно. Вы будете перенаправлены на страницу авторизации. ";
                sleep(15);
                header("Location: auth.php"); 
                exit();
            } else {
                print "<b>При регистрации произошли следующие ошибки:</b><br>";
                foreach ($err_email AS $error) {
                    print $error . "<br>";
                }
            }
        //}
    } else {
        print "<b>Произошли следующие ошибки:</b><br>";
        foreach ($err AS $error) {
            print $error . "<br>";
        }
    }
}
?>
<div id="DB_set"  style="display: block">
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
                <input class="input" id="DB_PASS" name="DB_PASS" type="text" value="">
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
<div id="adm_signup"  style="display: block">
    <form method="POST" name="adm_signup">

        E-mail* <input name="email" type="text"><br>
        Пароль* <input name="password" type="password"><br>
        ФИО* <input name="name" type="text"><br>
        Рабочий телефон*<input name="tel" type="text"><br>
        Отдел* <input name="department" type="text"><br>
        Должность* <input name="rank" type="text"><br>
        <input name="submit_adm_signup" type="submit" value="Зарегистрировать">

    </form>
</div>
<?php
include 'footer.php';
?>


