<? 
# Подключение ядра сайта
require_once($_SERVER['DOCUMENT_ROOT']."/core/boot/index.php");
p($CORE);
// // роутер
// $CORE['CURRENT']['SECTION'] = array_key_exists($CORE['URL']['PATH'], $CORE['ROUTES']) ? $CORE['ROUTES'][$CORE['URL']['PATH']] : ['404'];
// // p($CORE);
// // формируем страницу с буферизацией
// ob_start(); 
// require_once($_SERVER['DOCUMENT_ROOT']."/core/templates/index.php");
// $page = ob_get_contents();
// ob_end_clean();
// $page = mb_convert_encoding($page, "UTF-8");
// echo $page;

