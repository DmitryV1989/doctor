<div id="profile_patient">
	<h1>Пациент: Дмитрий</h1>
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
	<form method="post" id="app">
	    <div class="field_area">
	        <label for="date">дата приёма</label>
	        <select name="date" id="date">
	            <? foreach ($period as $value): ?>
	                <option><?=$dates[] = $value->format('Y.m.d')?></option>
	            <? endforeach; ?>
	        </select>
	    </div>
	    <div class="field_area">
	        <label for="time">время приёма</label>
	        <select name="time" id="time">
	            <? foreach ($work_time_interval as $another_time): ?> 
	            	<option><?=$another_time?></option>
	            <? endforeach; ?>	
	        </select>
	    </div>
	    <div class="field_area">
	        <label for="reason">причина обращения</label>
	        <input type="text" id="reason" name="reason" class="field">
	    </div>

	    <div class="field_area">
	        <label for="survey">лечение</label>
	        <textarea name="survey" id="survey" cols="30" rows="10" class="field"></textarea>
	    </div>
	    <div class="field_area">
	        <label for="survey">результат</label>
	        <textarea id="resume" name="resume" cols="30" rows="10" class="field"></textarea>
	    </div>
	    <div class="field_area">
	        <input type="hidden" name="patient_id" value="<?=$arPatient['id']?>" required>
	        <input type="submit" name="make" value="назначить" class="field">
	    </div>
	</form>
	<?
	if(isset($_POST['make'])){
	    $day_time = str_replace('.','-',$_POST['date']).' '.$_POST['time'];
	    $status_match = false;
	    $sqlResult=mysqli_query($sqlConnect,"SELECT `day_time` FROM `history`");
	    while ($row = mysqli_fetch_assoc($sqlResult)) {
	        if(strtotime($day_time)==strtotime($row['day_time'])) {
	            p('выберите другое время');
	            $status_match = true;
	            break;
	        }
	    }
	    if(!$status_match){
	        $history = mysqli_query($sqlConnect,"INSERT INTO `history` VALUES (
	                0,
	                '".$day_time."',
	                '".$_POST['patient_id']."',
	                '".$_POST['reason']."',
	                0,
	                '".$_POST['survey']."',
	                '".$_POST['resume']."',
	                NOW()
	            );");
	        ?><meta http-equiv="refresh" content="2; url=/history.php" /><?
	        p("приём назначен");
	    }
	}    
	?>
	<table id="history" border="1">
		<tr>
			<th colspan="6">История посещений пациента: Дмитрий</th>
		</tr>
	    <tr>
	        <td>Дата посещения</td>
	        <td>Время посещения</td>
	        <td>Причина посещения</td>
	        <td>Назначенное лечение</td>
	        <td>Результат лечения</td>
	        <td>Дата создания заявки</td>
	    </tr>
	    <? foreach ($arHistory as $value): ?>
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
</div>
