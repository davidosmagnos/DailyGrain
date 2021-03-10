<?php 
include "config.php";
$fname = "";
$lname = "";
$uname = "";
$pword = "";
$cpass = "";
$email = "";
$cno = "";
$adr ="";

if(isset($_POST['submit']) && $_POST['pword']!=$_POST['cpass']){
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $uname = $_POST['uname'];
    $pword = "";
    $cpass = "";
    $email = $_POST['email'];
    $cno = $_POST['cno'];
    $adr = $_POST['adr'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DailyGrain - Sign up</title>
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
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="quiz.php" >Take Quiz</a></li>
            <li><a href="#">Order Summary</a></li>
            <li><a href="#">Sack</a></li>
            <li><a href="#">Login</a></li>
            <li><a href="#" style="color:#ff7252;"><b>Sign in</b></a></li>
        </ul>
        </div>
    </div>
    <div class="container">
        <form method="post" autocomplete="off">
            <h2>We'll need to set you up first.</h2>
            <br><br>
            <input type="text" name="fname" placeholder="First Name" value="<?php echo $fname; ?>"><br>
            <input type="text" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>"><br>
            <input type="text" name="email" placeholder="Email Address" value="<?php echo $email; ?>"><br>
            <input type="text" name="uname" placeholder="Username" value="<?php echo $uname; ?>"><br>
            <input type="password" name="pword" placeholder="Password" value="<?php echo $pword; ?>"><br>
            <input type="password" name="cpass" placeholder="Re-enter Password" value="<?php echo $cpass; ?>">
            <input type="text" name="adr" placeholder="Address" value="<?php echo $adr; ?>"><br>
            <input type="text" name="cno" placeholder="Contact Number" value="<?php echo $cno; ?>"><br>
            <input type="submit" value="Submit" name="submit">
        </form>
        <p><b>if you already have an account, <a href="login.php">Login here</a></b></p>
    </div>
    <div class="mess">
    <?php 
        if(isset($_POST['submit']) && $_POST['pword']==$_POST['cpass']){
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['uname'];
            $pword = $_POST['pword'];
            $cpass = $_POST['cpass'];
            $email = $_POST['email'];
            $cno = $_POST['cno'];
            $adr = $_POST['adr'];

            $sql = "INSERT INTO users(uname,pword,fname,lname,addr,cno,email,utype)
             VALUES('$uname','$pword','$fname','$lname','$adr','$cno','$email','U')";
            

            if($conn->query($sql)===TRUE){
                echo "<p style='color:green;'>Save Successful</p>";
                sleep(4);
                header("location:login.php");
            }else{
                echo "<p style='color:red;>Registration Failed</p>";
                echo $conn->error;  
            }
        }elseif(isset($_POST['submit'])&& $_POST['pword']!=$_POST['cpass']){
            echo "<p style='color:red;'>Password Mismatch!</p>";
        }
    
    ?>
    </div>
   
</body>
</html>