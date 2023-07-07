<? 
if(!file_exists($_SERVER['DOCUMENT_ROOT']."/core/config.php")) {
	header("Location: /setup");
}

?>
<h1>Главная страница</h1>
