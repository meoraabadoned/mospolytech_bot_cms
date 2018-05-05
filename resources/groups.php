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
    <div class="header">
        <div class="part"> </div>
        <div class="searchbox">
            <textarea name="search" rows="1" wrap="off" placeholder="поиск" class="search" onkeypress='search()'></textarea>
        </div>
    </div>
    <div class="navigation">
        <div class="selected_menu" id="menu_groups" onclick="location.href='groups.php';">группы</div>
        <div class="menu" id="menu_students" onclick="location.href='students.php';">студенты</div>
        <div class="menu" id="menu_search" onclick="location.href='search.php';">поиск</div>
        <div class="menu" id="menu_control" onclick="location.href='control.php';">панель управления</div>
    </div>

    <div class="column1"> 
    <?php
    $sort=0;
    try
    {
        $dbh = new PDO("mysql:host=std-mysql;dbname=std_320;", 'std_320','meowmeow'); 
        $result = $dbh->query("SELECT * FROM groups")->fetchAll();
        $reverseResult = array_reverse($result);
        foreach($reverseResult as $post):
        $sort++;
        if($sort==1)
        {
            echo '<div class="groupbox">';
            echo '<div class="holder">';
            echo '<div class="group"><a href="students.php?group='.$post["group_num"].'">'.$post["group_num"].'</a></div>';
            echo '<div class="description">'.$post["description"].'</div>';
            echo '</div>';
            echo '<div class="checkbox">';
            echo '<input type="checkbox" class="check" name="" id="">';
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
        $result = $dbh->query("SELECT * FROM groups")->fetchAll();
        $reverseResult = array_reverse($result);
        foreach($reverseResult as $post):
        $sort++;
        if($sort==2)
        {
            echo '<div class="groupbox">';
            echo '<div class="holder">';
            echo '<div class="group"><a href="students.php?group='.$post["group_num"].'">'.$post["group_num"].'</a></div>';
            echo '<div class="description">'.$post["description"].'</div>';
            echo '</div>';
            echo '<div class="checkbox">';
            echo '<input type="checkbox" class="check" name="" id="">';
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
        $result = $dbh->query("SELECT * FROM groups")->fetchAll();
        $reverseResult = array_reverse($result);
        foreach($reverseResult as $post):
        $sort++;
        if($sort==3)
        {
            echo '<div class="groupbox">';
            echo '<div class="holder">';
            echo '<div class="group"><a href="students.php?group='.$post["group_num"].'">'.$post["group_num"].'</a></div>';
            echo '<div class="description">'.$post["description"].'</div>';
            echo '</div>';
            echo '<div class="checkbox">';
            echo '<input type="checkbox" class="check" name="" id="">';
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
        <input type="submit" class="send" value="send">
        <form method="post">
            <input type="submit" class="send" name="exit" value="выход">
        </form>
    </div>
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
    if(isset($_POST['exit'])) 
    { 
        session_destroy(); 
        header('Location: /auth.php'); 
        exit; 
    } 
?>