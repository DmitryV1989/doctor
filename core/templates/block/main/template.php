<div id="main">
	<h1>Главная</h1>
	<table id="visits" border="1">
		<tr>
			<th colspan="4">История всех приёмов</th>
		</tr>
	    <tr>
	        <td>назначенный приём</td>
	        <td>пациент</td>
	        <td>статус посещения</td>
	        <td></td>
	    </tr>
	    <? foreach ($arHistory as $item): ?>
	 	<tr style="color:<?=$item['present']?>">
            <td><strong><?=$item['day_time']?></strong></td>
            <td><a href="/profile?id=<?=$item['patient']['id']?>"><?=$item['patient']['name']?></a></td>
            <td style="background:<?=$item['visit_status']['color']?>"><strong><?=$item['visit_status']['label']?></strong></td>
            <td><a href="/profile?history_id=<?=$item['id']?>&code=edit_appoint">редактировать</a></td>
        </tr>
		<? endforeach; ?>
	</table>	

	<table id="library" border="1">
		<tr>
			<th colspan="7">Библиотека пациентов</th>
		</tr>
	    <tr>
	        <td>id</td>
	        <td>имя</td>
	        <td>номер полиса</td>
	        <td>пол</td>
	        <td>дата рождения</td>
	        <td colspan="2"></td>
	    </tr>
	    <? foreach ($arPatient as $item ): ?>
		<tr>
	        <td><?=$item['id']?></td>
	        <td><a href="/profile?id=<?=$item['id']?>"><?=$item['name']?></a></td>
	        <td><?=$item['pers_numb']?></td>
	        <td><?=$item['sex']?></td>
	        <td><?=$item['DOB']?></td>
	        <td><a href="/reg?id=<?=$item['id']?>&code=edit">редактировать</a></td>
	        <td><a href="/reg?id=<?=$item['id']?>&code=delete">удалить</a></td>

	    </tr>
	    <? endforeach; ?>
	</table>
</div>