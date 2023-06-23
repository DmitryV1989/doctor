<div id="reg_patient">
	<h1>Редактирование пациента</h1>
    <h2>Пациент: <?=$arPatient['name']?></h2>
    <img src="<?=$arPatient['patient_photo']?>" alt="">
	<form method="post" id="new_patient" enctype="multipart/form-data">
		<div class="field_area">
	    	<label for="photo">Фото пациента (не меньше 100х100)</label>
	    	<input type="file" id="photo" name="patient_photo" class="field" accept="image/*">       
    	</div>
	    <div class="field_area">
	        <label for="patient_name">Имя</label>
	        <input type="text" id="patient_name" name="patient_name" class="field" value="<?=$arPatient['name']?>">
	    </div>
	    <div class="field_area">
	        <label for="pers_numb">Номер полиса</label>
	        <input type="text" id="pers_numb" name="pers_numb" class="field" value="<?=$arPatient['pers_numb']?>">
	    </div>
	    <div class="field_area">
	        <label for="birth">Дата рождения</label>
	        <input type="date" id="birth" name="birth" class="field" value="<?=$arPatient['DOB']?>">
	    </div>
	    <div class="field_area">
	        <h3 style="color:blue">Пол</h3>	        
            <input type="radio" name="sex" value="1" id="sex1"<?=$arPatient['sex'] == 1 ? " checked" : ""?>>
            <label for="sex1" class="inline">мужской</label>
            <input type="radio" name="sex" value="2" id="sex2"<?=$arPatient['sex'] == 2 ? " checked" : ""?>>
            <label for="sex2" class="inline">женский</label>
	    </div>
	    <div class="field_area">
	    	<?//=(isset($_SESSION['MESSAGE'])? $_SESSION['MESSAGE'] : '')?>
	    	
	    	<input type="hidden" value="edit_patient" name="CODE">
	        <input type="submit" name="save" value="внести запись" class="field">
	    </div>

	</form>
</div>
