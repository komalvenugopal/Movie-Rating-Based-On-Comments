<!DOCTYPE html>
<html>
<head>
    <title>User Info</title>
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="loginform.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 60%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
</style>    
</head>
<body>
    <ul id="l01">
        <li class="li01"><a href="admin.php">ADMIN HOME</a></li>
        <li class="li01"><a href="admin_user.html">USER INFO</a></li>
        <li class="li01"><a href="admin_user.html">MOVIE INFO</a></li>
        <li class="li01"><a href="admin_user.html">CAST INFO</a></li>
    </ul>
    <div style="margin:10% 20% 5% 30%;font-size:14px">
    <b>USER:</b><br><br>
   <!-- <a href="#addu"><button name="addUser" >addUser</button></a>&nbsp;&nbsp;&nbsp;
    <a href="#delu"><button name="delUser" >deleteUser</button></a>&nbsp;&nbsp;&nbsp;
    <a href="#updu"><button name="viewUser">viewUser</button></a>&nbsp;&nbsp;&nbsp;
    <hr>
    -->
    <a name="addu">
    <b>Add User:</b><br>
    <form action=""  method="post">
        <label for="Email"><b>Email</b></label><br>
        <input type="email" style="border-radius:8px" placeholder="Enter email" name="Email" required><br>
        <span id="emailexistsWarning" style="color:red; font-size:12px"></span>

        <label for="fullname" ><b>Full name</b></label><br>
        <input type="text" style="border-radius:7px" placeholder="Enter Full name" name="fullname" required><br>
        <label for="mobile"><b>Mobile Number</b></label><br>
        <input type="text" style="border-radius:7px" placeholder="Enter Mobile Number" name="mobile" required><br>
        <label for="uname"><b>Username</b></label><br>
        <input type="text" style="border-radius:7px" placeholder="Enter Username" name="uname" required><br>
        <span id="userNameExists" style="color:red; font-size:12px"></span>
        <label for="psw"><b>Password</b></label><br>
        <input type="password" style="border-radius:7px" placeholder="Enter Password" name="psw" required><br>
        <button class="bt" type="submit" style="border-radius: 7px;width:50%;" name="signUpBtn">ADD</button>
    </form></a>
    <br><br>
    <b>Delete User:</b><br><br>
    <a name="delu">
    <form action=""  method="post">
        <label for="Email"><b>Email</b></label><br>
        <input type="email" style="border-radius:8px" placeholder="Enter email" name="Email1" required><br>
        <span id="hi" style="color:red; font-size:12px"></span>
        <button class="bt" type="submit" style="border-radius: 7px;width:50%;" name="delUBtn">DELETE</button>
    </form></a><br><br>
    <form action="" method="post">
    <input type="submit" class="bt" style="border-radius: 7px;width:50%;" name="viewBtn" value="VIEW">
    </form>
    </div>
    <?php 

        //$signUpBtn=$_POST['signUpBtn'];
        if(isset($_POST['signUpBtn']))
        {
            $em=$_POST['Email'];
            $uname=$_POST['uname'];
            $mobile=$_POST['mobile'];
            $pswd=$_POST['psw'];
            $fullname=$_POST['fullname'];
        
            $con=mysqli_connect("localhost","root","","mydb");
            if(mysqli_connect_errno())
            {
                die("could not connect".mysqli_connect_error());
            }
            else
            {
                $query=mysqli_query($con,"select *from user where email='".$em."';");
                if(mysqli_affected_rows($con)>0)
                {
                    echo "<script>
                    document.getElementById('emailexistsWarning').innerHTML='Email already exists<br><br>';
                    </script>";    
                }
                else
                {
                    echo "<script>document.getElementById('emailAlreadyExists').innerHTML=''</script>";
                    $query=mysqli_query($con,"select *from user where username='".$uname."';");
                    if(mysqli_affected_rows($con)>0)
                    {
                        echo "<script>
                        document.getElementById('userNameExists').innerHTML='Username already exists<br><br>';
                        </script>";
                    }
                    else
                    {
                        echo "<script>document.getElementById('userNameExists').innerHTML=''</script>";
                        $sql="insert into user values('".$em."','".$uname."',".$mobile.",password('".$pswd."'),'".$fullname."')";
              
                        if ($con->query($sql) === TRUE) 
                        {
                           echo "<script>window.alert('New Record Created Succesfully')</script>";
                        }
                        else 
                        {
                            echo "Error: " . $sql . "<br>" . $con->error;
                        }
                    }
                }      
            }
        }


        if(isset($_POST['delUBtn']))
        {
            $em=$_POST['Email1'];
            $con=mysqli_connect("localhost","root","","mydb");
            if(mysqli_connect_errno())
            {
                die("could not connect".mysqli_connect_error());
            }
            else
            {
                $query=mysqli_query($con,"select *from user where email='".$em."';");
                if(mysqli_affected_rows($con)>0)
                {
                    if (mysqli_query($con,"delete from user where email='".$em."';")) 
                    {
                        echo "<script>window.alert('Deleted Succesfully');</script>";
                    }
                    else 
                    {
                        echo "Error: " . $sql . "<br>" . $con->error;
                    }
                    
                }
                else
                {
                    echo "<script>
                    document.getElementById('hi').innerHTML='user doesnt exist<br><br>';
                    </script>";
                }
            }
        }
        if(isset($_POST['viewBtn']))
        {
            $con=mysqli_connect("localhost","root","","mydb");
            if(mysqli_connect_errno())
            {
                die("could not connect".mysqli_connect_error());
            }
            else
            {
                $query=mysqli_query($con,"select *from user;");
                if(mysqli_affected_rows($con)>0)
                {

                    $result=mysqli_query($con,"select * from user");
                    echo "
                    <center>
                    <table style=\"border: 1px solid black; text-align:center;cell-spacing:0\">
                            <tr>
                                <th>Email</th> 
                                <th>User Name</th> 
                                <th>Mobile Number</th> 
                                <th>Full Name</th>
                            </tr>";
                    while( $array=mysqli_fetch_array($result,MYSQLI_ASSOC))
                    {
                        echo"
                            <tr>
                                <td>".$array['email']."</td>
                                <td>".$array['username']."</td>
                                <td>".$array['mobile']."</td>
                                <td>".$array['fullname']."</td>
                            </tr>
                        ";
                    }
                    echo"
                    </table>
                        </center>
                        ";
                    
                }
                else{
                    echo "</table>
                        <h4>No Users Registered</h4>
                        ";
                }

            }
        }
    
    ?>

</body>
</html>