<?php 
session_start(); 
if(!isset($_SESSION['Name'])) header("Location: auth.php");
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

    <title>Найденные студенты</title>

    <!-- Bootstrap core CSS -->
    <link href="../../../../dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="album.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <header>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" ara-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">Московский Политех</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item ">
        <a class="nav-link" href="groups.php">Группы <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="students.php">Студенты</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="control.php">Панель Управления</a>
      </li>
    </ul>
  </div>
</nav>
    </header>

</span>
 <div class="row">
    <div class="col-sm-4">
<?php 
$dbh = new PDO("mysql:host=std-mysql;dbname=std_320;", 'std_320','meowmeow'); 
$result = $dbh->query("SELECT * FROM students WHERE surname  LIKE '%".$_GET['word']."%'")->fetchAll(); 
$reverseResult = array_reverse($result); 
foreach($reverseResult as $post): 
{ 

echo '<div class="studentbox">';    
echo '<div class="holder">';
echo '<div class="student_name"><a href="https://vk.com/id'.$post["vk_id"].'">'.$post["surname"].' '.$post["name"].' '.$post["patronymic"].'</a></div>';
echo '<div class="description">'.$post["group_num"].'</div>';
echo '</div>';
echo '<div class="checkbox">';
echo '<input type="checkbox" class="check" name="" id="">';
echo '</div>';
echo '</div>';
} 

endforeach;
?>
</div>
<div class="col-sm-3">
        <textarea class="textarea" name="text" cols="55" rows="10" placeholder="текст уведомления"></textarea>
        <input type="button" name="send" class="send" value="Отправить">   
    </div>
</div>