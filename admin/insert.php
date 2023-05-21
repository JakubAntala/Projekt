<!DOCTYPE html>
<link rel="stylesheet" href="css/form.css">
<h1>Vkladanie hodnôť</h1>
</html>

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

    header("Location: login.php?error=nieste_prihlaseny");
}

?>




<?php
include_once "../database_files/database.php";


$menuObj = new Database();

if (isset($_POST['submit'])) {
    $insert = $menuObj->insertPost($_POST['title'], $_POST['date'], $_POST['text'], $_POST['image']);
    if ($insert) {
        header('Location: insert.php?status=1');
    } else {
        echo 'Nepodarilo sa vložiť hodnotu.';
    }
} else {
    if(isset($_GET['status']) && $_GET['status'] == 1) {

        echo '<strong>Hodnota bola vložená.</strong><br><br>';
    }


    ?>

    <form action="insert.php" method="post">
        Popis:<br>
        <input type="text" name="title" placeholder="" value=""><br>
        Dátum:<br>
        <input type="date" name="date" placeholder="date" value=""><br>
        Text:<br>
        <input type="text" name="text" placeholder="text" value=""><br>
        Cesta k obrázku:<br>
        <input type="text" name="image" placeholder="image" value=""><br><br>
        <input type="submit" name="submit" value="Vložiť">
        <br><br>
    </form><a href="menu.php"> <button>Editovať</button>   <p>  </p></a>
    <a href="logout.php"> <button>Odhlásiť sa</button> </a>

    <?php
}
?>

