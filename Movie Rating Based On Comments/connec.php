<?php
session_start();
$emai=$_GET['email'];
$foll=$_SESSION['email'];
 $con=mysqli_connect("localhost","root","","mydb");
 if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
 $ins=mysqli_query($con,"INSERT INTO connection (re,fo) VALUES ('".$emai."','".$foll."');");
echo $emai;
echo $foll;
header("Location:se.php?email=".$emai);
?>