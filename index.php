<?php
require 'lib/constants.php';
if (!DB_INSTALLED) {
    header("Location: install.php");
} else {
    echo "Что-то пошло не так";
}
