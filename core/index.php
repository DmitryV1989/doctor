<?

// подключение конфигурации сайта
$CORE['CONFIG'] = require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");

// управление отображением ошибок
ini_set('display_errors', $CORE['CONFIG']['DEV_MODE']);

// вспомогательные функции
require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

// список. Вспомогательная информация
$CORE['LIST'] = require_once($_SERVER['DOCUMENT_ROOT']."/core/list.php");

// подключение к БД
$CORE['DB'] = mysqli_connect(
    $CORE['CONFIG']['DB']['server'],
    $CORE['CONFIG']['DB']['user'],
    $CORE['CONFIG']['DB']['password'],
    $CORE['CONFIG']['DB']['name']
);
mysqli_set_charset($CORE['DB'],'utf8');

?>