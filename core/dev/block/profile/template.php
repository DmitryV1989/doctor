<div id="profile_patient">
	<h1>Пациент: <?=$arPatient['name']?></h1>
	<img src="<?=$arPatient['patient_photo']?>" alt="">
	
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

	<table id="history" border="1">
		<tr>
			<th colspan="6">История посещений пациента: <?=$arPatient['name']?></th>
		</tr>
	    <tr>
	        <td>Дата посещения</td>
	        <td>Время посещения</td>
	        <td>Статус посещения</td>
	        <td>Причина посещения</td>
	        <td>Назначенное лечение</td>
	        <td>Результат лечения</td>
	        <td>Дата создания заявки</td>
	    </tr>
	    <? foreach ($arHistory as $value):?>
	    <tr style="color:<?=$value['present']?>">
	        <td><?=$value['date']?></td>
	        <td><?=$value['time']?></td>
            <td style="background:<?=$value['visit_status']['color']?>"><strong><?=$value['visit_status']['label']?></strong></td>
	        <td><?=$value['reason']?></td>
	        <td><?=$value['survey']?></td>
	        <td><?=$value['resume']?></td>
	        <td><?=$value['created_at']?></td>
	    </tr>				    
	    <?endforeach?>
	</table>

    <form method="post" id="app">
        <h2>Назначение приёма</h2>
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
            <input type="submit" name="appointment" value="назначить" class="field">
        </div>
    </form>
</div>
