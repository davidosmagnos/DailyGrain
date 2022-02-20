<?php 
include "config.php";
session_start();
?>
<?php     
        if(isset($_POST['submit'])){
            $sql = "SELECT `uname`,`pword`,`utype` FROM users 
            WHERE `uname` = '". $_POST['uname']."'";
            $data = $conn->query($sql);
            if($conn->error){
                echo $conn->error; 
            }
            $row = $data->fetch_array(MYSQLI_ASSOC);
            if($data->num_rows>0){
                if(($row['uname']==$_POST['uname'])&&($row['pword'])==md5($_POST['pword'])){
                    $_SESSION['loggedin'] = true;
                    $_SESSION['uname']= $_POST['uname'];
                    if(strtoupper($row['utype'])=='U'){
                         $_SESSION['type'] = "U";
                        header("location:index.php");
                    }elseif(strtoupper($row['utype'])=='A'){
                        $_SESSION['type'] = "A";
                        header("location:a_dashboard.php");
                    }
                        
                }else{
                    $mess ='<p style="color:red;">Incorrect login credentials</p>';
                }
            }else{
                $mess='<p style="color:red;">User does not exist in the system!</p>';
            }
        }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--<link href="https://fonts.googleapis.com/css?family=David+Libre|Hind:400,700" rel="stylesheet">CSS reset -->

    <!--<link rel="stylesheet" href="css/reset.css">  CSS reset -->
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    
    <link rel="icon" href="resources/Untitled-1.png">
    <title>Login | DailyGrain</title>
</head>
<body>
<header class="cd-auto-hide-header">
    <div class="logo"><a href="#0" id="title" class="lg">DailyGrain</a></div>

    <nav class="cd-primary-nav">
        <a href="#cd-navigation" class="nav-trigger">
            <span>
                <em aria-hidden="true"></em>
                Menu
            </span>
        </a> <!-- .nav-trigger -->

        <ul id="cd-navigation">
            <li><a href="index.php">Home</a></li>
            <li><a href="products.php">Products</a></li>
            <li><a href="quiz.php">Take Quiz</a></li>
            <li><a href="sack-cart.php">Sack</a></li>
            <li><a href="#0">Order Summary</a></li>
            <li><a href="#0" class="active">Login</a></li>
        </ul>
    </nav> <!-- .cd-primary-nav -->
</header> <!-- .cd-auto-hide-header -->
<main class="cd-main-content">
    <div class="center-main">
        <div class="form">
            <form method="post" autocomplete="off">
            <h2 class="title">Almost there, please Login first</h2>
            <br>
            <input type="text" id="form-orange" class="inpt" name="uname" placeholder="Username"><br>
            <input type="password" id="form-orange" class="inpt" name="pword" placeholder="Password" id="pword">
            <input type="submit" value="Log-in" name="submit" class="btn-submit">
            </form>
            <p><b>if you dont have an account, <a href="registration.php" class="a-link">Register here</a></b></p>
        </div>

    </div>
        
    <div class="mess">
    <?php
        if(isset($mess)){
            echo $mess;
        }
    ?>
    </div>
</main>
<footer>
<p id="title" class="ft">DailyGrain</p>
<p>All rights reserved.</p>
</footer>   
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>--->
<script>
    if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
<script>
   function showpass(){
    var pword = document.getElementById("pword");
    if(pword.type=="text"){
        pword.type="password";
    }else if(pword.type=="password"){
        pword.type="text";
    }
   }
</script>
</body>
</html>