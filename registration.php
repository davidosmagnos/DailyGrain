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
	<meta name="viewport" content="width=device-width, initial-scale=1">

	
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> <!-- Resource style -->
  	
	<link rel="icon" href="resources/Untitled-1.png">
	<title>Sign-up | DailyGrain</title>
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
	            <li><a href="orders.php">Order Summary</a></li>
	            <li><a href="#0" class="active">Login</a></li>
	        </ul>
	    </nav> <!-- .cd-primary-nav -->
	</header>
    <main class="cd-main-content">
        <div class="center-main">
        <div class="form">
            <form method="post" autocomplete="off">
                <h2 class="title">We'll need to set you up first.</h2>
                <br><br>
                <input type="text" id="form-orange" class="inpt" name="fname" placeholder="First Name" value="<?php echo $fname; ?>"><br>
                <input type="text" id="form-orange" class="inpt" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>"><br>
                <input type="text" id="form-orange" class="inpt" name="email" placeholder="Email Address" value="<?php echo $email; ?>"><br>
                <input type="text" id="form-orange" class="inpt" name="uname" placeholder="Username" value="<?php echo $uname; ?>"><br>
                <input type="password" id="form-orange" class="inpt" name="pword" placeholder="Password" value="<?php echo $pword; ?>"><br>
                <input type="password" id="form-orange" class="inpt" name="cpass" placeholder="Re-enter Password" value="<?php echo $cpass; ?>">
                <input type="text" id="form-orange" class="inpt" name="adr" placeholder="Address" value="<?php echo $adr; ?>"><br>
                <input type="text" id="form-orange" class="inpt" name="cno" placeholder="Contact Number" value="<?php echo $cno; ?>"><br>
                <input type="submit" value="Submit" name="submit" class="btn-submit">
            </form>
                <p><b>if you already have an account, <a href="login.php" class="a-link">Login here</a></b></p>

        </div>
       
    </div>
    <div class="mess">
    <?php 
        if(isset($_POST['submit']) && $_POST['pword']==$_POST['cpass']){
            $fname = ucfirst($_POST['fname']);
            $lname = ucfirst($_POST['lname']);
            $uname = $_POST['uname'];
            $pword = md5($_POST['pword']);
            $cpass = $_POST['cpass'];
            $email = $_POST['email'];
            $cno = $_POST['cno'];
            $adr = $_POST['adr'];
                $sql = "INSERT INTO users(uname,pword,fname,lname,addr,cno,email,utype)
                VALUES('$uname','$pword','$fname','$lname','$adr','$cno','$email','U')";//user type
                if($conn->query($sql)===TRUE){
                    echo "<p style='color:green;'>Save Successful</p>";
                }else{
                    echo "<p style='color:red;>Registration Failed</p>";
                    echo $conn->error;  
                }
               
        }elseif(isset($_POST['submit'])&& $_POST['pword']!=$_POST['cpass']){
            echo "<p style='color:red;'>Password Mismatch!</p>";
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
</body>
</html>