<?php
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

            $line = '<?php ' . PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_SERVER", "' . $_POST['DB_SERVER'] . '"); ' . PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_USER", "' . $_POST['DB_USER'] . '"); ' . PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_PASS", "' . $_POST['DB_PASS'] . '"); ' . PHP_EOL;
            fwrite($file, $line);
            $line = 'define("DB_NAME", "' . $_POST['DB_NAME'] . '"); ' . PHP_EOL;
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
        } else {
            mysqli_set_charset($con, 'utf8');
        }
    }
    include '../lib/constants.php';
    if ($err == 0) {
        $templine = '';
// Read in entire file
        $lines = file('setup.sql');
// Loop through each line
        foreach ($lines as $line) {
// Skip it if it's a comment
            if (substr($line, 0, 2) == '--' || $line == '')
                continue;
            $err_line[] = $line . "<br>";
            $line = str_replace('DB_NAME', '' . DB_NAME . '', $line);
            $err_line[] = $line . "<br>";
// Add this line to the current segment
            $templine .= $line;
// If it has a semicolon at the end, it's the end of the query
            if (substr(trim($line), -1, 1) == ';') {
                // Perform the query
                if (!mysqli_query($con, $templine)) {
                    $err++;
                    $err_line[] = "!ERROR!" . mysqli_error($con) . "<br>";
                }
                // Reset temp variable to empty
                $templine = '';
            }
        }
    }
 /*   if (headers_sent()) {
        $err++;
        $err_line[] = "Redirect failed. Please click on this link.<br>";
    }*/
    if ($err > 0) {
        print "<b>Произошли следующие ошибки:</b><br>";
        foreach ($err_line as $error) {
            echo "Value: $error\n";
        }
        $line = 'define("DB_INSTALLED", 0); ' . PHP_EOL;
        file_put_contents('../lib/constants.php', $line, FILE_APPEND);
        $err_file = fopen('../errors.txt', 'w+');
        foreach ($err_line as $err) {
            fwrite($err_file, $err . PHP_EOL);
        }
        fclose($err_file);
    } else {       
        $line = 'define("DB_INSTALLED", 1); ' . PHP_EOL;
        file_put_contents('../lib/constants.php', $line, FILE_APPEND);
        /*      $err_file = fopen('../errors.txt', 'w+');
          foreach ($err_line as $err) {
          fwrite($err_file, $err . PHP_EOL);
          }
          fclose($err_file); */
        header('HTTP/1.0 302 Found');
        //header('Location: http://localhost/MyBooks.php');
        header('Location: first_signup.php');
        die();
    }
}
include '../head.php';
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
