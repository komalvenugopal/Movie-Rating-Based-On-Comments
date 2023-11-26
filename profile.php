<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>
  <link rel="stylesheet" type="text/css" href="nav.css">
  <link rel="stylesheet" type="text/css" href="loginform.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-size:14px;margin:0;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;">
    <?php
        session_start();
        $email=$_SESSION['email'];
        $con=mysqli_connect("localhost","root","","mydb");
        if(mysqli_connect_errno())
        {
            die("could not connect".mysqli_connect_error());
        }
        else
        {
            $query=("select * from user where email='".$email."';");
            $result=mysqli_query($con,$query);
            $array=mysqli_fetch_array($result,MYSQLI_ASSOC);
            $fullname=$array['fullname'];
            $uname=$array['username'];
            $mobile=$array['mobile'];
        }
        if(isset($_POST['doneEdit']))
        {
            $con=mysqli_connect("localhost","root","","mydb");
            if(mysqli_connect_errno())
            {
                die("could not connect".mysqli_connect_error());
            }
            else
            {
                $unameChanged=$_POST['uname'];
                $fullnameChanged=$_POST['fullname'];
                $mobileChanged=$_POST['mobile'];
                mysqli_query($con,"update user set username='".$unameChanged."',fullname='".$fullnameChanged."',mobile=".$mobileChanged." where email='".$email."';");
                $query=("select * from user where email='".$email."';");
                $result=mysqli_query($con,$query);
                $array=mysqli_fetch_array($result,MYSQLI_ASSOC);
                $fullname=$array['fullname'];
                $uname=$array['username'];
                $mobile=$array['mobile'];
                echo "<script>
                    document.getElementById('OK').disabled=true;
                    document.getElementById('unameIp').disabled=true;
                    document.getElementById('fullNameIp').disabled=true;
                    document.getElementById('mobileIp').disabled=true;
                    </script>";
            }
        }
    ?>
    
    <ul id="l01" style="z-index:1;position:fixed;top:0;width:100%;">
        <li class="li01"><a href="Login.php">Home</a></li>
        <li class="li01"><a href="movies.php">Movies</a></li>
        <li class="li01"><a href="artist.php">Celebs..</a></li>
        <li class="li01" style="float:right"><a href="profile.php">Profile</a></li>
        <li class="li01" style="float:right"><a href="Home.php">Logout</a></li>
    </ul> 

    
    <div style="background-color:#343a40;padding:0.3% 5% 0.5% 5%; margin:5% 15% 0% 15%; border-radius:5px 5px 0 0;color:white">
    <h3>Profile</h3>
    </div> 
    <div style="background-color:white;padding:3%; margin:0% 15% 0% 15%; border-radius:0 0 5px 5px">
        <form method="post" action="">
            <b>USERNAME</b><br><input  style="border:none;border-radius:10px;color:black;background:transparent" id="unameIp" type="text" name="uname"  value="<?php echo $uname?>" disabled><br>
            <b>FULL NAME</b><br><input  style="border:none;border-radius:10px;color:black;background:transparent"id="fullNameIp" type="text" name="fullname" value="<?php echo $fullname?>"  disabled><br>
            <b>CONTACT  </b><br><input  style="border:none;border-radius:10px;color:black;background:transparent" id="mobileIp" name="mobile" type="text" value="<?php echo $mobile?>" disabled><br>
            <b>EMAIL    </b><br><input style="border:none;border-radius:10px;color:black;background:transparent" id="emailIp" type="text" value="<?php echo $email?>" disabled><br>
            <input type="button" value="EDIT" name="editBtn"  class="bt"onclick="enable();">
            <button type="submit" class="bt" name="doneEdit" id="OK">OK</button>
            <script>
                document.getElementById('OK').disabled=true;
                function enable()
                {
                    document.getElementById('OK').disabled=false;
                    document.getElementById('unameIp').disabled=false;
                    document.getElementById('fullNameIp').disabled=false;
                    document.getElementById('mobileIp').disabled=false;
                }
                </script>
        </form>
    </div>
 
</body>

</html>