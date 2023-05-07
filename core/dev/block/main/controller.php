<?
// история посещений
$sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `history`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    // Преобразуем статус посещения
    $row['visit_status'] = $CORE['LIST']['visit_status'][$row['visit_status']];
    //  Если дата посещения ($row['day_time']) состоялась в прошлом, до нынешнего дня (time()), то эта дата подсвечивается чёрным цветом, если в будущем, то зелёным 
    $row['present'] = $CORE['LIST']['present'][(strtotime($row['day_time'])<time() ? 0 : 1)];
    // Формирование массива "история посещений"
    $arHistory[$row['id']] = $row;
}

// библиотека пациентов
$sqlResult = mysqli_query($CORE['CONFIG']['DB'],"SELECT * FROM `patient`");
while($row = mysqli_fetch_assoc($sqlResult)) {
    // Преобразование пола
    $row['sex'] = $CORE['LIST']['sex'][$row['sex']];
    // Формирование массива "библиотека пациентов"
    $arPatient[$row['id']] = $row;
}

// подключение шаблона блока
require_once($_SERVER['DOCUMENT_ROOT'])."/core/dev/block/main/template.php";
?>

