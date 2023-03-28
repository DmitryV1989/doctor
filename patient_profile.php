<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core.php");

// TODO: если $_GET['id'] пустой, то выводить сообщение об ошибке или редирект на список пациентов


// данные конкретного пользователя
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `patient` WHERE `id`=".$_GET['id']);
while($row = mysqli_fetch_assoc($sqlResult)) {
    $arPatient = $row;
}


// история посещений
$arHistory = []; // предопределяем переменную, на случай если история посещений пустая
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `history` WHERE `patient_id`=".$arPatient['id']);
while($row = mysqli_fetch_assoc($sqlResult)) {
    list($row['date'],$row['time']) = explode(" ", $row['day_time']);
    unset($row['day_time']);
    $arHistory[$row['id']] = $row;
}


// готовая информация


?>
<!-- TODO: навести вёрстку-->


<h2>Карта пациента</h2>
<table id="patient" border="1">
    <tr>
        <td>Имя</td>
        <td>Номер полиса</td>
        <td>Пол</td>
        <td>Дата рождения</td>
    </tr>
    <tr>
        <td><?=$arPatient['name']?></td>
        <td><?=$arPatient['pers_numb']?></td>
        <td><?=$arPatient['sex']?></td>
        <td><?=$arPatient['DOB']?></td>
    </tr>
</table>

<h2>История посещений</h2>
<table id="history" border="1">
    <tr>
        <td>Дата посещения</td>
        <td>Время посещения</td>
        <td>Причина посещения</td>
        <td>Назначенное лечение</td>
        <td>Результат лечения</td>
        <td>Дата создания заявки</td>
    </tr>

    <?php
        foreach ($arHistory as $value) :
    ?>

    <tr>
        <td><?=$value['date']?></td>
        <td><?=$value['time']?></td>
        <td><?=$value['reason']?></td>
        <td><?=$value['survay']?></td>
        <td><?=$value['resume']?></td>
        <td><?=$value['created_at']?></td>

    </tr>
    <?endforeach?>
</table>
<!--LIKE "SELECT * FROM `schedule` WHERE `created_at` LIKE '2023-02-25%';-->

