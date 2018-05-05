<?php 
session_start(); 
if(isset($_SESSION['Name'])) header("Location: index.php"); 
?> 

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link rel="stylesheet" href="Log.css">
</head>
<body>
  <form method="post" class="login">
    <p>
      <label for="login">Логин:</label>
      <input type="text" name="login" id="login" placeholder="Text">
    </p>

    <p>
      <label for="password">Пароль:</label>
      <input type="password" name="password" id="password" placeholder="*********">
    </p>

    <p class="login-submit">
      <input type="submit" name="cool" class="login-button">
    </p>
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
