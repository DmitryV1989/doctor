<?php
require_once($_SERVER['DOCUMENT_ROOT']."/core.php");

$sqlResult = mysqli_query($sqlConnect,"SELECT * FROM `patient`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    $arPatient[$row['id']] = $row;
}

?>
<h1>Регистратура</h1>
<form method="post" id="new_patient">
    <h2>Карта пациента</h2>
    <div>
        <label for="patient_name">Имя</label>
        <input type="text" id="patient_name" name="patient_name">
    </div>
    <div>
        <label for="pers_numb">Номер полиса</label>
        <input type="text" id="pers_numb" name="pers_numb">
    </div>
    <div>
        <label for="birth">Дата рождения</label>
        <input type="date" id="birth" name="birth">
    </div>
    <div>
        <h3 style="color:blue">Пол</h3>
            <input type="radio" name="sex" value="1" id="sex1">
            <label for="sex1">мужской</label>
            <input type="radio" name="sex" value="2" id="sex2">
            <label for="sex2">женский</label>
    </div>
    <div>
        <input type="submit" name="save" value="внести запись">
    </div>
</form>

<?php
//p($_POST);
if(isset($_POST['save'])) {
    $name = check($_POST['patient_name']);
    $sqlResult = mysqli_query($sqlConnect,"INSERT INTO `patient` VALUES (
		0,
		'".$name."',
		'".$_POST['pers_numb']."',
		'".$_POST['birth']."',
		'".$_POST['sex']."',
		NOW()
	);");
    if($sqlResult){
        header("Location: /patient_list.php");
    }
    else {
        p("запись не внесена");
    }
//    p($sqlResult ? "запись внесена  ".$sqlConnect->insert_id : "запись не внесена");
}

?>
<h2>Банк данных</h2>
<table id="library" border="1">
    <tr>
        <td>id</td>
        <td>имя</td>
        <td>номер полиса</td>
        <td>пол</td>
        <td>дата рождения</td>
    </tr>
    <? foreach ($arPatient as $item ): ?>
    <tr>
        <td><?=$item['id']?></td>
        <td><a href="/patient_profile.php?id=<?=$item['id']?>"><?=$item['name']?></a></td>
        <td><?=$item['pers_numb']?></td>
        <td><?=$sex[$item['sex']]?></td>
        <td><?=$item['DOB']?></td>
        <td><a href="/patient_list.php?id=<?=$item['id']?>&code=edit">редактировать</a></td>
        <td><a href="/patient_list.php?id=<?=$item['id']?>&code=delete">удалить</a></td>
<!--        при переходе по ссылке мы попадаем на ту же страницу, на которой находимся, при этом появляется новая функция-->
<!--        для работы с уже созданной картой пациента: редактирование или удаление, зависит от нажатой ссылки-->
<!--        в этот же момент появляется и заполняется переменная $_GET, необходимая для редактирования/удаления-->
    </tr>
    <? endforeach; ?>
</table>

<!--содержимое переменной $_GET - массив с двумя ключами:-->
<!--id - идентификатор записи из таблицы пациентов (patient);-->
<!--code - "код" ссылки (не адрес!), т.е. слово по которому нужно кликнуть для перехода на новую страницу-->


<?php
//p($_GET);

    if (isset($_GET['code']))  { // проверка существования переменной с определённым ключом
        switch ($_GET['code']) { // запуск переключателя выбора (switch - это оператор переключения)
            case 'edit' : { // при нажатии на "редактировать":
                $sqlResult = mysqli_query($sqlConnect, "SELECT * FROM `patient` WHERE `id`=".$_GET['id']);
                while($row = mysqli_fetch_assoc($sqlResult)) {
                    $editor = $row;
                }
                // запрос SELECT(чтение) в таблицу "patient" по конкретному id, который присваивается из $_GET
//                p($editor);
?>
                <form  method="post" id="editor">
                    <h2>Редактировать</h2>
                    <div>
                        <label for="patient_name">Имя</label>
                        <input type="text" id="patient_name" name="patient_name" value="<?=$editor['name']?>">
                    </div>
                    <div>
                        <label for="pers_numb">Номер полиса</label>
                        <input type="text" id="pers_numb" name="pers_numb" value="<?=$editor['pers_numb']?>">
                    </div>
                    <div>
                        <label for="birth">Дата рождения</label>
                        <input type="date" id="birth" name="birth" value="<?=$editor['DOB']?>">
                    </div>
                    <div>
                        <h3 style="color:blue">Пол</h3>
                        <input type="radio" name="sex" value="1" id="sex1"<?=($editor['sex']==1)?' checked':''?>>
                        <label for="sex1">мужской</label>
                        <input type="radio" name="sex" value="2" id="sex2"<?=($editor['sex']==2)?' checked':''?>>
                        <label for="sex2">женский</label>
                    </div>
                    <div>
                        <input type="submit" name="edit" value="подтвердить изменения">
                    </div>
                </form>
<!--конструкция редактирования идентична конструкции создания, изменить можно любое поле, -->
<!--в которое данные заносятся вручную-->
                <?php
                p($_GET);
                if (isset($_GET['edit'])) {
                   $update = mysqli_query($sqlConnect,"UPDATE `patient` SET 
                     `name`='".$_POST['patient_name']."', 
                     `pers_numb`='".$_POST['pers_numb']."', 
                     `DOB`='".$_POST['birth']."', 
                     `sex`='".$_POST['sex']."' 
                    WHERE `id`=".$_GET['id']);
                   if($update) {
                       ?><meta http-equiv="refresh" content="1; url=/patient_list.php" /><?
                       p("Изменения внесены");
                   }
                   else {
                       p("ошибка редакции");
                   }
                }
            } break;
            case 'delete' :
            {  // при нажатии на "удалить":
                $delete = mysqli_query($sqlConnect, "DELETE FROM `patient` WHERE `id`=".$_GET['id']);
                    if($delete){
                        $sqlResult = mysqli_query($sqlConnect, "UPDATE `history` SET 
                     `patient_id`=0
                        WHERE `id`=".$_GET['id']);
                        ?><meta http-equiv="refresh" content="1; url=/patient_list.php" /><?
                        p("данные пациента удалены");
                    }
                // запрос DELETE (удаление)
            } break;
        }
    }
  // todo: расписать действия скрипта              ?>




