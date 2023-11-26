<?php
session_start();
/*if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true))
{
    include('loginForm1.php');
    echo "<script>document.getElementById('loginform').style.display='block';</script>";
}*/
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            <?php
                if(isset($_GET["mid"]))
                {
                    $con=mysqli_connect("localhost","root","","mydb");
                    if(mysqli_connect_errno())
                    {
                        die("could not connect".mysqli_connect_error());
                    }
                    else
                    {
                        $movies=mysqli_query($con,"select * from movies where m_id=".$_GET["mid"].";");
                        $movie=mysqli_fetch_array($movies,MYSQLI_ASSOC);
                        if(mysqli_affected_rows($con)>0)
                        {
                            echo "Review- ".$movie['name'];
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
                text-decoration: underline !important;
            }
            a.an:hover{
                text-decoration: underline !important;
            }

        </style>
    </head>
    <body style="margin:0;background-image: url('<?php
         $con=mysqli_connect("localhost","root","","mydb");
         $img=mysqli_query($con,"SELECT * FROM bg ORDER BY RAND() LIMIT 1");
         $img=mysqli_fetch_array($img,MYSQLI_ASSOC);
         echo $img['bg'];
        ?>');background-size: 100% 100%; background-attachment: fixed;font-size:14px;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;">
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
        <span name="top"></span>
        <?php 
            /*include('navigation.php');
            include('loginForm.php');*/
            include('signUpForm.php');
        ?>

        <div  style="background-color: #343a40;color:white;padding:0.3% 5% 13% 5%; margin:10% 18% 0% 15%; border-radius:5px 5px 0 0">
            <div>
                <p>
                    <?php
                        if(isset($_GET["mid"]))
                        {
                            $con=mysqli_connect("localhost","root","","mydb");
                            if(mysqli_connect_errno())
                            {
                                die("could not connect".mysqli_connect_error());
                            }
                            else
                            {
                                $movies=mysqli_query($con,"select * from movies where m_id=".$_GET["mid"].";");
                                $movie=mysqli_fetch_array($movies,MYSQLI_ASSOC);
                                if(mysqli_affected_rows($con)>0)
                                {
                                    $mid=$movie['m_id'];
                                    $name=$movie['name'];
                                    $rdate=$movie['release_date'];
                                    $des=$movie['description'];
                                    $dur=$movie['duration'];
                                    $imgloc=$movie['img_loc'];
                                }
                            }
                        }
                    ?>
                    <img src='<?php echo $imgloc;?>' class="thumb" style="width:130px;float:left;margin:0 5% 2% 0">
                    <span>
                            <span style="font-size:200%"><b><?php echo $name;?></b></span>
                            <br>
                            <?php 
                                echo $dur;?>&nbsp;|&nbsp;<?php echo date("M jS, Y", strtotime($rdate));?>
                                <br><br>    
                        </span>
                    <form method="post" action="">
                        <div style="float:right"><em>Your Rating:</em>
                            <span class="fa fa-star" id="1" title="Overall Rating" onmouseover="change(this.id)" title="Rate 1"></span>
                            <span class="fa fa-star" id="2" onmouseover="change(this.id)" title="Rate 2"></span>
                            <span class="fa fa-star" id="3" onmouseover="change(this.id)" title="Rate 3"></span>
                            <span class="fa fa-star" id="4" onmouseover="change(this.id)" title="Rate 4"></span>
                            <span class="fa fa-star" id="5" onmouseover="change(this.id)" title="Rate 5"></span>
                            <span class="fa fa-star" id="6" onmouseover="change(this.id)" title="Rate 6"></span>
                            <span class="fa fa-star" id="7" onmouseover="change(this.id)" title="Rate 7"></span>
                            <span class="fa fa-star" id="8" onmouseover="change(this.id)" title="Rate 8"></span>
                            <span class="fa fa-star" id="9" onmouseover="change(this.id)" title="Rate 9"></span>
                            <span class="fa fa-star" id="10" onmouseover="change(this.id)" title="Rate 10"></span>
                            <input type="hidden" id="mrating" name="mrating">
                            <input type="submit" name="submit" value="rate"><span style="font-size:200%"></span>
                        </div>  
                    </form>       
                </p>
            
                <script>
                    function change(id)
                    {
                        document.getElementById("mrating").value=parseInt(id);
                        for(var i=id;i>=1;i--)
                        {
                            document.getElementById(i).className="fa fa-star checked";
                        }
                        var k=parseInt(id)+1;
                        for(var j=k;j<=10;j++)
                        {
                            document.getElementById(j).className="fa fa-star";
                        }
                    }
                </script>
                <?php
                    $urated=mysqli_query($con,"select * from rnr where m_id=".$_GET["mid"]." and uemail='".$_SESSION['email']."';");
                    if(mysqli_affected_rows($con)>0)
                    {
                        $urate=mysqli_fetch_array($urated,MYSQLI_ASSOC);
                        echo "<script>
                        change(".$urate['rating'].");
                        </script>";
                        if(isset($_POST['submit']))
                        {
                            mysqli_query($con,"update rnr set rating=".$_POST['mrating']." where m_id=".$mid." and uemail='".$_SESSION['email']."';");
                            $cr=mysqli_query($con,"select round(avg(rating),1) as orate from rnr where m_id=".$mid.";");
                            $cr=mysqli_fetch_array($cr,MYSQLI_ASSOC);
                            mysqli_query($con,"update movies set content_rating=".$cr['orate']." where m_id=".$mid.";");
                        }
                    
                    }
                    else
                    {
                        if(isset($_POST['submit']))
                        {
                            $con=mysqli_connect("localhost","root","","mydb");
                            if(mysqli_connect_errno())
                            {
                                die("could not connect".mysqli_connect_error());
                            }
                            else
                            {
                                mysqli_query($con,"select * from rnr where m_id=".$mid." and uemail='".$_SESSION['email']."';");
                                if(mysqli_affected_rows($con)>0)
                                { 
                                    mysqli_query($con,"update rnr set rating=".$_POST['mrating']." where m_id=".$mid." and uemail='".$_SESSION['email']."';");
                                }
                                else
                                { 
                                    $stat=mysqli_query($con,"insert into rnr (m_id,uemail,rating) values(".$mid.",'".$_SESSION['email']."',".$_POST['mrating'].");");
                                    $cr=mysqli_query($con,"select round(avg(rating),1) as orate from rnr where m_id=".$mid.";");
                                    $cr=mysqli_fetch_array($cr,MYSQLI_ASSOC);
                                    mysqli_query($con,"update movies set content_rating=".$cr['orate']." where m_id=".$mid.";");
                                    echo "<script>
                                    document.location.reload();
                                    </script>";
                                } 
                            }
                        }
                    }
                ?>
            </div>
        </div>
        <div style="background-color:white;color:white;padding:4%; margin:0% 18% 0% 15%; border-radius:0 0 5px 5px">
            <p style="color:black"><b>Your Review</b></p>
            <form action="" method="post">
                <input type="text" placeholder="Enter a headline for your review here" name="heading" style="width:100% !important;margin:0.1%" required>
                <textarea rows="4" cols="50" placeholder="Enter your review here" name="review" style="width:100%;padding:12px 20px;border-radius:5px;margin: 8px 0;font-family:inherit" required></textarea>   
                <input type="submit" name="revBtn" class="bt" style="background-color:#343a40 !important;width:100%">  
            </form>
        </div>
        <?php
        $con=mysqli_connect("localhost","root","","mydb");
        if(mysqli_connect_errno())
        {
            die("could not connect".mysqli_connect_error());
        }
        else
        {
            if(isset($_POST['revBtn']))
            {
                mysqli_query($con,"select * from rnr where m_id=".$mid." and uemail='".$_SESSION['email']."';");
                if(mysqli_affected_rows($con)>0)
                { 
                    $a=$_POST['review'];
                    $output = shell_exec('python ouuu.py '.$a);
                    $output=(int)$output;
                    mysqli_query($con,"update rnr set Erating=".$output.",review_head= '".mysqli_real_escape_string($con,$_POST['heading'])."', review='".mysqli_real_escape_string($con,$_POST['review'])."', timestamp=NOW() where m_id=".$mid." and uemail='".$_SESSION['email']."';");
                }
                else
                { 
                    $a=$_POST['review'];
                    $output = shell_exec('python ouuu.py '.$a);
                    $output=(int)$output;
                    $s=mysqli_query($con,"insert into rnr (m_id,uemail,review_head,review,timestamp,Erating) values(".$mid.",'".$_SESSION['email']."','".mysqli_real_escape_string($con,$_POST['heading'])."','".mysqli_real_escape_string($con,$_POST['review'])."',NOW(),".$output.");");
                } 
            }
            
        }
        ?>
        <?php include('footer.php');?>
    </body> 
</html>