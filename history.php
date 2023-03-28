<?
require_once($_SERVER['DOCUMENT_ROOT']."/core.php");

//p($sqlConnect);

$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `history`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    $arHistory[$row['id']] = $row;
}

?>

<table id="history" border="2">
    <tr>
        <td>id</td>
        <td>приём</td>
        <td>пациент</td>
        <td>дата создания</td>
    </tr>
    <? foreach ($arHistory as $item ): ?>
        <tr>
            <td><?=$item['id']?></td>
            <td><?=$item['day_time']?></td>
            <td><?=$item['patient_id']?></td>
            <td><?=$item['created_at']?></td>
        </tr>
    <? endforeach; ?>
</table>
<form method="post" id="app">
    <h2>Назначить время приёма</h2>
        <label for="day_time">время приёма</label>
        <select name="day_time" id="day_time">
            <? foreach ($arHistory as $item ):if($item['patient_id']==0) continue; ?>
                <option value="<?=$item['id']?>"><?=$item['day_time']?></option>
            <? endforeach; ?>
        </select>
    </div>
    <div>
        <label for="patient">ваше имя</label>
        <input type="text" id="patient" name="patient" required>
    </div>
</form>

<h2> история посещений</h2>
<table id="visits" border="1">
    <tr>
        <td>назначенный приём</td>
        <td>пациент</td>
    </tr>
    <? foreach ($arHistory as $item ):if($item['patient_id']==0) continue;
        if(strtotime($item['day_time'])<time()) $color = "grey";
        elseif(strtotime($item['day_time'])>time()) $color = "green";
        ?>
            <tr>
                <td>
                    <div><strong style="color:<?=$color?>"><?=$item['day_time']?></div>
                </td>
                <td>
                   <div><?=$item['patient_id']?></div>
                </td>
            </tr>
    <? endforeach; ?>
</table>

