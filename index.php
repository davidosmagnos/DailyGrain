<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyGrain - Home</title>
    <link rel="icon" href="resources/Untitled-1.png">
    <link rel="stylesheet" href="css/style_regform.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,300;0,600;0,700;0,800;1,400;1,700&display=swap" rel="stylesheet">  
</head>
<body>
  <div class="head">
        <h1>DailyGrain</h1>
        <div class="links">
        <ul>
            <li><a href="#" style="color:#ff7252;"><b>Home</b></a></li>
            <li><a href="#">Products</a></li>
            <li><a href="quiz.php" >Take Quiz</a></li>
            <li><a href="#">Order Summary</a></li>
            <li><a href="#">Sack</a></li>
            <?php 
                if(@$_SESSION['loggedin']){
                    echo "<li><a href='logout.php'>Logout</a></li>";
                    echo "<li><b>Hi,".$_SESSION['uname']."</b></li>";
                }else{
                   echo "<li><a href='login.php'>Login</a></li>
                    <li><a href='registration.php'>Sign in</a></li>";
                }
            
            ?>
           
        </ul>
        </div>
    </div>