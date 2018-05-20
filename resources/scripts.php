<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
    //echo "<script>location.replace('index.php')</script>";
    ?>
</body>
</html>

<?php

function student($columnNum)
{
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
            if($sort==$columnNum)
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
    }
}

function group($columnNum)
{
    $sort=0;
    try
    {
        $dbh = new PDO("mysql:host=std-mysql;dbname=std_320;", 'std_320','meowmeow'); 
        $result = $dbh->query("SELECT * FROM groups")->fetchAll();
        $reverseResult = array_reverse($result);
        foreach($reverseResult as $post):
        $sort++;
        if($sort==$columnNum)
        {
            echo '<div class="groupbox">';
            echo '<div class="holder">';
            echo '<div class="group"><a href="students.php?group='.$post["group_num"].'">'.$post["group_num"].'</a></div>';
            echo '<div class="description">'.$post["description"].'</div>';
            echo '</div>';
            echo '<div class="checkbox">';
            echo '<input type="checkbox" class="check" name="targetGroups[]" value="'.$post["group_num"].'">';
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
    }
}

function sendOutForStudents()
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
            echo "<script>location.replace('http://sss.std-322.ist.mospolytech.ru/notification.php?place=.'$place'.')</script>";//включение рассылки
        }
        else
        {
            echo "<script>location.replace('')</script>";
        }
        }
}

function sendOutForGroups()
{
    $author = "admin";
    $text = $_POST['text'];
    $targets = $_POST['targetGroups'];
    $preparedTargets = implode(",",$targets);
    $isSent = 0;
    $type = "";
    if($preparedTargets=="")
    {
        $type = "all";
    }
    else
    {
        $type = "groups";
    }
    if(empty($text))
    {
        echo "<script>location.replace('')</script>";
    }
    else
    {
        if(stristr($content, '!important') === FALSE)
        {
        $dbHost = "std-mysql";
        $dbUser = "std_320";
        $dbPass = "meowmeow";
        $dbName = "std_320";
        if (mysqli_connect_errno()) {
            exit();
        }
    
        echo '<br>';
        $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
    
        $query = "INSERT INTO `notifications` (`author`, `text`,`target_type`, `target`, `is_sent`) 
            VALUES ('$author', '$text', '$type' ,'$preparedTargets', '$isSent');";
        
        if ($result = $mysqli->query($query)) 
        {
        }
        $text = "";
        $type = "";
        $preparedTargets ="";
        $mysqli->close();
        echo "<script>location.replace('http://sss.std-322.ist.mospolytech.ru/notification.php?place=groups')</script>";
    }
    else
    {
        echo "<script>location.replace('')</script>";
    }
    }
}

?>