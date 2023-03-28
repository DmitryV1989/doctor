<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core.php");

//$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `history`");
//while($row = mysqli_fetch_assoc($sqlResult)) {
//    $arHistory[$row['id']] = $row;
//}

$arHistory = [];
$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `history`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    list($row['date'],$row['time']) = explode(" ", $row['day_time']);
//    unset($row['day_time']);
    $arHistory[$row['id']] = $row;

}

?>

<!-- Альтернативное решение-->
<table id="visits" border="1">
    <tr>
        <td>назначенный приём</td>
        <td>пациент</td>
    </tr>
    <? foreach ($arHistory as $item ):if($item['patient_id']==0) continue;
        list($date1,$time) = explode(" ", $item['day_time']);
        $date2 = date("Y-m-d");
        if($date1<$date2) $color = "grey";
        elseif($date1>$date2) $color = "green";
        elseif($date1==$date2) $color = "red"
        ?>
        <tr>
            <td>
                <div style = "color:<?=$color?>""><?=$item['day_time']?></div>
            </td>
            <td>
                <div><?=$item['patient_id']?></div>
            </td>
        </tr>
    <? endforeach; ?>
</table>



<?php

