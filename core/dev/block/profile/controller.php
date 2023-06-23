<?
// заглушка если пользователь не выбран
if(empty($_GET['id']) AND empty($_GET['history_id'])) {
    require_once($_SERVER['DOCUMENT_ROOT'])."/core/dev/block/profile/template_nouser.php";
    die;
}

// создание записи посещения
if(isset($_POST['appointment'])){
    $day_time = str_replace('.','-',$_POST['date']).' '.$_POST['time'];
    $status_match = false;
    $sqlResult=mysqli_query($CORE['CONFIG']['DB'],"SELECT `day_time` FROM `history`");
    while ($row = mysqli_fetch_assoc($sqlResult)) {
        if(strtotime($day_time)==strtotime($row['day_time'])) {
            p('выберите другое время');
            $status_match = true;
            break;
        }
    }
    if(!$status_match){
        $history = mysqli_query($CORE['CONFIG']['DB'],"INSERT INTO `history` VALUES (
	                0,                             
	                '".check($day_time)."',
	                '".check($_POST['patient_id'])."',
	                '".check($_POST['reason'])."',
	                0,
	                '".check($_POST['survey'])."',
	                '".check($_POST['resume'])."',
	                NOW()
	            );");
        p("<div>Приём назначен <span class=\"count-hide\">(перезагрузка через: <span class=\"digit\"></span>)</span></div>");
        header("Refresh:".$CORE['LIST']['refresh']);
    }
}

if(!empty($_POST['edit_appoint'])) {
    $sqlResult = mysqli_query($CORE['CONFIG']['DB'], "UPDATE `history` SET
    `reason` = '".check($_POST['reason'])."',   
    `survey` = '".check($_POST['survey'])."',
    `resume` = '".check($_POST['resume'])."',
    `visit_status` = '".check($_POST['visit_status'])."'
    WHERE `id` = " . $_GET['history_id']);
    header("Location: /profile?id=".$_POST['patient_id']);
}

// редактирование записи посещения
if(!empty($_GET['code']) && $_GET['code'] == 'edit_appoint') {
    $sqlResult = mysqli_query($CORE['CONFIG']['DB'], "SELECT * FROM `history` WHERE `id`= " . $_GET['history_id']);
    while ($row = mysqli_fetch_assoc($sqlResult)) {
        $arHistory = $row;
    }

    $sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `patient` WHERE `id`=".$arHistory['patient_id']);
    while ($row = mysqli_fetch_assoc($sqlResult)) {
        foreach (scandir($_SERVER['DOCUMENT_ROOT'] . $CORE['CONFIG']['PATIENT_PHOTO_PATH']) as $filename) {
            if (explode('.',$filename)[0] == $arHistory['patient_id']) {
                $row['patient_photo'] = $CORE['CONFIG']['PATIENT_PHOTO_PATH']. $filename;
                break;
            }
        }
        $arPatient = $row;
    }
    require_once($_SERVER['DOCUMENT_ROOT'])."/core/dev/block/profile/template_edit.php";
    die;
}

// фильтрация входных данных
$CORE['CURRENT']['USER_ID'] = (int)$_GET['id']; // приведение к типу integer

// запрос данных конкретного пациента
$sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `patient` WHERE `id`=".$CORE['CURRENT']['USER_ID']);
while($row = mysqli_fetch_assoc($sqlResult)) {
    // преобразование пола
    $row['sex'] = $CORE['LIST']['sex'][$row['sex']];

    // поиск фотографии пациента
    // первый способ поиска фото. Применяется при отсутствии конвертации расширения в png
    foreach (scandir($_SERVER['DOCUMENT_ROOT'] . $CORE['CONFIG']['PATIENT_PHOTO_PATH']) as $filename) {
        if (explode('.',$filename)[0] == $CORE['CURRENT']['USER_ID']) {
            $row['patient_photo'] = $CORE['CONFIG']['PATIENT_PHOTO_PATH']. $filename;
            break;
        }
    }
    /* второй способ поиска фото. Применяется только при конвертации расширения в png
    $patient_photo = $CORE['CONFIG']['PATIENT_PHOTO_PATH'] . $CORE['CURRENT']['USER_ID'] . '.png';
    $row['patient_photo'] = file_exists($_SERVER['DOCUMENT_ROOT'] . $patient_photo) ? $patient_photo : "";
    */

    // формирование результата
    $arPatient = $row;
}

// формирование истории посещений пациента
$arHistory = []; // предопределяем переменную, на случай если история посещений пустая
$sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `history` WHERE `patient_id`=".$arPatient['id']);
while($row = mysqli_fetch_assoc($sqlResult)) {
    list($row['date'],$row['time']) = explode(" ", $row['day_time']);
//    unset($row['day_time']);
    $row['present'] = $CORE['LIST']['present'][(strtotime($row['day_time'])<time() ? 0 : 1)];
    $row['visit_status'] = $CORE['LIST']['visit_status'][$row['visit_status']];
    $arHistory[$row['id']] = $row;
}

// интервал дней приёма
$period = new DatePeriod(
    new DateTime($CORE['LIST']['day']['start']), 
    new DateInterval($CORE['LIST']['day']['step']), 
    new DateTime($CORE['LIST']['day']['count']) 
);

// интервал времени приёма
// сократить запись $CORE['LIST']['time']
while($CORE['LIST']['time']['work']['start'] < $CORE['LIST']['time']['work']['end']) {
    $t = strtotime($CORE['LIST']['time']['interval'], $CORE['LIST']['time']['work']['start']);
    if ($CORE['LIST']['time']['work']['start'] >= $CORE['LIST']['time']['break']['start'] & $CORE['LIST']['time']['work']['start'] < $CORE['LIST']['time']['break']['end']) {
        $CORE['LIST']['time']['work']['start'] = $t;
        continue;
    }
    $work_time_interval[] = date("H:i", $CORE['LIST']['time']['work']['start']);
    $CORE['LIST']['time']['work']['start'] = $t;
}

// подключение шаблона блока                
require_once($_SERVER['DOCUMENT_ROOT'])."/core/dev/block/profile/template.php";
?>
<script>
    function countDownElTimer(countDown, digitEl = ".digit", hideEl = ".count-hide", speed = 1000) {
        let closeTimer,
            counterLabel = document.querySelector(digitEl);
        counterLabel.innerHTML = countDown--;
        closeTimer = setInterval(function() {
            if(countDown == 0) {
                document.querySelector(hideEl).style.display = "none";
                clearInterval(closeTimer);
            }
            counterLabel.innerHTML = countDown;
            countDown--;
        }, speed);
    }
    if(document.querySelector('.digit')) {
        countDownElTimer(<?=$CORE['LIST']['refresh']?>);
    }
</script>