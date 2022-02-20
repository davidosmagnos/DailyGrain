<?php 
session_start();
$uname = @$_SESSION['uname'];
include "config.php";
if(isset($_POST['del'])){
	$sack = $_POST['del'];
	$sql = "DELETE FROM cart WHERE sack_id = '$sack'";
	$conn->query($sql);
	header("refresh:0");
}
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
			<li><a href="#0" class="active">Products</a></li>
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
	<div class="row">

		<div class="col">
			<div class="grid-container" id="products">
				<?php 
					$sql = "SELECT * FROM prods";
					$result = $conn->query($sql);
					if($conn->error){
						die("Error ".$conn->errno.":".$conn->error);
					}
					if($result->num_rows>0){
						while($rows = $result->fetch_assoc()){
                            $st = "";
                            if($rows["prod_stock"]<=5){ $st = "disabled";}else{$st = " ";}
							echo '<div class="item1">
									<a href="view-product.php?prod_id='.$rows['prod_id'].'">
									<div class="prod-pic"><!--product picture-->
										<img src="resources/'.$rows["image"].'" class="prod-img"><!--db-->
									</div>
			  
									<div class="prod-details"><!--product information-->
											<div class="prod-info">
												<h1 class="name-products">'.$rows['prod_name'].'</h1><!--db-->
												<h1 class="prod-info-details">'.$rows['sticky']."-".$rows['tender']."-".$rows['cook']."-".$rows['color'].'</h1><!--db-->
											</div>
									</div></a>
									<form method="post" class="btn-form">
										<button class="add-to-cart" id="products-btn" type="submit" name="sub" value='.$rows['prod_id'].' '.$st.'>'.$rows['prod_price'].'/kg <span class="price-btn">+</span></button>
									</form>
								</div>';
						}
					}
				?>
				
			  </div><!--end of grid-container-->
		</div><!--end of column-->

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
							<p class="cart-item">
								<?php 
								$total = 0.0;
								if((isset($_SESSION['loggedin']) && $_SESSION['loggedin'])){
									@$sql = "SELECT P.prod_name, C.prod_id,P.prod_price,C.sack_id FROM prods P, cart C WHERE P.prod_id = C.prod_id AND C.uname = '$uname' ORDER BY C.sack_id ASC";
									$result = $conn->query($sql);
									if($result->num_rows>0){
										echo "<form method='post'>";
										echo "<table style='width:100%;'>";
										while($rows = $result->fetch_assoc()){
											$total+=$rows['prod_price'];
											echo 
											'<tr>
												<td><b>'.$rows["prod_name"].'</b></td>
												<td><b>'.$rows["prod_price"].'</b></td>
												<td><b><button type="submit" name="del" value="'.$rows['sack_id'].'">&times;</button></b></td>
											</tr>';
										}
										echo "</form>";
										echo '</table>';

									}else{
										echo "No products added to sack yet";
									}

								}else{
									echo "Please Login First <br>";
									echo '<a href="login.php">Click here to Login</a>';
								}

								?>
							</p>

						</div>
						<div class="total">
							<h1>Total: <?php echo $total; ?></h1> 
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