<pre><?
$digit = 5;

// if(3>$digit){
// 	echo "true";
// }
// else {
// 	echo "false";
// }

// echo   (3>$digit ? "true" : "false <br>") ;
// echo 3>$digit ? "true" : "false" ;\
function p($text, $flag = 'pr', $FILE = '', $LINE = '') {

    if(!empty($FILE) OR !empty($LINE)) {
        echo  $FILE. (!empty($LINE) ? "(строка: ".$LINE.")" : "");                                    
    }
    switch ($flag) {
        case 'pr': print_r($text); break;
        case 'vd': var_dump($text); break;
    }
}


p('result','pr', __FILE__);

die;
// Обработка адреса
// http://test.doctor2.loc/catalog/patient/test?id=5&filter=today
p($_SERVER['REQUEST_URI'],'pr','полный относительный адрес');
p(parse_url($_SERVER['REQUEST_URI']),'pr','раздельный относительный адрес, разделы(path) и GET-переменные строкой(query)');
p($_GET, 'pr','GET-переменные в виде массива');

p($_SERVER['HTTP_HOST'],'pr','домен');
preg_match("/[a-z]+\.[a-z]+$/", $_SERVER['HTTP_HOST'], $host); // вырезает отдельно домен от поддомена
p($host);

p($_SERVER['SERVER_PROTOCOL'],'pr','протокол HTTP или HTTPS');
p(stripos($_SERVER['SERVER_PROTOCOL'], 'https') ? 'https' : 'http'); // название протокола без лишних подробностей


p($CORE);

?>
/core/routes.php - существующие на сайте адреса
/core/index.php - добавился анализ адреса
/core/dev - папка шаблонов, содержащая файл с header,footer и блоки разделов
/index.php - поиск адреса и формирование страницы 