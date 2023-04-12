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
        <td><?=$sex[$arPatient['sex']]?></td>
        <td><?=$arPatient['DOB']?></td>
    </tr>
</table>

<?php
$period = new DatePeriod(
    new DateTime('+1 Day'),
    new DateInterval('P1D'),
    new DateTime('+7 Day')
);

$start = '10:00';
$end = '19:00';
$st= strtotime($start);
$et = strtotime($end);

?>

<form method="post" id="app">
    <h2>Назначить приём</h2>
    <div>
        <label for="date">дата приёма</label>
        <select name="date" id="date">
            <?foreach ($period as $value): ?>
                <option><?=$dates[] = $value->format('Y.m.d')?></option>
            <? endforeach; ?>
        </select>
    </div>
    <div>
        <label for="time">время приёма</label>
        <select name="time" id="time">
            <?
            while($st < $et) {
                $t = strtotime("+30 minute", $st);?>
                <option><?=date("H:i", $st)?></option>
                <? $st = $t; // что здесь?
            }
            ?>
        </select>
        <!--        /TODO доделать время-->
    </div>
    <div>
        <label for="reason">причина обращения</label>
        <input type="text" id="reason" name="reason">
    </div>
    <div>
        <label for="visit_id">статус посещения</label>
        <input type="text" id="visit_id" name="visit_id">
    </div>
    <div>
        <label for="survey">лечение</label>
        <textarea name="survey" id="survey" cols="30" rows="10"></textarea>
    </div>
    <div>
        <label for="survey">результат</label>
        <textarea id="resume" name="resume" cols="30" rows="10"></textarea>
    </div>
    <div>
        <input type="hidden" name="patient_id" value="<?=$arPatient['id']?>" required>
        <input type="submit" name="make" value="назначить">
    </div>
</form>
<?
if(isset($_POST['make'])){
    $day_time = $_POST['date'].''.$_POST['time'];
    p($day_time);
    $history = mysqli_query($sqlConnect,"INSERT INTO `history` VALUES (
		0,
		'".$day_time."',
		'".$_POST['patient_id']."',
		'".$_POST['reason']."',
		'".$_POST['survey']."',
		'".$_POST['resume']."',
		NOW()
	);");
    ?><meta http-equiv="refresh" content="1; url=/history.php" /><?
    p("приём назначен");
}
?>


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
        <td><?=$value['survey']?></td>
        <td><?=$value['resume']?></td>
        <td><?=$value['created_at']?></td>

    </tr>
    <?endforeach?>
</table>
<!--LIKE "SELECT * FROM `schedule` WHERE `created_at` LIKE '2023-02-25%';-->

