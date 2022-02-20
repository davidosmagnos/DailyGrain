<?php 
	include "config.php";
	session_start();
	@$uname=$_SESSION['uname'];
    if(isset($_POST['dec'])){
    	$id = $_POST['dec'];
    	$sql = "SELECT qty FROM cart WHERE sack_id ='$id'";
    	$result = $conn->query($sql);
    	echo $conn->error;
    	$rows = $result->fetch_array(MYSQLI_ASSOC);
    	if($rows['qty']<5){
    		echo "<script>alert('You cannot order below 5 kilos ')</script>";
    	}else{
    		$val = $rows['qty']-1;
    	$sql = "UPDATE cart SET qty = '$val' WHERE uname='$uname' AND sack_id='$id'";
    	$conn->query($sql);
    	header("refresh:0");
    	}
    }
    if(isset($_POST['inc'])){
    	$id = $_POST['inc'];
    	$sql = "SELECT qty FROM cart WHERE sack_id ='$id'";
    	$result = $conn->query($sql);
    	echo $conn->error;
    	$rows = $result->fetch_array(MYSQLI_ASSOC);
    	$val = $rows['qty']+1;
    	$sql = "UPDATE cart SET qty = '$val' WHERE uname='$uname' AND sack_id='$id'";
    	$conn->query($sql);
    	header("refresh:0");
    }

	if(isset($_GET['error'])){
		if($_GET['error']==1){
			echo "<script>alert('You need to Login first!')</script>";
		}
		elseif($_GET['error']==2){
			echo "<script>alert('You have not chosen a mode of payment yet')</script>";
		}
		elseif($_GET['error']==3){
			echo "<script>alert('Sack is still empty')</script>";
		}
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
  	<link rel="stylesheet" href="css/button.css?v=<?php echo time(); ?>"> <!-- Resource style -->
  	<link rel="icon" href="resources/Untitled-1.png">
	<title>Cart | DailyGrain</title>
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
			<li><a href="index.php">Home</a></li>
			<li><a href="products.php">Products</a></li>
			<li><a href="quiz.php">Take Quiz</a></li>
			<li><a href="#0" class="active">Sack</a></li>
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
	
		<div class="half-main-content" id="order-summary"><!--half-content-->

			  	<div class="order-list">
			  		<div class="order-items"><!--orders-->

						<?php
						    $total = 0;
						      if((isset($_SESSION['loggedin'])&&$_SESSION['loggedin'])){
								$qty = 5;
								$subtotal = 0 ;
								@$sql = "SELECT P.prod_name, C.prod_id,P.prod_price,C.sack_id,C.qty FROM prods P, cart C WHERE P.prod_id = C.prod_id AND C.uname = '$uname' ORDER BY C.sack_id ASC";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($rows = $result->fetch_assoc()){
										$subtotal = $rows['prod_price']*$rows['qty'];
										$total+=$subtotal;
										
										echo '<a href="cart_del.php?sack='.$rows['sack_id'].'"><div class="item">
								<div class="item-desc">
									<div class="item-name">
										<h1 id="label-ex-heavy">'.$rows['prod_name'].'</h1>
									</div>
									<div class="item-price">
										<h1 class="label-heavy">&#8369;'.number_format($subtotal,2).'</h1>
									</div>
								</div>
								<form method="post">
									<p class="qnty-lbl">'.$rows['prod_price'].' x <button type="submit" name="dec" value="'.$rows['sack_id'].'"><</button>&emsp;'.$rows['qty'].'kg&emsp;<button type="submit" name="inc" value="'.$rows['sack_id'].'">></button></p>
								</form>
								</div></a>';
									}
								}else{
									echo "No products added to sack yet";
								}
							}else{
								echo "Please Login First <br>";
								echo '<a href="login.php">Click here to Login</a>';
							}
							
							?>

			  		</div><!--end of orders-->

			  		<div class="bottom-order"><!--total-->			  				
			  			<div class="left-header">
			  				<h1 class="title-heavy">Total:</h1>
			  			</div>
			  			<div class="right-header">
			  				<h1 class="title-light"><?php echo"&#8369;". number_format($total,2); ?></h1>
			  			</div>			  						  			
			  		</div><!--end of total-->

			  	</div>
			  	
			  	
		</div><!--end of halfcontent-->

		<div class="half-main-content" id="order-summary"><!--half-content-->
			  	<div class="customer-info-order">
			  		<form action="checkout.php" method="post" class="btn-form" id="checkout">
			  		<h1 id="label-ex-heavy">Sack Cart</h1>
					  <?php 
					  if(isset($_SESSION['loggedin'])){
					 	$sql = "SELECT * FROM users WHERE uname='$uname'" ;
						$result = $conn->query($sql);
						if($result->num_rows>0){
							$rows=$result->fetch_array(MYSQLI_ASSOC);
						}
					}
					  ?>
			  				<h1 id ="label-light" class="al-il-left">Name:</h1>
			  				<h1 id ="label-heavy" class="al-left"><?php echo (isset($_SESSION['loggedin'])) ? $rows["fname"]." ".$rows['lname']:"Harry Potter";?></h1>
			  				<h1 id ="label-light" class="al-il-left">Address:</h1>
			  				<p id ="label-heavy" class="al-left"><?php echo (isset($_SESSION['loggedin']))? $rows['addr']:"4 Privet Drive, Surrey"; ?></p>
			  				<h1 id ="label-light" class="al-il-left">Type of Payment:</h1>
			  				<div class="radio-toolbar">
							    <input type="radio" id="radioCOD" name="paymentType" value="1">
							    <label for="radioCOD">Cash on Delivery</label>
							    <input type="radio" id="radioGcash" name="paymentType" value="2">
							    <label for="radioGcash">G-cash</label> 
							</div>
							
								<div class="container" onclick="sub()">
								 <div class="left-side-checkout" >
									  <div class="card">
										   <div class="card-line"></div>
										   <div class="buttons"></div>
									  </div>
									  <div class="post">
										   <div class="post-line"></div>
										   <div class="screen">
										    	<div class="dollar">₱</div>
										   </div>
									  </div>
								 </div>
								 <div class="right-side-checkout" name="checkout">
								  <div class="new">Checkout</div>
								  
								   <svg class="arrow" xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 451.846 451.847"><path d="M345.441 248.292L151.154 442.573c-12.359 12.365-32.397 12.365-44.75 0-12.354-12.354-12.354-32.391 0-44.744L278.318 225.92 106.409 54.017c-12.354-12.359-12.354-32.394 0-44.748 12.354-12.359 32.391-12.359 44.75 0l194.287 194.284c6.177 6.18 9.262 14.271 9.262 22.366 0 8.099-3.091 16.196-9.267 22.373z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#cfcfcf"/></svg>
								 
								 </div>
								</div>
							</form>
			  	</div>

			  	<?php
			  		if(isset($_POST['checkout'])){
			  			header("orders.php");
			  		}

			  	?>
			  	
			  	
		</div><!--end of halfcontent-->


	
	
</main> <!-- .cd-main-content -->
<footer>
<p id="title" class="ft">DailyGrain</p>
<p>All rights reserved.</p>
</footer>	
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>--->
<script>
	if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
	
	function sub(){
	    document.getElementById("checkout").submit();
	}
</script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>