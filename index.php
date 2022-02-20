<?php 
	session_start();
	include "config.php";
	if(!isset($_SESSION['uname'])&& @$_SESSION['loggedin']){
		header("location:logout.php");
	}
	if(isset($_GET['error'])&&$_GET['error']==1){
		echo '<script>alert("You do not have Access in this page!")</script>';
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
	<title>Home | DailyGrain</title>
</head>
<body>
<header class="cd-auto-hide-header">
	<div class="logo"><a href="index.php" id="title" class="lg">DailyGrain</a></div>

	<nav class="cd-primary-nav">
		<a href="#cd-navigation" class="nav-trigger">
			<span>
				<em aria-hidden="true"></em>
				Menu
			</span>
		</a> <!-- .nav-trigger -->

		<ul id="cd-navigation">
			<li><a href="#0"class="active">Home</a></li>
			<li><a href="products.php">Products</a></li>
			<li><a href="quiz.php">Take Quiz</a></li>
			<li><a href="sack-cart.php">Sack</a></li>
			<li><a href="orders.php">Order Summary</a></li>
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
	<div class="top-content">
		<div class="grid-container" id="best-sellers"><!--grid-container-->
				<?php 
					$sql = "SELECT * FROM prods ORDER BY sold DESC LIMIT 4";
					$result = $conn->query($sql);
					if($result->num_rows>0){
						while($rows=$result->fetch_assoc()){
							echo'	<div class="item1">
							<a href=view-product.php?prod_id='.$rows['prod_id'].'>
							<div class="prod-pic"><!--product picture-->
								<img src="resources/'.$rows['image'].'" class="prod-img">
							</div>
							<div class="prod-details"><!--product information-->
								<p class="details">'.$rows['prod_name'].'</p>
							</div></a>
						</div>';
						}
					}
				?>
			  
			  
		</div><!--end of grid-container-->

	</div><!--end of top-content-->
	<div class="bottom-content">
		<h1 class="title-heavy">All time favorites</h1>
		<p class="title-light" id="info-center">DailyGrain is most happy to serve you quality rice from different parts of the Philippines, We have different kinds of rice for you, <a href="quiz.php"><b>Take the quiz</b></a> now to know what suits you best!<br>"Rice is the best, the most nutritive and unquestionably the most widespread staple in the world." ~ Auguste Escoffier</p>
		<a href="products.php" class="a-itlc" style="color:purple"><b>See more products</b></a><br>
		
	</div><!--end of bottom-content-->
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