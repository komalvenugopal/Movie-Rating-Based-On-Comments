<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html>
<head>
        <title>Home</title>
        <link rel="stylesheet" type="text/css" href="nav.css">
        <link rel="stylesheet" type="text/css" href="loginform.css">
        <link rel="stylesheet" type="text/css" href="thumbnail.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
                table{
                        border-collapse: collapse;
                        width: 100%;
                }

                td, th {
                        text-align: left;
                        padding: 8px;
                        color: white;
                        font-size:12px;
        }
        </style>
</head>

<body style="margin:0;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;font-weight: 400;">
        <ul id="l01" ><li class="li01"><a href="Home.php">Home</a></li>
                <!--<li class="li01"><a href="movies.php">Movies</a></li>
                <li class="li01"><a href="mission.html">3</a></li>
                <li class="li01"><a href="vision.html">4</a></li>-->
                <li class="li01" style="float:right"><button onclick="document.getElementById('loginform').style.display='block'" class="li01bt">Login</button></li>
                <li class="li01" style="float:right"><button onclick="document.getElementById('signupform').style.display='block'" class="li01bt">Signup</button></li>  </ul>

        <?php 
                
                include('carousel.php');
                include('loginForm.php');
                include('signUpForm.php');
        ?>
        <div style="margin: 10% 15% 15% 10%;text-align:center;font-size:14px">
           <center> <span style="font-size:40px;font-family:simplifica;"><b>THE BANG</b></span>
            <p><em>We love movies!</em></p></center>
            <p>Find showtimes, watch trailers, browse photos, track your Watchlist and rate your favorite movies and TV shows on your phone or tablet!
                this is an online database of information related to films, television programs, home videos, video games, and streaming content online –
                   including cast, production crew and personal biographies, plot summaries, trivia, fan and critical reviews, and ratings.
                Most data in the database is provided by volunteer contributors. The site enables registered users to submit new material and edits to existing entries. 
                Users with a proven track record of submitting factual data are given instant approval for additions or corrections to cast, credits, and other demographics 
                of media product and personalities. However, image, name, character name, plot summaries, and title changes are supposedly screened before publication, 
                and usually take between 24 and 72 hours to appear.
            </p>
            <br>    
        </div>
        <div style="background-color: rgba(53, 52, 52, 0.87);padding:10px 5px 10px 5px; margin:1% 15% 0% 15%">
        <center>
                <table>
                        <tr>
                        
                                <?php
                                $con=mysqli_connect("localhost","root","","mydb");
                                if(mysqli_connect_errno())
                                {
                                         die("could not connect".mysqli_connect_error());
                                }
                                else
                                {
                                        $movies=mysqli_query($con,"select * from movies;");
                                        if(mysqli_affected_rows($con)>0)
                                        {
                                                $result=mysqli_query($con,"select * from movies;");
                                                for($i=0;$i<3;$i++)
                                                {
                                                        $movie=mysqli_fetch_array($result,MYSQLI_ASSOC);
                                                        echo "
                                                        
                                                        <td>
                                                                <div class=\"container1\">
                                                                        
                                                                        <img src=\"".$movie['img_loc']."\" class=\"thumb\" width=\"200px\" height=\"300px\" alt=\"".$movie['name']."\" >
                                                                        
                                                                        <div class=\"content\">
                                                                                <a href=\"movieP.php?mid=".$movie['m_id']."\" style=\"text-decoration:none;color:white\">
                                                                                ".$movie['name']."</a>
                                                                        </div>
                                                                </div>
                                                        </td>
                                                        ";
                                                }
                                        }

                                }
                                ?>
                        </tr>                       
                        <tr>
                                <td>
                                        <a href="movies.php" style="color:white">Browse Movies>></a>
                                </td>
                        </tr>      
                </table>
        </center>
        </div>
        
</body>
</html>