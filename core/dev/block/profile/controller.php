<?
// заглушка если пользователь не выбран
if(empty($_GET['id'])) {
    require_once($_SERVER['DOCUMENT_ROOT'])."/core/dev/block/profile/template_nouser.php";
    die;
}

// фильтрация входных данных
$CORE['CURRENT']['USER_ID'] = (int)$_GET['id']; // приведение к типу integer

// запрос данных конкретного пациента
$sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `patient` WHERE `id`=".$CORE['CURRENT']['USER_ID']);
while($row = mysqli_fetch_assoc($sqlResult)) {
    $row['sex'] = $CORE['LIST']['sex'][$row['sex']];
    $arPatient = $row;
}

// формирование истории посещений пациента
$arHistory = []; // предопределяем переменную, на случай если история посещений пустая
$sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `history` WHERE `patient_id`=".$arPatient['id']);
while($row = mysqli_fetch_assoc($sqlResult)) {
    list($row['date'],$row['time']) = explode(" ", $row['day_time']);
    unset($row['day_time']);
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