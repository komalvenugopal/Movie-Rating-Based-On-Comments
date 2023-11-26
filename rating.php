<?php session_start();
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
            movie_name
        </title>
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="loginform.css">
        <link rel="stylesheet" type="text/css" href="thumbs.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        .checked {
            color: orange;
        }
        </style>
    </head>
<body style="background-image: url('<?php
         /*$con=mysqli_connect("localhost","root","","mydb");
         $img=mysqli_query($con,"SELECT * FROM movies ORDER BY RAND() LIMIT 1");
         $img=mysqli_fetch_array($img,MYSQLI_ASSOC);
         echo $img['img_loc'];*/echo 'bg.jpg';
    ?>');background-size: 100% 100%; background-attachment: fixed;font-size:14px">
    <?php
        if(!(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true))
        {
            include('loginForm1.php');
            echo "<script>document.getElementById('loginform').style.display='block';</script>";
        }
    ?>
        <ul id="l01">
            <li class="li01"><a href=<?php
                if(isset($_SESSION['loggedin'])&&$_SESSION['loggedin']==true)
                    echo "Login.php";
                else
                echo "Home.php";
        
        
            ?>>Home</a></li>
            <li class="li01"><a href="movies.php">Movies</a></li>
            <li class="li01"><a href="mission.html">3</a></li>
            <li class="li01"><a href="vision.html">4</a></li>
            <li class="li01" style="float:right"><a href="profile.php">Profile</a></li>
            <li class="li01" style="float:right"><a href="logout.php">Logout</a></li>
        </ul>
        <?php 
            /*include('navigation.php');
            include('loginForm.php');*/
            include('signUpForm.php');
        ?>
        <div  style="background-color:white;padding:0.3% 5% 0.5% 5%; margin:5% 18% 0% 15%; border-radius:5px 5px 0 0">
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
            <span style="font-size:200%"><b><?php echo $name;?></b></span><br><?php echo $dur;?>&nbsp;|&nbsp;<?php echo date("M jS, Y", strtotime($rdate));?></p>
            <form method="post" action="">
            <span class="fa fa-star" id="ur" style="color:black;" onclick="change();document.getElementById('stars').style.display='inline-block'"></span>
            <span style="display:none;border:1px solid black; border-radius:3px; padding:1px" id="stars">
                <span class="fa fa-star" id="1" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none'; 
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s1" value="1">
                <span class="fa fa-star" id="2" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s2" value="2">
                <span class="fa fa-star" id="3" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s3" value="3">
                <span class="fa fa-star" id="4" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s4" value="4">
                <span class="fa fa-star" id="5" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s5" value="5">
                <span class="fa fa-star" id="6" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s6" value="6">
                <span class="fa fa-star" id="7" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s7" value="7">
                <span class="fa fa-star" id="8" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s8" value="8">
                <span class="fa fa-star" id="9" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s9" value="9">
                <span class="fa fa-star" id="10" onmouseover="change(this.id)" onclick="document.getElementById('stars').style.display='none';
                document.getElementById('ur').style.color='blue';"></span>
                <input type="hidden" id="s10" value="10">
                <p id="rate"></p>
                <input type="hidden" id="mrating">
            </span>
            </form>

            <script>
                function change(id)
                {
                    var f='';
                    document.getElementById("mrating").value=id;
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
            
            </div>
        </div>
        <div style="background-color:grey;padding:2% 1% 2% 3%; margin:0% 18% 0% 15%; border-radius:0 0 5px 5px">
            <img src='<?php echo $imgloc;?>' class="thumb" style="width:300px;height:400px;float:left;margin:0 5% 3% 0">
            <div style="font-size:14px"><?php echo $des;echo $_SESSION['loggedin'];?></div>
        </div>
    </body> 
</html>