<?php 
session_start(); 
if(!isset($_SESSION['Name'])) header("Location: auth.php"); 
require 'scripts.php'
?>

<!doctype html>
<html lang="ru">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Студенты</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    </head>


    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">Московский Политех</a>

        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item ">
                    <a class="nav-link" href="groups.php">Группы <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="students.php">Студенты<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="question.php">Вопросы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin.php">Панель Управления</a>
                </li>
                <li class="nav-item">
                    <form method="post">
                    <input type="submit" class="send ex nav-link" name="exit" value="Выход">
                    </form>
                </li>
            </ul>
            <form action="scripts.js" method="get" class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" aria-label="Search" name = "word" id="search" placeholder="Поиск">
            </form>
        </div>
        </nav>
    </header>

</span>
<body>
<?php
if(empty($_GET['verified']))
{
    echo'<form method="post">';
}
?>
<div class="container-fluid">
  <div class="row">
    <div class="col-md" id="textColumn">
        <textarea class="textarea" name="text" cols="30" rows="10" placeholder="текст уведомления"></textarea>
        <input type="submit" name="send" class="send" value="Отправить">  
        <label class="switch">
        <input type="checkbox" id="verified" onClick="javascript: 
        if ($('#verified').is(':checked')){
            setTimeout(() => 
            location.replace('/students.php?verified=0'), 200);
        } else {
            setTimeout(() =>
            location.replace('/students.php'), 200);
        }">
        <span class="slider round"></span>
        </label>
    </div>

    <div class="col-sm">
    <?php student(1);?>
    </div>

    <div class="col-sm">
    <?php student(2)?>
    </div>

    <div class="col-sm">
    <?php student(3)?>
    </div>
<?php
if(empty($_GET['verified']))
{
    echo'</form>';
}
?>
<!-- тут начинается немного магии -->
<script>
$(function() {
  $("#search").on("keyup", function() {
    var pattern = $(this).val();
    $(".searchable-container .items").hide();
    $(".searchable-container .items")
      .filter(function() {
        return $(this)
          .text()
          .match(new RegExp(pattern, "i"));
      })
      .show();
  });
});
</script>
<!-- а вот тут заканчивается -->
</body>
</html>
<?php
    if(isset($_POST['send'])) //при нажатии на кнопку отправки
    {
        sendOutForStudents();
        echo "<script>location.replace('http://sss.std-322.ist.mospolytech.ru/notification.php?place=students')</script>";//включение рассылки
    }
    if(isset($_POST['exit'])) 
    { 
        session_destroy(); 
        header('Location: /auth.php'); 
        exit; 
    } 

    if(isset($_POST['accept'])) 
    { 
        verification();
    } 

    if(isset($_POST['reject'])) 
    { 
        reject();
    } 

    if(isset($_GET['verified']))
    {
        echo "<script>$('#verified').prop('checked', true)</script>"; 
    }
?>