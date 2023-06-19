<?

/*
форматированный вывод массива, строки или числа

Образец вызова:
p($text, 'pr', __FILE__, __LINE__);

Список параметров:
$text (mixed) - значение для дебага
$flag (string) - выбор чем выводить значение первого аргумента (принимает значения: 'pr' - print_r(), 'vd' - var_dump())
$FILE ( __FILE__) - магическая константа в которой путь к файлу, в котором вызывается функция
$LINE (__LINE__) - магическая константа в которой номер строки, на которой вызвана функция
*/
function p($text, $flag = 'pr', $FILE = '', $LINE = '') {
    global $CORE;
    // если режим разработки выключен (DEV_MODE в значении ноль), то дебаг не будет работать
    if(!$CORE['CONFIG']['DEV_MODE']) return false;
	echo "<pre style=\"white-space: pre-wrap; background:#ececec;padding:10px;margin:10px 0;\">";
    if(!empty($FILE) OR !empty($LINE)) {
        $line = !empty($LINE) ? " (строка: ".$LINE.")" : "";
        echo "<div style='background: #98c5f3; padding: 5px; margin-bottom: 5px;'>".$FILE.$line."</div>";                                    
    }
    switch ($flag) {
        case 'pr': print_r($text); break;
        case 'vd': var_dump($text); break;
    }
	echo "</pre>";
}

// подключает блоки раздела
function content() {
    global $CORE;
    foreach ($CORE['CURRENT']['SECTION'] as $block) {
        require_once($_SERVER['DOCUMENT_ROOT'] . "/core/dev/block/".$block."/controller.php");
    }
}

function check($field) {
    return htmlspecialchars(trim(stripcslashes($field)));
}

function new_image_create($image_path, $source_width, $source_height, $ready_width, $ready_height, $file_type) {
    switch ($file_type) {
        case 'image/jpeg': {
            $source = @imagecreatefromjpeg($image_path);
        } break;       
        case 'image/png': {
            $source = @imagecreatefrompng($image_path);
        } break;
    }
    // создание нового пустого холста
    $image = @imagecreatetruecolor($ready_width, $ready_height);
    // наложение временной картинки на пустой холст
    @imagecopyresampled($image, $source, 0, 0, 0, 0, $ready_width, $ready_height, $source_width, $source_height);
    // создание пересобранного файла
    switch ($file_type) {
        case 'image/jpeg' : {
            return @imagejpeg($image, $image_path);                
        } break;         
        case 'image/png' : {
            return @imagepng($image, $image_path);       
        } break;
    }
}

function prop_resize_min($source_width, $source_height, $limit_width, $limit_height) {
    if($source_width >= $source_height) {
        $ratio = $source_width / $source_height;
        $ratio_width = $source_width / $limit_width;
        $ready_width = round($source_width / $ratio_width);
        $ready_height = round($ready_width / $ratio);
    }
    elseif($source_height > $source_width) {
        $ratio = $source_height / $source_width;
        $ratio_height = $source_height / $limit_height;
        $ready_height = round($source_height / $ratio_height);
        $ready_width = round($ready_height / $ratio);
    }  
    return [
        "width" => $ready_width,
        "height" => $ready_height
    ];
}






?>