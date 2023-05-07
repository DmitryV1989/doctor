<?

// обработка адреса
// http://test.doctor2.loc/catalog/patient/test?id=5&filter=today
preg_match("/[a-z0-9\-]+\.[a-z]+$/", $_SERVER['HTTP_HOST'], $host); // регулярное выражение, вырезающее домен от поддомена
$CORE['URL']['PROTOCOL'] = stripos($_SERVER['SERVER_PROTOCOL'], 'https') ? 'https' : 'http'; // протокол
$CORE['URL']['DOMAIN'] = $host[0]; // только домен 
$CORE['URL']['SUBDOMAIN'] = $_SERVER['HTTP_HOST']; // домен с возможным поддоменом
$CORE['URL']['FULL'] = $CORE['URL']['PROTOCOL'] . "://" . $CORE['URL']['DOMAIN'] . $_SERVER['REQUEST_URI']; // адрес полностью
$CORE['URL']['REQUEST_URI'] = $_SERVER['REQUEST_URI']; // относительный адрес с GET-переменными
$parse_url = parse_url($_SERVER['REQUEST_URI']); // дробление относительного адреса
$CORE['URL']['PATH'] = $parse_url['path']; // относительный адрес без GET-переменных
$CORE['URL']['SECTION'] = array_filter(explode("/", $CORE['URL']['PATH'])); // список разделов в виде массива
if(isset($parse_url['query'])) $CORE['URL']['QUERY'] = $parse_url['query']; // GET-переменные строкой из адреса
$CORE['URL']['GET'] = $_GET; // GET-переменные в виде массива из своего суперглобального массива

// маршруты
$CORE['ROUTES'] = require_once($_SERVER['DOCUMENT_ROOT']."/core/routes.php");

// подключение конфигурации сайта
$CORE['CONFIG'] = require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");

// управление отображением ошибок
ini_set('display_errors', $CORE['CONFIG']['DEV_MODE']);

// вспомогательные функции
require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

// список. Вспомогательная информация
$CORE['LIST'] = require_once($_SERVER['DOCUMENT_ROOT']."/core/list.php");

// подключение к БД
$CORE['CONFIG']['DB'] = mysqli_connect(
    $CORE['CONFIG']['DB']['server'],
    $CORE['CONFIG']['DB']['user'],
    $CORE['CONFIG']['DB']['password'],
    $CORE['CONFIG']['DB']['name']
);
mysqli_set_charset($CORE['CONFIG']['DB'],'utf8');

?>