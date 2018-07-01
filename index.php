<?php

if (!INSTALLED) {
    header("Location: install.php");
} else {
    echo "Что-то пошло не так";
}