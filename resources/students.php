<?php 
session_start(); 
if(!isset($_SESSION['Name'])) header("Location: auth.php"); 
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <form method='post'>
    <div class="header">
        <div class="part"> </div>
        <div class="searchbox">
            <textarea name="search" rows="1" wrap="off" placeholder="поиск" class="search" onkeypress='search()'></textarea>
        </div>
    </div>
    <div class="navigation">
        <div class="menu" id="menu_groups" onclick="location.href='groups.php';">группы</div>
        <div class="selected_menu" id="menu_students" onclick="location.href='students.php';">студенты</div>
        <div class="menu" id="menu_search" onclick="location.href='search.php';">поиск</div>
        <div class="menu" id="menu_control" onclick="location.href='control.php';">панель управления</div>
    </div>
    <div class="column1"> 
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

    <div class="column2"> 
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

    <div class="column3"> 
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

    <div class="column4">  
        <textarea class="textarea" name="text" cols="30" rows="10" placeholder="текст уведомления"></textarea>
        <input type="submit" name="send" class="send" value="send">    
    </div>
    </form>  
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