<?php

$host="localhost";
$user="root";
$pass="";
$db="grill";

$con=mysqli_connect($host,$user,$pass,$db);

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password= $_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];
    $duplicate=mysqli_query($con,"SELECT * FROM register WHERE username= '$username' OR email = '$email'");
    if(mysqli_num_rows($duplicate)>0){
        echo
        "<script> alert('Prihlasovacie meno alebo Email už niekto používa.');</script>";
    }
    else{
        if($password == $confirmpassword){
            $query ="INSERT INTO register VALUES ('','$username','$email','$password')";
            mysqli_query($con,$query);
            echo
            "<script> alert('Registrácia bola úspešná');</script>";
            header("Location: insert.php");
        }
        else{
            echo
            "<script> alert('Heslá sa nezhodujú.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Registrácia</title>
</head>

<body>
<h1>Registracia</h1>
<form class="" action="" method="post" autocomplete="off">
    <label for="username">Prihlasovacie meno:</label>
    <input type="text" name="username" id="username" required value=""> <br>

    <label for="email">Email :</label>
    <input type="email" name="email" id="email" required value=""> <br>

    <label for="password">Heslo :</label>
    <input type="password" name="password" id="password" required value=""> <br>

    <label for="confirmpassword">Potvrdenie hesla :</label>
    <input type="password" name="confirmpassword" id="confirmpassword" required value=""> <br><br>
    <button type="submit" name="submit">Registrovať</button>
</form>
<br>
<button> <a href="login.php">Login</a></button>
</body>
</html>
