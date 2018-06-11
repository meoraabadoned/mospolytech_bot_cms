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
    <form method="post" class="form-signin">
      <img class="mb-4" src="polytech.png" alt="polytech logo" width="320" height="140">
      <h1 class="h3 mb-3 font-weight-normal">Авторизируйтесь для работы</h1>
      <label for="login" class="sr-only">Логин: </label> 
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
$mysqli = new mysqli('std-mysql','std_320','meowmeow', 'std_320');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
	if (mysqli_connect_errno()) 
	{
		printf("Connect failed: %s\n", mysqli_connect_error());
		exit();
	}
	if (isset($_POST['cool']))
	{
		$salt = 'HOHOHOLOLOLOBOBOBO';
		$l_Nickname= $_POST['login'];
		$l_Password= sha1($_POST['password'] . $salt);
		$query = "SELECT password FROM Auth WHERE login = '$l_Nickname'";
		if ($result = $mysqli->query($query)) 
		{
			while ($row = $result->fetch_assoc()) {
			$Password_L= $row["password"];
		}
		$result->close();
	}
		if ($l_Password == ($Password_L))
		{
			session_start();
			$_SESSION['Name']=$l_Nickname;
			header("Location: /index.php");
		}
		else
		{
			echo '<br>Неправильный пароль<br>';
		}
		$mysqli->close();
	}
?>
