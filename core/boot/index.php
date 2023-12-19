<?php 
class boot { 

	function __construct() { // создание метода класса с помощью служебного метода __construct

		# $CORE будет доступна вне класса "boot"
		global $CORE; 

		# подключаем config.php
		$CORE = require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");

		# маршруты
		$CORE['ROUTES'] = require_once($_SERVER['DOCUMENT_ROOT']."/core/inc/routes.php");

		# обработка адреса
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

		# подключаем вспомогательные файлы include
		require_once($_SERVER['DOCUMENT_ROOT']."/core/inc/function.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/core/inc/list.php");


		# классы ядра сайта

		// список файлов с классами	
		$arClass = [];
		foreach (scandir($_SERVER['DOCUMENT_ROOT']."/core/boot") as $dirItem) {
			if(preg_match("/^class\.(.+)\.php/", $dirItem, $match)) {
				$arClass[] = $match[1];
			}
		}

		// подключение файлов с классами
		// TODO: узнать больше о автозагрузке (здесь одновременно подключаются классы, это решает проблему с необходимостью строго по очереди подключить DB, CRUD, остальные классы)
		spl_autoload_register(function($match) {
			require_once($_SERVER['DOCUMENT_ROOT']."/core/boot/class.".$match.".php");
		});

		// обьекты класса
		foreach ($arClass as $cName) {
			if($cName == 'crud') continue;
			$CORE[strtoupper($cName)] = new $cName($CORE[strtoupper($cName)] ?? []);
		}

		// if(!file_exists($_SERVER['DOCUMENT_ROOT']."/core/config.php")) {
		// 	header("Location: /setup");
		// }
	}

}

new boot();