<?php session_start();
/*if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true))
{
    include('loginForm1.php');
    echo "<script>document.getElementById('loginform').style.display='block';</script>";
}*/
$se=$_POST["search"];
?>
<!DOCTYPE html>
<html>
<head>
        <title>Movies</title>
        <link rel="stylesheet" type="text/css" href="thumbs.css">
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="loginform.css">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
                table{
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 95%;
                }

                td, th {
                        text-align: center;
                        padding:10px 0 0 0;
                        color: white;
                        font-size:12px;
                }
                button{
                    all:unset;
                }
        </style>
</head>
<body style="background-image: url('<?php
         $con=mysqli_connect("localhost","root","","mydb");
         $img=mysqli_query($con,"SELECT * FROM bg ORDER BY RAND() LIMIT 1");
         $img=mysqli_fetch_array($img,MYSQLI_ASSOC);
         echo $img['bg'];
        ?>
');background-size: 100% 100%; background-attachment: fixed;font-size:14px;margin:0;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;font-weight: 400;">
    <?php
        if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true))
        {
            include('loginForm1.php');
            echo "<script>document.getElementById('loginform').style.display='block';</script>";
        }
    ?>  
    <ul id="l01" style="z-index:1;position:fixed;top:0;width:100%;">
        <li class="li01"><a href=<?php
        if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
        echo "Login.php";
        else
        echo "Home.php";
        
        
        ?>>Home</a></li>
        <li class="li01"><a href="movies.php">Movies</a></li>
        <li class="li01"><a href="artist.php">Celebs..</a></li>
        <li class="li01"><a href="se2.php">My Reviewers..</a></li>
        <li class="li01"><form action="search.php" method="POST"><input type="text" name="search" placeholder="enter your favorite reviewer......" style="margin-left: 200px;"> <input type="submit" value="S" style="background-color: red;border-radius: 5px; color:black; font-size: 25px; margin-top: 5px;padding-bottom: 5px;  box-shadow: 0px 0px 0px transparent;text-shadow: 0px 0px 0px transparent;"></form></li>
        <li class="li01" style="float:right"><a href="profile.php">Profile</a></li>
        <li class="li01" style="float:right"><a href="logout.php">Logout</a></li>
    </ul>
    <?php 
        /*include('loginForm.php');
        include('navigation.php');*/ 
        include('signUpForm.php');
    ?>  
    <div style="background-color:white;padding:0.3% 5% 0.5% 5%; margin:10% 18% 0% 15%; border-radius:5px 5px 0 0">
        <h3>Movies</h3>
    </div>
    <div style="background-color:grey;padding:10px 5px 10px 5px; margin:0% 18% 0% 15%; border-radius:0 0 5px 5px">
    <center>
        <table>
            
                <?php
                    $con=mysqli_connect("localhost","root","","mydb");
                    if(mysqli_connect_errno())
                    {
                        die("could not connect".mysqli_connect_error());
                    }
                    else
                    {
                        
                        
                    
                            $result=mysqli_query($con,"SELECT * FROM connection WHERE fo='".$_SESSION['email']."';");
                        ?><table  cellspacing="100"><?php
                           while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
                            $result2=mysqli_query($con,"SELECT * FROM user WHERE  email='".$row['re']."';");
                            $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                            echo "<tr style=\"heigth:200px;\">";
                            echo "<td style=\"width:700px;heigth:200px;padding:50px;font-size:30px;color:black; background-color:white;border-radius:white;border:1px solid gray;border-bottom:10px solid gray; border-spacing: 5px 10px;font-family:Comic Sans MS;\"><img src=\"us.png\" alt=\"Italian Trulli\" style=\"width:200px;heigth:50px;\"> ".$row2['fullname']."</td> <br>";
                            echo "<td><a href=\"se.php?email=".$row2['email']."\" style=\"text-decoration:none;\"><button style=\"padding:10px;border-radius:5px; font-size:20px;background-color:black;color:white;\">view posts</button></a></td>";
                            echo "</tr>";
                           }
                            
                       
                        

                    }
                ?>
                      
     
        </table>
    </center>
    </div>
    <?php include('footer.php');?>
</body>
</html>