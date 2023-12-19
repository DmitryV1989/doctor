<?

abstract class CRUD {
	// TODO: прокоментировать этапы, над каждым методом написать образцы вызовов и комменты к параметрам
	# Создание новой записи
	public function Create($arFields) {
		return DB::query("INSERT INTO `$this->tableName` ("."`".implode("`,`", array_keys($arFields))."`".") VALUES ("."'".implode("', '", $arFields)."'".") ");
	}

	# Просмотр записи
	public function Read($id = 0, $filter_fields=[], $order = "ASC") {
		$WHERE = "";
		$chain = [];
		// проверяем id записи, если равна нулю, выводятся все значения
		if ($id) {
			$filter_fields['id'] = $id;		
		}
		// запрашиваем записи из таблицы по стобцам
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
		// устанавливаем порядок выведения записей
		if(is_array($order)) {
			$order = "ORDER BY `".array_key_first($order)."` ".current($order);
		}
		else {
			$order = "ORDER BY `id` ".$order;
		}
		return DB::select("SELECT * FROM `$this->tableName`".$WHERE." ".$order);
	}

	# Редактирование записи
	public function Update($id, $arFields) {
		foreach ($arFields as $key => $value) {
			$setChain[] = "`$key`='$value'";
		}
		return DB::query("UPDATE `$this->tableName` SET ".implode(",", $setChain)." WHERE `id`=$id");
	}
	# Удаление записи
	public function Delete($id) {
		return DB::query("DELETE `$this->tableName` WHERE `id` = $id");
	}

}

