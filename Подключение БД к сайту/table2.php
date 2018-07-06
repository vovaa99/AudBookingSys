<!DOCTYPE html>
    <?php
    require_once 'database.php';
    require_once 'function.php';
    ?>

<html>
    <head>
        <meta charset="utf-8">
        <title>Таблица с закругленными углами на CSS</title>
        <link rel='stylesheet' href='style.css' type='text/css' />
    </head>

    <body>
        <div class="content">
            <div class="table-wrapper">
                <h2 style="float:left">Список заявок</h2><br>
                <div style="float:right">
                <button class="operations">Изменить</button> <button class="operations">Отклонить</button>
                </div>
                <table class="bordered">
                    <thead>
                        <tr>
                            <th>№ Заявки</th>
                            <th>Дата</th>        
                            <th>Пара</th>
                            <th>Аудитория</th>
                            <th>Логин</th>
                            <th>ФИО просящего</th>
                            <th>ФИО преподавателя</th>
                            <th>Цель</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <?php 
                        $bron= get_bron($link);
                        ?>
                    <?php
                        foreach($bron as $br): ?>
                    
                    <tr>
                        <td><?=$br["№ заявки"]?></td>        
                        <td><?=$br["Дата"]?></td>
                        <td><?=$br["№ пары"]?></td>
                        <td><?=$br["№ аудитории"]?></td>
                        <td><?=$br["Логин"]?></td>
                        <td><?=$br["ФИО просящего"]?></td>
                        <td><?=$br["ФИО преподавателя"]?></td>
                        <td><?=$br["Цель"]?></td>
                        <td><?=$br["Статус"]?></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                
            </div>
        </div>
    </body>
</html>
