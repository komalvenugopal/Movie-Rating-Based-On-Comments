<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php
                if(isset($_GET["aid"]))
                {
                    $con=mysqli_connect("localhost","root","","mydb");
                    if(mysqli_connect_errno())
                    {
                        die("could not connect".mysqli_connect_error());
                    }
                    else
                    {
                        $artists=mysqli_query($con,"select * from artist where a_id=".$_GET["aid"].";");
                        $artist=mysqli_fetch_array($artists,MYSQLI_ASSOC);
                        if(mysqli_affected_rows($con)>0)
                        {
                            echo $artist['aname'];
                        }
                    }
                }
            ?>
        </title>
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="loginform.css">
        <link rel="stylesheet" type="text/css" href="thumbs.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
            .checked {
                color: orange;
            }
            table {
                border-collapse: collapse;
                width: 80%;
                margin-left:5%;
            }

            td, th {
                text-align: left;
            }

            tr:nth-child(even) {
                background-color: #dddddd ;
            }
            td a:hover
            {
                text-decoration: underline;
            }

        </style>
    </head>
    <body style="margin:0;background-image: url('<?php
         $con=mysqli_connect("localhost","root","","mydb");
         $img=mysqli_query($con,"SELECT * FROM bg ORDER BY RAND() LIMIT 1");
         $img=mysqli_fetch_array($img,MYSQLI_ASSOC);
         echo $img['bg'];
        ?>');background-size: 100% 100%; background-attachment: fixed;font-size:14px;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;font-weight: 400;">
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
            <li class="li01" style="float:right"><a href="profile.php">Profile</a></li>
            <li class="li01" style="float:right"><a href="logout.php">Logout</a></li>
        </ul>
        <?php 
            /*include('navigation.php');
            include('loginForm.php');*/
            include('signUpForm.php');
        ?>

        <div  style="background-color: #343a40;color:white;padding:0.3% 5% 13% 5%; margin:10% 18% 0% 15%; border-radius:5px 5px 0 0">
                <p>
                    <?php
                        if(isset($_GET["aid"]))
                        {
                            $con=mysqli_connect("localhost","root","","mydb");
                            if(mysqli_connect_errno())
                            {
                                die("could not connect".mysqli_connect_error());
                            }
                            else
                            {
                                $artists=mysqli_query($con,"select * from artist where a_id=".$_GET["aid"].";");
                                $artist=mysqli_fetch_array($artists,MYSQLI_ASSOC);
                                if(mysqli_affected_rows($con)>0)
                                {
                                    $aid=$artist['a_id'];
                                    $name=$artist['aname'];
                                    $dob=$artist['dob'];
                                    $place=$artist['place'];
                                    $imgloc=$artist['img_loc'];
                                    $bio=$artist['bio'];
                                }
                            }
                        }
                    ?>
                    <img src='<?php echo $imgloc;?>' class="thumb" style="width:130px;float:left;margin:0 5% 3% 0">
                        <span>
                            <span style="font-size:200%"><b><?php echo $name;?></b></span>
                            <br>
                            <?php echo "<b>Born:</b> ".date("M jS, Y", strtotime($dob));?>&nbsp;|&nbsp;<?php echo "in ".$place;?>     
                        </span>      
                </p>
        </div>
        <div style="background-color:white;padding:2% 1% 2% 3%; margin:0% 18% 3% 15%; border-radius:0 0 5px 5px">
            <div style="font-size:14px;text-align:center;">
                <?php 
                    echo "<br><br><b><span style=\"text-align:center;\">Full Bio:</span></b>";
                    echo $bio;
                ?>
                </div>
            </div>
    </body> 
    <?php include('footer.php');?>
</html>