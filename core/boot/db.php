<?php
class DB {
	// задаём параметры подключения к серверу БД
	protected static $connect;

	// подключениемся к БД
	public function __construct($config) {
		self::$connect = mysqli_connect(
			$config['SERVER'],
			$config['USER'],
			$config['PASSWORD'],
			$config['NAME']
		);
		// Fatal error:  Uncaught mysqli_sql_exception: Access denied for user ''@'localhost'
	}
	
	//выполняем запрос к БД 
	public static function query($query) { // $query содержит sql запрос (т.е. текст запроса) в БД 
		return mysqli_query(self::$connect, $query);
	}

	// определяем количество выводимых массивов (т.е. строк таблицы из БД)
	public static function select($query, $flag = "rows") {
		$sqlResult = self::query($query);
		while ($row = mysqli_fetch_assoc($sqlResult)) {
			$arList[$row['id']] = $row;	// будуд выведены все строки
		}
		if($flag == "row") {
			$arList = $arList[array_key_first($arList)]; // будет выведена одна строка
		}

		return $arList;
	}
	
}