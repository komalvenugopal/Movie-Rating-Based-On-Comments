<?php
session_start();
/*if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true))
{
    include('loginForm1.php');
    echo "<script>document.getElementById('loginform').style.display='block';</script>";
}*/
$emai=$_GET['email'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            
            User Reviews
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
                text-decoration: underline !important;
            }
            a.an:hover{
                text-decoration: underline !important;
            }
button{
    all:unset;
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
            <li class="li01"><a href="se2.php">My Reviewers..</a></li>
            <li class="li01" style="float:right"><a href="profile.php">Profile</a></li>
            <li class="li01" style="float:right"><a href="logout.php">Logout</a></li>
        </ul>
        <?php 
            /*include('navigation.php');
            include('loginForm.php');*/
            include('signUpForm.php');
        ?>

        <div  style="background-color: #343a40;color:white;padding:1%; margin:10% 18% 0% 15%; border-radius:5px 5px 0 0">
            <?php
            echo "<img src=\"person.png\" style=\"width:170px;height:180px;padding-left:150px;\">";
                        $users=mysqli_query($con,"select username from user where email='".$emai."';");
                        $user=mysqli_fetch_array($users,MYSQLI_ASSOC);
                        echo "<span style=\"font-size:40px;font-family:Comic Sans MS;\">".$user['username']."</span>";?>
         
            <?php $folo=mysqli_query($con,"select * from connection where re='".$emai."' and fo='".$_SESSION['email']."';"); 
            if(mysqli_num_rows($folo)>0){?> <button style="float:right;background-color: #1ac6ff;padding:10px;border-radius: 5px;color:black;">Following</button><?php }else{ ?>
                  <a href="connec.php?email=<?php echo $emai  ?>" style="text-decoration: none;"> 
            <button style="float:right;background-color: #1ac6ff;padding:10px;border-radius: 5px;color:black;">+Follow </button></a> <?php } ?>
        </div>          
        <div style="background-color:white;padding:2% 1% 2% 3%; margin:0% 18% 3% 15%; border-radius:0 0 5px 5px;font-family:verdana;font-size:12px">
            
            <?php
                $con=mysqli_connect("localhost","root","","mydb");
                if(mysqli_connect_errno())
                {
                    die("could not connect".mysqli_connect_error());
                }
                else
                {   
                       
                        $reviews=mysqli_query($con,"select * from rnr where uemail='".$emai."';");
                        ?>
                        
                        <?php
                        while($review=mysqli_fetch_array($reviews,MYSQLI_ASSOC))
                        {
                            if($review['review']!=null){
                                echo "
                                <div style=\"background-color:#F6F6F5;padding:2% 1% 2% 3%; margin:0% 18% 3% 15%; border-radius:5px 5px 5px 5px\">";
                                if($review['rating']>0)
                                {
                                    echo "<span class=\"fa fa-star checked\"></span>&nbsp;".$review['rating']."".'/10'."|"."<b>Comment Rating:</b><span class=\"fa fa-star checked\"></span>&nbsp;".$review['Erating']."".'/10';
                                }
                                else
                                {

                                }
                                echo "<br><b>".$review['review_head']."</b><br>";
                                $moviena=mysqli_query($con,"select name from movies where m_id=".$review['m_id'].";");  
                                    
                                    echo "<span style=\"font-size:11px\"><em>".$user['username']."&nbsp;&nbsp;|&nbsp;".$review['timestamp']."</em><br><br></span>";
        
                                $name=mysqli_fetch_array($moviena,MYSQLI_ASSOC);
                                 echo "<span style=\"font-size:20px\"><em>".$name['name']."</em><br><br></span>";
                                echo $review['review'];
                                echo "</div>";
                            }
                        }
                }
                    
            ?>  
        </div>
        <?php include('footer.php');?>
    </body> 
</html>