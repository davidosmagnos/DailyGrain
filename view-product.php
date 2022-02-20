<?php 
session_start();
include "config.php";
$prod_id = $_GET['prod_id'];

$sql = "SELECT * FROM prods WHERE prod_id = '$prod_id'";
$result = $conn->query($sql);
if($conn->error){
	die("Error ".$conn->errno.": ".$conn->error);
}
if($result->num_rows>0){
	$rows = $result->fetch_array(MYSQLI_ASSOC);
}
$uname = @$_SESSION['uname'];
?>
<!doctype html>
<html lang="en" class="no-js">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> <!-- Resource style -->
  	
  	<link rel="icon" href="resources/Untitled-1.png">
	<title>Products</title>
	<style>
	.cart-list table tr:hover{
		background-color: #909090;
		border: solid 2px #909090;
	}
	.cart-list button{
		background-color: transparent;
		border: none;
		font-size: 20px;
		width: 100%;
	}
	.cart-list button:hover{
		cursor:pointer;
	}
	.cart-list button:focus{
		outline-width: 0;
	}
</style>
</head>
<body>
<header class="cd-auto-hide-header">
	<div class="logo"><a href="index.php" id="title" class="lg">DailyGrain</a></div>

	<nav class="cd-primary-nav">

		<ul id="cd-navigation">
			<li><a href="index.php">Home</a></li>
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

			  	<div class="view-item">
			  		<div class="view-prod-img-layout">
			  			<img src="resources/<?php echo $rows['image'] ?>"class="view-prod-img"><!--db-->
			  		</div>
			  		<h1 class="item-title-hvy"><?php echo $rows['prod_name'] ?></h1>
			  		<div class="view-prod-details">
			  			<h1 class="item-info-details"><?php echo $rows['sticky']," | ",$rows['tender']," | pang-",$rows['cook']," | ",$rows['color']." rice"; ?></h1><!--db-->
			  		</div>
			  		
			  		
					<form method="post" class="btn-form">
				  		<button class="add-to-cart" id="view-add-products-btn" type="submit" value="<?php echo $rows['prod_id'] ?>" name="sub"><?php echo $rows['prod_price'] ?> /kg<span class="price-btn">+</span></button>
					</form>
				  </div>

				  <?php 
			if(isset($_POST['sub'])){
				if(!isset($_SESSION['uname'])){
					echo "<script>alert('You need to have an account first');</script>";
				}else{
					$id = $_POST['sub'];
					$sql ="INSERT INTO cart(uname,prod_id) VALUES('$uname','$id')";
					if($conn->query($sql)===FALSE){
						die($conn->error);
					}
				}
			}
		
		?>


		<div class="col2">
			<div class="row">
				<div class="col">
					<h1 class="title-light">Sack Cart</h1>
					<!--shopping-cart-->
					<div id="shop-cart">
						<div class="cart-list">
						<?php 
								$total = 0.0;
								if((isset($_SESSION['loggedin'])&&$_SESSION['loggedin'])){
									@$sql = "SELECT P.prod_name, C.prod_id,P.prod_price FROM prods P, cart C WHERE P.prod_id = C.prod_id AND C.uname = '$uname' ORDER BY C.sack_id ASC";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										echo "<table style='width:100%;'>";
										while($rows = $result->fetch_assoc()){
											$total+=$rows['prod_price'];
										echo 
											'<tr>
												<td>'.$rows["prod_name"].'</td>
												<td>'.$rows["prod_price"].'</td>
											</tr>';
										
										}
										echo '</table>';

									}else{
										echo "No products added to sack yet";
									}

								}else{
									echo "Please Login First <br>";
									echo '<a href="login.php">Click here to Login</a>';
								}
									
								
								?>

						</div>
						<div class="total">
							<h1>Total: <?php echo $total ?></h1> 
						</div>
						
					</div><!--end of shopping cart-->
				</div>

				<div class="col">
						<h1 class="title-heavy" id="info-sided">Don't know what's best rice for you? </h1>
						<p id="info-sided2" class="title-light">Try our quiz to know what rice that suits your lifestyle!</p>
				</div>
				
			</div>


		</div><!--end of column-->

	</div><!--end of row-->
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