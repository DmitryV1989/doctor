<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Doctor</title>
<link rel="stylesheet" href="/static/custom.css">
<link rel="icon" type="image/png" href="/favicon.png">
</head>
<body>
<div id="wrapper">
	<div class="container">

		<header>
			<div class="row c1">
				<a href="/" id="logo"><img src="/static/images/logo.png" alt="" class="bimg"></a>
				<div class="blank">
					<a href="#">Печать</a>
					<a href="#">Процедуры</a>
					<a href="#">Фармацевтика</a>
				</div>
				<div class="client">Связь с клиентом</div>
			</div>	
			<nav>
				<a href="/reg">Регистрация</a>
				<a href="">История</a>
			</nav>
		</header>
		<? p($CORE) ?>
		<? content() ?>
		<!-- <? return CREATE_PAGE::content() ?> -->


	</div>
</div>	
<footer>
	<div class="container">
		<span class="copyright">Частная поликлиника Весового Д. Все права защищены 2023</span>
	</div>		
</footer>
<script src="/static/custom.js"></script>
<script>
if(document.querySelector('.digit')) {
  countDownElTimer(<?=$CORE['LIST']['refresh']?>);
}	
</script>
</body>
</html>