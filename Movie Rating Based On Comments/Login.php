<?php
  session_start();
?>  
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="nav.css">
  <link rel="stylesheet" type="text/css" href="loginform.css">
  <link rel="stylesheet" type="text/css" href="thumbnail.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    table
    {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th 
    {
      text-align: left;
      padding: 8px;
      color: white;
      font-size:12px;
    }
 button{
                    all:unset;
                }
  </style>
</head>
<body style="font-size:14px;margin:0;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;">
  <ul id="l01" style="z-index:1;position:fixed;top:0;width:100%;">
    <li class="li01"><a href="Login.php">Home</a></li>
    <li class="li01"><a href="movies.php">Movies</a></li>
    <li class="li01"><a href="artist.php">Celebs..</a></li>
    <li class="li01"><a href="se2.php">My Reviewers..</a></li>
    <li class="li01"><form action="search.php" method="POST"><input type="text" name="search" placeholder="enter your favorite reviewer......" style="margin-left: 200px;"> <input type="submit" value="S" style="background-color: red;border-radius: 5px; color:black; font-size: 25px; margin-top: 5px;padding-bottom: 5px;  box-shadow: 0px 0px 0px transparent;text-shadow: 0px 0px 0px transparent;"></form></li>
    <li class="li01" style="float:right"><a href="profile.php">Profile</a></li>
    <li class="li01" style="float:right"><a href="logout.php">Logout</a></li>
  </ul> 
  
  <div class="slideshow-container" style="position:relative">
    <div class="mySlides fade">
      <img src="carousel.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <img src="carousel0.jpg" style="width:100%">
    </div>

    <div class="mySlides fade">
      <img src="carousel2.jpg" style="width:100%">
    </div>
  </div>
  
  <div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
  </div>
<script>
  var slideIndex = 0;
  showSlides();
  function showSlides() 
  {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++)
    {
      slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) 
    {
      slideIndex = 1;
    }    
    for (i = 0; i < dots.length; i++) 
    {
      dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 5 seconds
  }
</script>
<div style="margin:5% 15% 5% 15%;text-align:center;font-size:14px">
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
<?php include('footer.php');?>
</body>
</html>