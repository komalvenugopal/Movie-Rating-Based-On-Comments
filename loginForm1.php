<div id="loginform" class="modal" >
    <div style="background-color:white;padding:0.3% 5% 0.5% 5%; margin:5% 24.9% 0% 24.93%; border-radius:5px 5px 0 0" class="animate">
        <h3>Login</h3>
    </div> 
    <?php if (isset($login_error)): ?>
        <p style="color: red;"><?php echo $login_error; ?></p>
    <?php endif; ?>

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
session_start(); // Start the session at the beginning of the script

// Check if the form is submitted
if (isset($_POST['loginBtn'])) {
    $uname1 = $_POST['uname'];
    $pswd1 = $_POST['psw'];

    // Database connection
    $con=mysqli_connect("pxukqohrckdfo4ty.cbetxkdyhwsb.us-east-1.rds.amazonaws.com","r42xjjzx0hy6jn0q","bjv1aq1p3q3was3o","uy2phg3cofsy8520");
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepared statement to prevent SQL Injection
    $query = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($con, $query);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $uname1, $pswd1);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            // Set session variables
            $_SESSION['loggedin'] = true;
            $_SESSION['email'] = $user['email']; // Assuming you have an email field

            // Redirect to another page
            header("Location: Login.php");
            exit();
        } else {
            // User not found or password incorrect
            $login_error = "Invalid username or password";
        }
        mysqli_stmt_close($stmt);
    } else {
        $login_error = "Failed to prepare the statement";
    }
    mysqli_close($con);
}
?>   
</div>