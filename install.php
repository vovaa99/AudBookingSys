<?php
include 'head.php';
if (isset($_POST('submit'))) {
    
}
?>

<form action="" id="DB_set" method="post" name="DB_set">
    <p>
        <label for="DB_SERVER">Сервер БД
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
        <label for="DB_NAME">Имя БД
            <input class="input" id="DB_NAME" name="DB_NAME" type="text" value="">
        </label>
    </p>
    <p class="submit"><input class="button" name="submit" type="submit" value="Продолжить"></p>
</form>

<?php
include 'footer.php';
?>


