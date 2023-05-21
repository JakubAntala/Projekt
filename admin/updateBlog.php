<?php
include_once "../database_files/database.php";
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$host="localhost";
$user="root";
$pass="";
$db="grill";

$con=mysqli_connect($host,$user,$pass,$db);
if(!empty($_SESSION["id"])){
    $id=$_SESSION["id"];
    $result=mysqli_query($con,"SELECT * FROM register WHERE id=$id");
    $row=mysqli_fetch_assoc($result);
}
else{

    header("Location: login.php?error=nieste_prihlaseni");
}



$menuObj = new Database();

$menuItem = $menuObj-> getBlogItem($_GET['id']);


?>
<form action="update.php" method="post">
    Popis:<br>
    <input type="text" name="title" placeholder="Title" value="<?php echo $menuItem['title']; ?>"><br>
    Dátum:<br>
    <input type="date" name="date" placeholder="Date" value="<?php echo $menuItem['date']; ?>"><br>
    Text:<br>
    <input type="text" name="text" placeholder="Text" value="<?php echo $menuItem['text']; ?>"><br>
    Cesta k obrázku:<br>
    <input type="text" name="image" placeholder="Image" value="<?php echo $menuItem['image']; ?>"><br>
    <input type="hidden" name="id" value="<?php echo $menuItem['id']; ?>">
    <br>
    <input type="submit" name="submit" value="Update">
</form>