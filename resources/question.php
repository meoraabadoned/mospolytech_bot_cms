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
    <meta name="description" content="Список групп, с которыми работает бот.">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Список групп</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
     <link rel="stylesheet" href="style.css">
     <link rel="stylesheet" href="que.css">
  </head>

    <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Московский Политех</a>

  <section class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item ">
        <a class="nav-link" href="groups.php">Группы</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="students.php">Студенты</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="question.php">Вопросы<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="admin.php">Панель Управления</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="veri.php">Верификация</a>
      </li>
      <li class="nav-item">
        <form method="post">
          <input type="submit" class="send ex nav-link" name="exit" value="Выход">
        </form>
      </li>
    </ul>
    
  </section>
</nav>
    </header>
    <body >
    <div class="col-sm-5" id = "cont" align = "center">
      <?php  question() ?>
    </div>
  </body>
    </html>

<?php 
if(isset($_POST['send']))
{
  answer();
}

if(isset($_POST['exit'])) 
    { 
        session_destroy(); 
        header('Location: /auth.php'); 
        exit; 
    } 
?>