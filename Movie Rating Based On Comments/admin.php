<!DOCTYPE html>
<html>
<head>
    <?php
        session_start();
    ?>
    <title>Admin Home</title>
    <link rel="stylesheet" type="text/css" href="nav.css">
    <link rel="stylesheet" type="text/css" href="loginform.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <ul id="l01">
        <li class="li01"><a href="#">ADMIN HOME</a></li>
    </ul>
    <div style="margin:10% 20% 5% 30%;font-size:14px">
    <form action="admin_user.php" method="post">
        <center>
            <button class="bt" type="submit" style="border-radius: 7px;width:50%;" name="userInfo">USER INFO</button>
            <button class="bt" type="submit" style="border-radius: 7px;width:50%;" name="userInfo">MOVIE INFO</button>
            <button class="bt" type="submit" style="border-radius: 7px;width:50%;" name="userInfo">USER INFO</button>
        </center>
    </form>
    </div>
</body>

</html>