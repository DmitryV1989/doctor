<?

abstract class CRUD {
	public function Create($arFields) {
		return DB::query("INSERT INTO `$this->tableName` ("."`".implode("`,`", array_keys($arFields))."`".") VALUES ("."'".implode("', '", $arFields)."'".") ");
	}

	public function Read($id = 0, $filter_fields=[], $order = "ASC") {
		// !!!TODO: реализовать чтобы у каждого критерия можно было указать несколько значений (в виде вложенного массива ['sex'=>[1,2],'visit_status'=>1]!!!

		// !!!TODO: эволюционировать параметр $order что бы можно было сортировать не только по полю `id`(например ['pers_numb'=>"DESC"]), если передаётся значение str (просто строка "ASC" или "DESC", то сортировка производится по `id`)!!!

		/*
		sql запрос должен быть один, примерно в конце метода.
		WHERE-часть sql запроса вынести в $WHERE, которая будет конкатинироваться к запросу в любом случае.
		Первый аргумент (может быть int или arr) нужно проверять на тип in_array.
		*/

		$WHERE = "";
		$chain = [];
		if ($id) {
			$filter_fields['id'] = $id;		
		}
		if ($filter_fields) {
			foreach ($filter_fields as $key => $value) {
				if(is_array($value)) {
					$value = ("(".implode(",",$value).")");
					$chain[] = "`".$key."` IN ".$value;
				}
				else {
					$chain[] = "`".$key."`='".$value."'";
				}		
			}
			$WHERE = " WHERE ".implode(" AND ", $chain); 
		}
		if(is_array($order)) {
			$order = "ORDER BY `".array_key_first($order)."` ".current($order);
		}
		else {
			$order = "ORDER BY `id` ".$order;
		}
		// return $order;
		// return "SELECT * FROM `$this->tableName`".$WHERE." ".$order;
		return DB::select("SELECT * FROM `$this->tableName`".$WHERE." ".$order);
	}

	public function Update($id, $arFields) {
		foreach ($arFields as $key => $value) {
			$setChain[] = "`$key`='$value'";
		}
		return DB::query("UPDATE `$this->tableName` SET ".implode(",", $setChain)." WHERE `id`=$id");
	}

	public function Delete($id) {
		return DB::query("DELETE `$this->tableName` WHERE `id` = $id");
	}

}

