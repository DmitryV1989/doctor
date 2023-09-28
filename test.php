<?
require_once($_SERVER['DOCUMENT_ROOT']."/core/boot/index.php");

// p($CORE);
// p($CORE['DB']->selectOne("SELECT * FROM `patient` WHERE `id`=3"));

// p(DB::select("SELECT * FROM `patient`","row"));
// $newPat = [6,"test1",1112,"2000-03-03",1,date('Y-m-d H:i:s')];

// $id= 7;

// $id = 15;
// $arFields = [
// 	'name'=>'test2',
// 	'pers_numb'=>1111,
// 	'birth'=>'2014-09-10',
// 	'sex'=>1
// ];




// p($CORE['PATIENT']->Create($arFields));

// $filter_fields = ['patient_id'=>2,];
// $filter_fields = ['patient_id'=>[1,2]];
// $filter_fields = ['sex'=>[1,2],'visit_status'=>1];
// $filter_fields = ['sex'=>1,'pers_numb'=>1112];

// $filter_fields = ['patient_id'=>[1,2]];
$filter_fields = ['sex'=>1];

// p($CORE['HISTORY']->Read(0, $filter_fields,"ASC"));
p($CORE['PATIENT']->Read(0,"","ASC"));

// p($CORE['PATIENT']->Read([3,4]));

// p($CORE['PATIENT']->Update($id,$arFields));

// p($CORE['PATIENT']->Delete(8));





/*
UPDATE `patient` SET `id`='[value-1]',`name`='[value-2]',`pers_numb`='[value-3]',`DOB`='[value-4]',`sex`='[value-5]',`created_at`='[value-6]' WHERE 1
*/

// p("`".implode("`,`", array_keys($arFields))."`");
// p("'".implode("', '", $arFields)."'");


// $column = [];
// foreach ($arFields as $key => $value) {
// 	// p($key);
// 	// p($value);
// 	// `name` = 'Vitaly'
// 	$column[] = "`$key`='$value'";
// }
// p(implode(",", $column));
// p($column);


// print_r(implode(",", $column)."<br>");

/*
$d = [
	['name'=>'Билли Бонс','age'=>55,'status'=>'капитан '],
	['name'=>'Джон Сильвер','age'=>50,'status'=>'квартирмейстер '],
	['name'=>'Чёрный Пёс','age'=>48,'status'=>'обычный пират']	
];

// добавление новых значений в существующий массив 
$d[0]['character'] = 'скверный';
$d[] = ['name'=>'Чёрный Пёс','age'=>48,'status'=>'обычный пират'];
p($d);
*/

/*
$a = "53763badd6f05";
p($a);
$a = preg_replace("/badd/", "-$0-", $a);
p($a);
*/

/*
ВОТ ТАК ВЫГЛЯДИТ ТЕРНАРНИК:
result = (условие) ? true : false;
*/

// $result = "";
// $arr = ['name'=>'Dmitry','age'=>19,'status'=>'admin'];
// $count = count($arr);
// $iter = 0;

// foreach ($arr as $key => $value) {
// 	$iter++;
// 	$result .= "`".$key."`='".$value."' ".($iter == $count ? "" : "AND ");
// }


/*
$result = [];
foreach ($arr as $key => $value) {
	$result[] = "`".$key."`='".$value."'";
}

p(implode(" AND ",$result));
p($result);
*/


// $key = 1;
// $value = 'true';
// $result = "`".$key."`='".$value."'AND";

/*
$arr = ['name'=>'Alex','status'=>'private'];
$id = 3;

$arr['id'] = $id;
p($arr);
*/

/*
$arr = ['status'=>1];
$arr = ['status'=>[1,2]];
$arr = ['status'=>1,'name'=>'Alex'];
$arr = ['status'=>[1,2],'name'=>'Alex'];
foreach ($arr as $key => $value) {
	if(is_array($value)) {
		$value = ("(".implode(",",$value).")");
		$chain[] = "`".$key."` IN ".$value;
	}
	else {
		$chain[] = "`".$key."`='".$value."'";
	}
}
// die;
p($chain);
$WHERE = " WHERE ".implode(" AND ", $chain);
// p($WHERE);
// SELECT * FROM `history` WHERE `patient_id` IN (1,2)
p("SELECT * FROM `unknown`".$WHERE);
*/

/*
$order = "ASC";
$order = "DESC";
$order = ['pers_numb'=>"ASC"];
$order = ['vizit_status'=>"DESC"];
if(is_array($order)) {
	p("по `".array_key_first($order)."`");
	$order = "ORDER BY `".array_key_first($order)."` ".current($order);
}
else {
	p("по `id`");
	$order = "ORDER BY `id` ".$order;
}
p("SELECT * FROM `unknown` ".$order);
*/


