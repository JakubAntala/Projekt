<?php
include_once "../database_files/database.php";
$menuObj = new Database();

if(isset($_GET['id'])) {
    $delete = $menuObj->deletePost($_GET['id']);
    if($delete) {
        header('Location: menu.php');
    } else {
        echo "Nastala chyba pri vymzávaní.";
    }
} else {
    header('Location: menu.php');
}