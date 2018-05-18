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
        <a class="nav-link active" href="students.php">Студенты<span class="sr-only">(current)</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="control.php">Панель Управления</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="question.php">Вопросы</a>
      </li>
      <li class="nav-item">
        <form method="post">
          <input type="submit" class="send ex nav-link" name="exit" value="Выход">
        </form>
      </li>
    </ul>
   <form action="search.php" method="get" class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" aria-label="Search" name = "word">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Поиск
      </button>
    </form>
  </div>
</nav>
    </header>

</span>
<body>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm">
   <?php
    $sort=0;
    try
    {
        $dbh = new PDO("mysql:host=std-mysql;dbname=std_320;", 'std_320','meowmeow'); 
        if(isset($_GET['group']))
        {
            $result = $dbh->query("SELECT * FROM students WHERE group_num LIKE '%".$_GET['group']."%'")->fetchAll();
        }
        else
        {
            $result = $dbh->query("SELECT * FROM students")->fetchAll();
        }
        $reverseResult = array_reverse($result);
        foreach($reverseResult as $post):
            $sort++;
            if($sort==1)
            {
                echo '<div class="studentbox">';    
                echo '<div class="holder">';
                echo '<div class="student_name"><a href="https://vk.com/id'.$post["vk_id"].'">'.$post["surname"].' '.$post["name"].'</a></div>';
                echo '<div class="description">'.$post["group_num"].'</div>';
                echo '</div>';
                echo '<div class="checkbox">';
                echo '<input type="checkbox" class="check" name="targetStudents[]" value="'.$post["vk_id"].'">';
                echo '</div>';
                echo '</div>';
            }
            if($sort==3)
                $sort=0;
        endforeach; 
        $dbh = null;
        $result=null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }?>

    </div>

  <div class="col-sm">
   <?php
    $sort=0;
    try
    {
        $dbh = new PDO("mysql:host=std-mysql;dbname=std_320;", 'std_320','meowmeow'); 
        if(isset($_GET['group']))
        {
            $result = $dbh->query("SELECT * FROM students WHERE group_num LIKE '%".$_GET['group']."%'")->fetchAll();
        }
        else
        {
            $result = $dbh->query("SELECT * FROM students")->fetchAll();
        }
        $reverseResult = array_reverse($result);
        foreach($reverseResult as $post):
            $sort++;
            if($sort==2)
            {
                echo '<div class="studentbox">';    
                echo '<div class="holder">';
                echo '<div class="student_name"><a href="https://vk.com/id'.$post["vk_id"].'">'.$post["surname"].' '.$post["name"].'</a></div>';
                echo '<div class="description">'.$post["group_num"].'</div>';
                echo '</div>';
                echo '<div class="checkbox">';
                echo '<input type="checkbox" class="check" name="targetStudents[]" value="'.$post["vk_id"].'">';
                echo '</div>';
                echo '</div>';
            }
            if($sort==3)
                $sort=0;
        endforeach; 
        $dbh = null;
        $result=null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }?>
    </div>

   <div class="col-sm">
   <?php
    $sort=0;
    try
    {
        $dbh = new PDO("mysql:host=std-mysql;dbname=std_320;", 'std_320','meowmeow'); 
        if(isset($_GET['group']))
        {
            $result = $dbh->query("SELECT * FROM students WHERE group_num LIKE '%".$_GET['group']."%'")->fetchAll();
        }
        else
        {
            $result = $dbh->query("SELECT * FROM students")->fetchAll();
        }
        $reverseResult = array_reverse($result);
        foreach($reverseResult as $post):
            $sort++;
            if($sort==3)
            {
                echo '<div class="studentbox">';    
                echo '<div class="holder">';
                echo '<div class="student_name"><a href="https://vk.com/id'.$post["vk_id"].'">'.$post["surname"].' '.$post["name"].'</a></div>';
                echo '<div class="description">'.$post["group_num"].'</div>';
                echo '</div>';
                echo '<div class="checkbox">';
                echo '<input type="checkbox" class="check" name="targetStudents[]" value="'.$post["vk_id"].'">';
                echo '</div>';
                echo '</div>';
            }
            if($sort==3)
                $sort=0;
        endforeach; 
        $dbh = null;
        $result=null;
    } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }?>
    </div>

<div class="col-md">
        <textarea class="textarea" name="text" cols="30" rows="10" placeholder="текст уведомления"></textarea>
        <input type="submit" name="send" class="send" value="Отправить">  </div>
    <!-- немного js  -->
    <script>
        function search() 
        {
            if(event.keyCode == 13)
            {
                location.replace('search.php');
            }
        }
    </script>
    <!--  -->
</body>
</html>
<?php
    if(isset($_POST['send'])) //при нажатии на кнопку отправки
    {
        $author = "admin";
        $text = $_POST['text']; //берутся данные с textarea
        $targets = $_POST['targetStudents']; //выбирается массив данных с всех checkbox'ов
        $preparedTargets = implode(",",$targets);//преобразование в массив
        $isSent = 0;
        $type = "";
        if($preparedTargets=="") //определения типа рассылки
        {
            $type = "all";
        }
        else
        {
            $type = "students";
        }
        if(empty($text)) //проверка на пустой textaera
        {
            echo "<script>location.replace('')</script>";
        }
        else
        {
            if(stristr($content, '!important') === FALSE) //защита от html тегов и взлома стилей
            {
            $dbHost = "std-mysql";
            $dbUser = "std_320";
            $dbPass = "meowmeow";
            $dbName = "std_320";
                //начало добавления в бд
            if (mysqli_connect_errno()) {
                exit();
            }
        
            echo '<br>';
            $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        
            $query = "INSERT INTO `notifications` (`author`, `text`,`target_type`,`target`, `is_sent`) 
                VALUES ('$author', '$text', '$type' ,'$preparedTargets', '$isSent');";
            if ($result = $mysqli->query($query)) 
            {
            }
            $text= "";
            $type = "";
            $preparedTargets ="";
            $mysqli->close();
            echo "<script>location.replace('http://sss.std-322.ist.mospolytech.ru/notification.php?place=students')</script>";//включение рассылки
        }
        else
        {
            echo "<script>location.replace('')</script>";
        }
        }
    }
?>
<?php 
    if(isset($_POST['exit'])) 
    { 
        session_destroy(); 
        header('Location: /auth.php'); 
        exit; 
    } 
?>