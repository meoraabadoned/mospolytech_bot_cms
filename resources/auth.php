<?php 
session_start(); 
if(isset($_SESSION['Name'])) header("Location: index.php"); 
?> 

<html>
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Вход в базу данных бота">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">
	<link rel="stylesheet" href="Log.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
<title>Страница входа </title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
<body class="text-center">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-4481610-59', 'auto');
  ga('send', 'pageview');

</script>

<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter39705265 = new Ya.Metrika({ id:39705265, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/39705265" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
    <form method="post" class="form-signin">
      <img class="mb-4" src="polytech.png" alt="polytech logo" width="320" height="140">
      <h1 class="h3 mb-3 font-weight-normal">Авторизируйтесь для работы</h1>
      <label for="login" class="sr-only">>Логин: </label> 
      <input type="text" name="login" id="login" placeholder="Логин" class="form-control">
      <label for="password" class="sr-only">Пароль:</label>
      <input type="password" name="password" id="password" class="form-control" placeholder="Пароль" required>
      <button class="btn btn-dark btn-block" name="cool" type="submit">Войти</button>
      <p class="mt-5 mb-4 text-muted">&copy;
      Московский Политех </p>
    </form>
</body>
</html>

<?php
if (isset($_POST['cool']))
{
	// получаем данные из формы с авторизацией
	$login= $_POST['login'];
	$password= $_POST['password'];
	//проверка пароля и логина
	if (($login=='admin')&& ($password=='123'))
	{
		echo ("логин совпадает и пароль верны");
		//Запуск сессий;
		session_start();
		$_SESSION['Name']=$login;
		// идем на страницу для авторизованного пользователя
		header("Location: index.php");
	}
	else
	{die('Такой логин с паролем не найдены в базе данных.');}
}

?>
