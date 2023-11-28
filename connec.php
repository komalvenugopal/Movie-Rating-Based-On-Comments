<?php
session_start();
$emai=$_GET['email'];
$foll=$_SESSION['email'];
 $con=mysqli_connect("pxukqohrckdfo4ty.cbetxkdyhwsb.us-east-1.rds.amazonaws.com","r42xjjzx0hy6jn0q","bjv1aq1p3q3was3o","uy2phg3cofsy8520");
 if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
 $ins=mysqli_query($con,"INSERT INTO connection (re,fo) VALUES ('".$emai."','".$foll."');");
echo $emai;
echo $foll;
header("Location:se.php?email=".$emai);
?>