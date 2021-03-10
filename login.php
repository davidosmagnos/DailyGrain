<?php 
include "config.php";
session_start();
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
            <li><a href="quiz.php" >Take Quiz</a></li>
            <li><a href="#">Order Summary</a></li>
            <li><a href="#">Sack</a></li>
            <li><a href="#" style="color:#ff7252;"><b>Login</b></a></li>
            <li><a href="#">Sign up</a></li>
        </ul>
        </div>
    </div>
    <div class="container">
        <form method="post" autocomplete="off">
            <h2>Almost there, please Login first</h2>
            <br>
            <input type="text" name="uname" placeholder="Username"><br>
            <input type="password" name="pword" placeholder="Password" id="pword"><button onmousedown="showpass()" type="button" id="show">👁</button>
            <input type="submit" value="Submit" name="submit">
        </form>
        <p><b>if you dont have an account, <a href="registration.php">Register here</a></b></p>
    </div>
    <div class="mess">
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
                if(($row['uname']==$_POST['uname'])&&($row['pword'])==$_POST['pword']){
                    $_SESSION['loggedin'] = true;
                    $_SESSION['uname']= $_POST['uname'];
                    if(strtoupper($row['utype'])=='U'){
                        $_SESSION['type'] = "U";
                    }elseif(strtoupper($row['type'])=='A'){
                        $_SESSION['type'] = 'A';
                    }
                        header("location:index.php");
                }else{
                    echo '<p style="color:red;">Incorrect login credentials</p>';
                }
            }else{
                echo '<p style="color:red;">User does not exist in the system!</p>';
            }
        }
    ?>
    </div>
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