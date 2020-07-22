<div id="loginform" class="modal" >
    <div style="background-color:white;padding:0.3% 5% 0.5% 5%; margin:5% 24.9% 0% 24.93%; border-radius:5px 5px 0 0" class="animate">
        <h3>Login</h3>
    </div> 
    <form class="modal-content animate" style="margin-top:0;background-color:grey;border-radius:0 0 5px 5px" action="" method="post">
        <div class="container" style="border-radius:5px;margin:30px"> 
            <label for="uname"><b>Username</b></label><br>
            <input type="text" placeholder="Enter Username" name="uname" required><br>
            <span id="unameDoesntExist" style="color:red;font-size:12px"></span>
            <label for="psw"><b>Password</b></label><br>
            <input type="password" placeholder="Enter Password" name="psw" required><br>
            <button class="bt" type="submit" name="loginBtn">Login</button><br>
            <a onclick="document.getElementById('signupform').style.display='block'" style="color:white;cursor:pointer">Not a User?</a>
        </div>
    </form>
    <?php 
        $uname1="";
        $pswd1="";
        if(isset($_POST['loginBtn']))
        {
            $uname1=$_POST['uname'];
            $pswd1=$_POST['psw'];
            $con=mysqli_connect("localhost","root","","mydb");
            if(mysqli_connect_errno())
            {
                die("could not connect".mysqli_connect_error());
            }
            else
            {
                $query=("select * from user where username='".$uname1."';");
                mysqli_query($con,$query);
                if(mysqli_affected_rows($con)>0)
                {
                    $query="select *from user where username='".$uname1."' and password=PASSWORD('".$pswd1."');";
                    $result=mysqli_query($con,$query);
                    $array=mysqli_fetch_array($result,MYSQLI_ASSOC);
                    if(mysqli_affected_rows($con)>0)
                    {
                        //echo("Login Succesful");
                        $_SESSION['loggedin']=true;
                        $_SESSION['email']=$array['email'];
                        exit(header("Location:Login.php"));
                        ob_end_flush();
                    }
                }
                else
                {
                    echo "<script>
                    document.getElementById('unameDoesntExist').innerHTML='User Doesn't exist';
                    </script>";
                }  
            }
        }
        else
        {
            echo "<script>
            document.getElementById('unameDoesntExist').innerHTML='';
            </script>";
        }
    ?>
</div>