<h1>Menu</h1>
<?php
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

?>
<?php
include_once "../database_files/database.php";
$menuObj = new Database();
$menu = $menuObj->getFromDatabase();





if(isset($_GET['status']) && $_GET['status'] == 2) {
    echo "<strong>Hodnota bola správne upravená.</strong><br><br>";
} elseif (isset($_GET['status']) && $_GET['status'] == 3) {
    echo "<strong>Hodnota nebola správne upravená.</strong><br><br>";
}
?>

<br>

<ul>
    <?php
    foreach ($menu as $menuItem) {

        echo "<li>ID: ". $menuItem['id'] . ", Title: " . $menuItem['title'] . "  " .
            '<a href="delete.php?id='.$menuItem['id'].'">Delete</a> /
             <a href="updateBlog.php?id='.$menuItem['id'].'">Update</a>
            </li>';

    }
    ?>
    <br>
    <a href="insert.php"> <button>Vložiť</button> </a>
</ul>