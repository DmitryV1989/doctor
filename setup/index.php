<?php 
if(!empty($_POST)) {
	// проверяем checkbox c "режимом разработки"
	if(!isset($_POST['DEV_MODE'])) $_POST['DEV_MODE'] = 0;
	// берём образец и меняем метки на данные
	$config_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] ."/setup/config.php.example");
	foreach ($_POST as $key => $value) {
		$config_file = str_replace("@".$key."@", $value, $config_file);
	}
	// создаём и наполняем "config.php"
	file_put_contents($_SERVER['DOCUMENT_ROOT']."/core/config.php", $config_file);
	// TODO: удаляем папку "/setup" и редиректим на главную
	echo "файл успешно создан"; // будет удалено
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<style>
body {
    margin: 0;
}

.container {
    max-width: 600px;
    width: 100%;
    margin: 30px auto;
    border: 1px solid #bbb;
    padding: 15px;
    box-sizing: border-box;
}

h1 {
    margin: 0 0 15px;
    border-bottom: 2px solid #bbb;
    padding-bottom: 15px;
}

.field_area {
    margin: 10px 0;
}
.field_area label {
    display: block;
    margin-bottom: 5px;
}
.field_area .field {
    display: block;
    padding: 6px 6px 7px;
    width: 100%;
    border-radius: 2px;
    border: 1px solid #8f8f9d;
    box-sizing: border-box;
}
.field_area .btn {
    padding: 6px 16px 7px;
    cursor: pointer;
}
.field_area.inline * {
    display: inline;
    width: unset;
}

@media all and (max-width: 630px) {
	.container {
		border: 0;
		margin: 0;
		max-width: unset;
	}
}
</style>
</head>
<body>

<div class="container">
	<form method="post">
		<h1>Создание файла конфигурации</h1>
		<h2>Параметры подключения к базе данных</h2>
		<div class="field_area">
			<label for="">Сервер</label>
			<input type="text" class="field" name="DB_SERVER" value="localhost">
		</div>
		<div class="field_area">
			<label for="">Пользователь</label>
			<input type="text" class="field" name="DB_USER">
		</div>
		<div class="field_area">
			<label for="">Пароль</label>
			<input type="text" class="field" name="DB_PASSWORD">
		</div>
		<div class="field_area">
			<label for="">Название БД</label>
			<input type="text" class="field" name="DB_NAME">
		</div>
		<h2>Остальное</h2>
		<div class="field_area">
			<label for="">Папка фотографий пациентов</label>
			<input type="text" class="field" name="PATIENT_PHOTO_PATH" value="/static/images/upload/patient/">
		</div>
		<div class="field_area inline">
			<input type="checkbox" class="field" name="DEV_MODE" value="1" checked>
			<label for="">Режим разработки</label>			
		</div>
		<div class="field_area">				
			<input type="submit" class="btn" value="Создать">
		</div>
	</form>
</div>

</body>
</html>