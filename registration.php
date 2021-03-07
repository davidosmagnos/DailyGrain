<?php 
//include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_regform.css">
</head>
<body>
  <div class="head">
        <h1>DailyGrain</h1>
        <div class="links">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#" style="color:#ff7252;"><b>Take Quiz</b></a></li>
            <li><a href="#">Order Summary</a></li>
            <li><a href="#">Sack</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
        </div>
    </div>
    <div class="container">
        <form method="post">
            <h2>We'll need to set you up first.</h2>

            <input type="text" name="fname" placeholder="First Name">
            <input type="text" name="lname" placeholder="Last Name">
        </form>
    </div>
</body>
</html>