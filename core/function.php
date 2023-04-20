<?
/*
форматированный вывод массива, строки или числа
p($text, 'pr', __FILE__, __LINE__);
*/
function p($text, $flag = 'pr', $FILE = '', $LINE = '') {
    global $CORE;
    // если режим разработки выключен (DEV_MODE в значении ноль), то дебаг не будет работать
    if(!$CORE['CONFIG']['DEV_MODE']) return false;
	echo "<pre style=\"white-space: pre-wrap; background:#ececec;padding:10px;margin:10px 0;\">";
    if(!empty($FILE) AND !empty($LINE)) {
        echo "<div style='background: #98c5f3; padding: 5px; margin-bottom: 5px;'>".$FILE." (строка: ".$LINE.")</div>";
    }
    switch ($flag) {
        case 'pr': print_r($text); break;
        case 'vd': var_dump($text); break;
    }
	echo "</pre>";
}



?>