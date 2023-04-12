<?
require_once($_SERVER['DOCUMENT_ROOT']."/core.php");

//p($sqlConnect);

$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `history`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    $arHistory[$row['id']] = $row;
}
//p($arHistory);
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `patient`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    $arPatient[$row['id']] = $row;
}

//p($arPatient);
?>



<h2> история посещений</h2>
<table id="visits" border="1">
    <tr>
        <td>назначенный приём</td>
        <td>пациент</td>
        <td>статус посещения</td>
        <td></td>
    </tr>

    <?php
    foreach ($arHistory as $item ):
        if(strtotime($item['day_time'])<time()) $color = "grey";
        elseif(strtotime($item['day_time'])>time()) $color = "green";
        switch ($item['visit_status']) {
            case 0 : $visit_status_color = 'grey'; break;
            case 1 : $visit_status_color = 'green'; break;
            case 2 : $visit_status_color = 'red'; break;
        }
        ?>
            <tr style="color:<?=$color?>">
                <td><strong><?=$item['day_time']?></strong></td>
                <td><?=$item['patient_id']?></td>
                <td style="background:<?=$visit_status_color?>"><?=$visit_status[$item['visit_status']]?></td>
                <td><a href="">редактировать</a></td>
            </tr>
    <?endforeach;?>

</table>

<!--TODO назначить атрибут style td статус посещения стр 36-->
<?
p($_GET);
if (isset($_GET['code'])) {
    $sqlResult = mysqli_query($sqlConnect, "SELECT * FROM `history` WHERE `id`=".$_GET['id']);
    while($row = mysqli_fetch_assoc($sqlResult)) {
        $redact = $row;
    } ?>
    <form method="post" id="redact">
        <h2>Редактировать</h2>
        <div>
            <label for="visit_id">статус посещения</label>
            <input type="text" id="visit_status" name="visit_status" value="<?=$redact['visit_id']?>">
        </div>
        <div>
            <input type="submit" name="red" value="принять">
        </div>
    </form>
    <?
    p($_POST);
    if(isset($_POST['принять'])) {
        $red =  mysqli_query($sqlConnect,"UPDATE `history` SET
            `visit_id` = '".$_POST['visit_status']."'
            WHERE `id`=".$_GET['id']);
            p("данные успешно изменены");
    }
    else {
        p("ошибка редакции");
    }

}
//
//?>
<?//if($visit_status[$item['visit_status']]='неявка'):?>
