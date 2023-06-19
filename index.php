<?
require_once($_SERVER['DOCUMENT_ROOT']."/core/index.php"); // ядро (движок проекта)

/*
$CORE['ROUTES']; // содержит все существующие на сайте адреса
$CORE['URL']['PATH']; // содержит текущий адрес
array_key_exists($CORE['URL']['PATH'], $CORE['ROUTES']); // проверяет есть ли текущий адрес в массиве всех адресов
// если адрес найден, то в $CORE['CURRENT']['SECTION'] нужно присвоить определённый вложенный массив из $CORE['ROUTES']
// если адрес не найден, то в $CORE['CURRENT']['SECTION'] нужно присвоить массив ['404']
*/
// определяем текущий раздел
// p($CORE);
$CORE['CURRENT']['SECTION'] = array_key_exists($CORE['URL']['PATH'], $CORE['ROUTES']) ? $CORE['ROUTES'][$CORE['URL']['PATH']] : ['404'];

// формируем страницу с буферизацией
ob_start(); 
require_once($_SERVER['DOCUMENT_ROOT']."/core/dev/index.php");
$page = ob_get_contents();
ob_end_clean();
$page = mb_convert_encoding($page, "UTF-8");
echo $page;




?>