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





?>