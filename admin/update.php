<?php
    include_once "../database_files/database.php";


    if(isset($_POST['submit'])){
        $menuObj = new Database();
        $update = $menuObj-> updateMenuItem(
            $_POST['id'],
            $_POST['title'],
            $_POST['date'],
            $_POST['text'],
            $_POST['image'],
        );
        if ($update){
            header('Location: menu.php?status=2');
        }else{
            header('Location: menu.php?status = 3');
        }
    }else{
        header('Location: menu.php');
    }
?>
