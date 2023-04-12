<?php
require_once($_SERVER['DOCUMENT_ROOT'] . "/core.php");


$check_time = new schedule;
p($check_time->getTime());


?>
<form method="post" id="app">
    <h2>Назначить приём</h2>
    <div>
        <label for="time">время приёма</label>
        <select name="time" id="time">

                <option><?=$check_time->getTime(1)?></option>

            ?>
        </select>
    </div>
</form>
while($row = mysqli_fetch_assoc($sqlResult)) {
$arPatient[$row['id']] = $row;
}