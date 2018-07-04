<?php

    require('lib/constants.php');
    if (!is_dir('install') && DB_INSTALLED) {
        echo "Проведите установку с нуля.";
    } else {
        header("Location: install/install.php");
    }



