<?php 
class boot { 

	function __construct() { // создание метода класса с помощью служебного метода __construct
		// $CORE будет доступна вне класса "boot"
		global $CORE; 
		// подключаем config.php
		$CORE = require_once($_SERVER['DOCUMENT_ROOT']."/core/config.php");
		// подключаем классы 
		require_once($_SERVER['DOCUMENT_ROOT']."/core/boot/db.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/core/boot/crud.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/core/boot/patient.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/core/boot/history.php");

		// данные о подключении к БД сводим в класс и подключаем к $CORE['DB']
		$CORE['DB'] = new DB($CORE['DB']);
		$CORE['PATIENT'] = new patient;
		$CORE['HISTORY'] = new history;

		// подключаем function.php
		require_once($_SERVER['DOCUMENT_ROOT']."/core/inc/function.php");
		// подключаем list.php
		require_once($_SERVER['DOCUMENT_ROOT']."/core/inc/list.php");
		// if(!file_exists($_SERVER['DOCUMENT_ROOT']."/core/config.php")) {
		// 	header("Location: /setup");
		// }
	}

}

new boot();