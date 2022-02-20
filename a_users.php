<?php 
session_start();
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}
if($_SESSION['type']=="U"){
	header("location:index.php?error=1");
}
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
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--<link href="https://fonts.googleapis.com/css?family=David+Libre|Hind:400,700" rel="stylesheet">CSS reset -->

	<!--<link rel="stylesheet" href="css/reset.css">  CSS reset -->
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> <!-- Resource style -->
  	
  	<link rel="icon" href="resources/Untitled-1.png">
	<title>Orders | DailyGrain</title>
</head>
<body>
<header class="cd-auto-hide-header">
        <div class="logo"><a href="#0" id="title" class="lg">DailyGrain</a> Admin</div>

        <nav class="cd-primary-nav">
            <a href="#cd-navigation" class="nav-trigger">
                <span>
                    <em aria-hidden="true"></em>
                    Menu
                </span>
            </a> <!-- .nav-trigger -->

            <ul id="cd-navigation">
                <li><a href="a_dashboard.php">Dashboard</a></li>
                <li><a href="#0"class="active">Users</a></li>
                <li><a href="a_products.php">Products</a></li>
                <li><a href="a_orders.php" >Orders</a></li>
                <li><a href="#0">Logout</a></li>
            </ul>
        </nav> <!-- .cd-primary-nav -->
 </header>

<main class="cd-main-content">
	<div class="full-main-content">
		<h1 id="label-ex-heavy">Users</h1>
		<div class="scrollable-content">
		<?php
			$sql = "SELECT uname, utype FROM users";
					$result = $conn->query($sql);
					if($conn->error){
						die("Error ".$conn->errno.":".$conn->error);
					}
					if($result->num_rows>0){
						while($rows = $result->fetch_assoc()){
						echo'<div class="orders-item">
							<a href="a_user-view.php?user_name='.$rows['uname'].'" class="orders-list-item">'.$rows['uname'].'| '.$rows['utype'].'</a>
						</div>';
						}
					}
		?>


			
			

		</div>
	
		<div id="buttonh">
			<button id="myBtn" class="float-add-btn">+</button>
		</div>
		
	</div><!--end of full-main-content-->
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
			             VALUES('$uname','$pword','$fname','$lname','$adr','$cno','$email','A')";//user type
			            

			            if($conn->query($sql)===TRUE){
			                echo "<p>User added succesfully</p>";
			                header("refresh:1;a_users.php");
			            }else{
			            	$string = $conn->error;
			                echo "<p>Error adding user</p>";
			                echo $conn->error;  
			            }
			        }elseif(isset($_POST['submit'])&& $_POST['pword']!=$_POST['cpass']){
			            echo "<p style='color:red;'>Password Mismatch!</p>";
			        }
			    
			    ?>
    		</div>
</main> <!-- .cd-main-content -->

<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Add Modal Product -->
	  <div id="modal-content" class="form">
	  		<span class="close">&times;</span>
              <h2 class="title-heavy">Add an admin</h2>
                 <form method="post">
                <input type="text" id="form-orange" class="inpt" name="fname" placeholder="First Name" value="<?php echo $fname; ?>" required><br>
                <input type="text" id="form-orange" class="inpt" name="lname" placeholder="Last Name" value="<?php echo $lname; ?>"required><br>
                <input type="text" id="form-orange" class="inpt" name="email" placeholder="Email Address" value="<?php echo $email; ?>"required><br>
                <input type="text" id="form-orange" class="inpt" name="uname" placeholder="Username" value="<?php echo $uname; ?>"required><br>
                <input type="password" id="form-orange" class="inpt" name="pword" placeholder="Password" value="<?php echo $pword; ?>"required><br>
                <input type="password" id="form-orange" class="inpt" name="cpass" placeholder="Re-enter Password" value="<?php echo $cpass; ?>"required>
                <input type="text" id="form-orange" class="inpt" name="adr" placeholder="Address" value="<?php echo $adr; ?>"required><br>
                <input type="text" id="form-orange" class="inpt" name="cno" placeholder="Contact Number" value="<?php echo $cno; ?>"required><br>
                <input type="submit" id="submit" value="Submit" name="submit" class="btn-submit">
            </form>
               

		</div>

	</div>


<footer>
<p id="title" class="ft">DailyGrain</p>
<p>All rights reserved.</p>
</footer>	
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>--->
<script type="text/javascript" src="js/modal.js"></script>
<script>
	if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>