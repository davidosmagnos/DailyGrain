<?php 
	session_start();
	include "config.php";
	if(isset($_GET['error'])){
		if($_GET['error']==1){
			echo "<script>alert('You need to Login first!')</script>";
		}
	}
	@$uname = $_SESSION['uname'];
	
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
			<li><a href="#0" class="active">Order Summary</a></li>
			<?php 
                if(@$_SESSION['loggedin']){
                    echo "<li><a href='logout.php'>Logout</a></li>";
                    echo "<li><a href='user-view.php?user_name=".$_SESSION['uname']."'><b>Hi,".$_SESSION['uname']."</b></a></li>";
                }else{
                   echo "<li><a href='login.php'>Login</a></li>
                    ";
                }
            
            ?>
		</ul>
	</nav> <!-- .cd-primary-nav -->
</header> <!-- .cd-auto-hide-header -->

<main class="cd-main-content">
	<div class="full-main-content">
		<h1 id="label-ex-heavy">Orders</h1>
		<div class="scrollable-content">
				<?php 
					if((isset($_SESSION['loggedin'])&&@$_SESSION['loggedin'])){
						$sql = "SELECT DISTINCT ord_id FROM orders WHERE uname='$uname'";
						$result = $conn->query($sql);
						if($result->num_rows>0){
							while($rows = $result->fetch_assoc()){
								echo 
								'<div class="orders-item">
								<a href="view-order.php?id='.$rows['ord_id'].'" class="orders-list-item"> Order#'.$rows['ord_id'].'</a>
							</div>';
							}
						}else{
							echo 
								'<div class="orders-item">
								<p>No orders yet</p>
							</div>';
						}
					}else{
						echo'<div class="orders-item">
								<p>You Need to log in first</p>
								<a href="login.php">Click here to login</a>
							</div>';
					}
				
				?>
			
			
			

		</div>
	
		
	</div><!--end of full-main-content-->
</main> <!-- .cd-main-content -->
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