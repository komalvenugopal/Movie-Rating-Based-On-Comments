<?php
  session_start();
?>  
<!DOCTYPE html>
<html>
<head>
    <title>Artists</title>
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="loginform.css">
    <link rel="stylesheet" type="text/css" href="thumbnail.css">
    <link rel="stylesheet" type="text/css" href="thumbs.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 120px;
            background-color:  rgba(5, 5, 5, 0.911);
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
            position: absolute;
            z-index: 1;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
        .tooltip .tooltiptext::after {
            content: " ";
            position: absolute;
            bottom: 100%;
            left: 50%;
            margin-left: -5px;
            border-width: 5px;
            border-style: solid;
            border-color: transparent transparent rgba(5, 5, 5, 0.911) transparent;
        }
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
    </style>
</head>
<body style="margin:0;background-image: url('<?php
         $con=mysqli_connect("localhost","root","","mydb");
         $img=mysqli_query($con,"SELECT * FROM bg ORDER BY RAND() LIMIT 1");
         $img=mysqli_fetch_array($img,MYSQLI_ASSOC);
         echo $img['bg'];
        ?>
');background-size: 100% 100%; background-attachment: fixed;font-size:14px;font-family: -apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol;font-weight: 400;">
    <ul id="l01" style="z-index:1;position:fixed;top:0;width:100%;">
        <li class="li01"><a href="Login.php">Home</a></li>
        <li class="li01"><a href="movies.php">Movies</a></li>
        <li class="li01"><a href="artist.php">Celebs..</a></li>
        <li class="li01" style="float:right"><a href="profile.php">Profile</a></li>
        <li class="li01" style="float:right"><a href="logout.php">Logout</a></li>
    </ul> 
    <div style="background-color:#343a40;padding:0.3% 5% 0.5% 5%; margin:10% 18% 0% 15%; border-radius:5px 5px 0 0;color:white">
        <h3>Artists</h3>
    </div>
    <div style="background-color:white;color:white;padding:4%; margin:0% 18% 0% 15%; border-radius:0 0 5px 5px">
        <table>
            <?php
                $con=mysqli_connect("localhost","root","","mydb");
                if(mysqli_connect_errno())
                {
                    die("could not connect".mysqli_connect_error());
                }
                else
                {
                    $movies=mysqli_query($con,"select * from artist;");
                    if(mysqli_affected_rows($con)>0)
                    {
                        $result=mysqli_query($con,"select * from artist order by aname asc");
                        $cnt=mysqli_affected_rows($con);
                        for($i=0;$i<ceil($cnt/4);$i++)
                        {
                            echo "<tr>";
                            for($j=0;$j<4;$j++)
                            {
                                $artist=mysqli_fetch_array($result,MYSQLI_ASSOC);
                                if($artist['a_id']!=null){
                                echo "
                                    <td>
                                        <div class=\"container1 tooltip\">
                                        <center>
                                            <img src=\"".$artist['img_loc']."\" width=\"150\" class=\"thumb\" height=\"230\" alt=\"".$artist['aname']."\" >
                                            <div class=\"content\">
                                                <a href=\"artistP.php?aid=".$artist['a_id']."\" style=\"text-decoration:none;color:white\">
                                                ".$artist['aname']."</a>
                                            </div>
                                            <span class=\"tooltiptext\">".$artist['aname']
                                            ."<br>from ".$artist['place']."</span>
                                        </center>
                                        </div>
                                    </td>";
                                }
                            }
                            echo "</tr>";
                        }
                    }
                }
            ?>
        </table>
    </div>
    <?php include('footer.php');?>
</body>