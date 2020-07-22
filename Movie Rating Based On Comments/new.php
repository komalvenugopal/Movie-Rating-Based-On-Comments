<!DOCTYPE html>

<html>

    <head>
        <title>PHP Syntax</title>
    </head>
    
    <body>
    <form action="" method="POST">  
    <input type="text" name="hello">
    <input type="submit">
    </form> 
<?php
if(isset($_POST["hello"])){
    $a=$_POST["hello"];
    echo $a;
    $output = shell_exec('python ouuu.py '.$a);
    echo $output;
}

?>      
    </body>
</html>
