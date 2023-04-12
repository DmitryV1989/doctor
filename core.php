<?php
define("CONFIG", ["DB"=>[
	"server"=>"localhost",
	"user"=>"root",
	"password"=>"",
	"name"=>"Doctor"
	]
]);

$sqlConnect = mysqli_connect(
    CONFIG['DB']['server'],
    CONFIG['DB']['user'],
    CONFIG['DB']['password'],
    CONFIG['DB']['name']
);

mysqli_set_charset($sqlConnect,'utf8');


function p($text) {
    echo "<pre style=\"white-space: pre-wrap; background:#fafafa;padding:10px;margin:10px 0;\">";
    print_r($text);
    echo "</pre>";
}


$sex = [1=>'мужской',2=>'женский'];
$visit_status =[0=>'ещё не пришло',1=>'явка',2=>'неявка'];


function SELECT($select_query, $type = "rows") {
    global $sqlConnect;
    $arList = [];
    $sqlResult = mysqli_query($sqlConnect,$select_query);
    while($row = mysqli_fetch_assoc($sqlResult)) {
        $arList[$row['id']] = $row;
    }
    if($type == "row" AND !empty($arList)){
        $arList = $arList[array_key_first($arList)];
    }
    return $arList;
}


function check($field) {
    return htmlspecialchars(trim(stripcslashes($field)));
}


class schedule {
    public static function  getTime($time = array())
    {
        $time = array(
            1  => '10:00',
            2  => '10:30',
            3  => '11:00',
            4  => '11:30',
            5  => '12:00',
            6  => '12:30',
            7  => '14:00',
            8  => '14:30',
            9  => '15:00',
            10 => '15:30',
            11 => '16:00',
            12 => '16:30',
            13 => '17:00',
            14 => '17:30',
            15 => '18:00',
            16 => '18:30'
        );
        return $time;
    }

}



?>