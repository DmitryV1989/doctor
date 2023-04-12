<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core.php");

$start = '10:00';
$end = '19:00';
$break_time_start = '12:00';
$break_time_end  = '13:00';


$st = strtotime($start);
$et = strtotime($end);

while ($st < $et) {
//    p($st . " / " . date("+H:i", $st));
    if ($st >= strtotime($break_time_start)&$st<strtotime($break_time_end))break;
    $t = strtotime("+30 minute", $st);
//    break;
    p("очередное время: " . date("H:i", $st)." / ".$st);
    $st = $t;




}
?>



<div>
    <label for="time">время приёма</label>
    <select name="time" id="time">
        <?
//        while($st < $et) {
////            if($st>=strtotime($break_time_start)&$st<strtotime($break_time_end)) continue;
//            $t = strtotime("+30 minute", $st);?>
<!--            <option value="">--><?php //=date("H:i", $st)?><!--</option>-->
<!--            --><?// $st = $t;
//        }
        ?>
    </select>
</div>
<?

?>
<?php
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `history`");
while($row = mysqli_fetch_assoc($sqlResult)) {
$arHistory[$row['id']] = $row;
}
?>

<h2> история посещений</h2>
<table id="visits" border="1">
    <tr>
        <td>назначенный приём</td>
        <td>пациент</td>
        <td>статус посещения</td>
    </tr>
    <? foreach ($arHistory as $item ):
        if(strtotime($item['day_time'])<time()) $color = "grey";
        elseif(strtotime($item['day_time'])>time()) $color = "green";
        elseif($item['visit_id']==3) $color = "red";
        ?>
        <tr>
            <td>
                <div><strong style="color:<?=$color?>"><?=$item['day_time']?></div>
            </td>
            <td>
                <div><?=$item['patient_id']?></div>
            </td>
            <td contentEditable='true' class='edit' id='redact'>
                <div><?=$item['visit_id']?></div>
            </td>
        </tr>
    <? endforeach; ?>
</table >



<?php
p($_GET);
die;
$field= $_POST['field'];
$value = $_POST['value'];
$id = $_POST['id'];


//делаем запрос на обновление строки
$query = "UPDATE `mytable` SET `".$field."`='".$value."' WHERE `id`=".$id;
mysqli_query($arHistory,$query);


//<!--<label for="day_time">время приёма</label>-->
//<!--<select name="day_time" id="day_time">-->
//<!--    --><?// foreach ($arHistory as $item ):if($item['patient_id']!=0) continue; ?>
<!--<!--        <option value="-->--><?php ////=$item['day_time']?><!--<!--">-->--><?php ////=$item['day_time']?><!--<!--</option>-->-->
<!--<!--    -->--><?//// endforeach; ?>
<!--<!--</select>-->-->
<!--<!--</div>-->-->
<!--<!--<div>-->-->
<!--<!--    <label for="patient">имя пациента</label>-->-->
<!--<!--    <select name="patient_id" id="patient_id">-->-->
<!--<!--        -->--><?//// foreach ($arPatient as $item ): ?>
<!--<!--            <option>-->--><?php ////=$item['id']?><!--<!--</option>-->-->
<!--<!--        -->--><?//// endforeach; ?>
<!--<!--    </select>-->-->
<!--<!--</div>-->-->