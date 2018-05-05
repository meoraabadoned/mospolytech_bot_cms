<?php 
session_start(); 
if(!isset($_SESSION['Name'])) header("Location: auth.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <img src="http://wkazarin.ru/wp-content/uploads/2015/03/construction-image-23.jpg">
    <div>В данный момент мы ведем работы, чтобы этот раздел заработал</div>
</body>
</html>