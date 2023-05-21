<?php
if(session_status() !== PHP_SESSION_ACTIVE) session_start();
$host="localhost";
$user="root";
$pass="";
$db="grill";

$con=mysqli_connect($host,$user,$pass,$db);

if(isset($_POST["submit"])){
    $username=$_POST["username"];
    $password=$_POST["password"];
    $result=mysqli_query($con,"SELECT * FROM register WHERE username='$username'");
    $row=mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result)>0){
        if($password == $row["password"]){
            if(session_status() !== PHP_SESSION_ACTIVE) session_start();
            $_SESSION["login"]= true;
            $_SESSION["id"]= $row["id"];
            header("Location: insert.php");
        }
        else{
            echo
            "<script> alert('Heslo je nespravne');</script>";
        }

    }
    else{
        echo
        "<script> alert('Prihlasovacie meno neexistuje.');</script>";
    }
}
?>

        <h1>Prihlasovanie</h1>
    <form action="login.php" method="post">
        Prihlasovacie meno:<br>
        <input type="text" name="username" value="" placeholder="meno"><br>
        Heslo:<br>
        <input type="password" name="password" value="" placeholder="heslo"><br><br>
        <input type="submit" name="submit" value="Prihlásiť sa">
    </form>
    <a href="register.php"><button>Registrácia</button></a>
    <?php

?>
