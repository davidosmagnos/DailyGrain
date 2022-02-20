<?php 
	session_start();
	if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
		header("location:orders.php?error=1");
		exit();
	}
	include "config.php";
	$ord_id = $_GET['id'];
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
<?php 
		$allowed = array("shipped,delivered,cancelled");
		$total = 0;
		$name ="";
		$add = "";
		$mop = "";
		$names = array();
		$prices = array();
		$quantity = array();
		$sql = "SELECT * FROM orders O, users U, prods P WHERE O.uname = U.uname AND ord_id = '$ord_id' AND P.prod_id = O.prod_id";
		$result = $conn->query($sql);
		if($conn->error){
			die($conn->error);
		}
		if($result->num_rows > 0){
			while($rows = $result->fetch_assoc()){
				$total += $rows['qty'] * $rows['price'];
				$name = $rows['fname']." ".$rows['lname'];
				$add = $rows['addr'];
				$mop = $rows['mop'];
				$names[] = $rows['prod_name'];
				$quantity[] = $rows['qty'];
				$prices[] = $rows['price'];
				$stat = $rows['stat'];
				$_SESSION['stat'] = $stat;
				$eta = date_create($rows['eta']);
				$date = date_create($rows['date']);
			}
		}
		if($conn->error){
			echo $conn->error;
		}

		if(isset($_POST['cancel'])){
			if(in_array($stat,$allowed)){
				echo" <script>alert('You cannot cancel this order anymore!')</script>";
			}else{
				$sql = "UPDATE orders SET stat = 'cancelled' WHERE ord_id = '$ord_id'";
				if($conn->query($sql)===FALSE){
					die($conn->error);
				}
			}
		}
?>
<main class="cd-main-content">
	<div class="full-main-content">
		<h1 class="order-id-title">Order ID#<?php echo $ord_id; ?></h1>
		<h1 class="order-total-title">Total Amount:<?php echo"&#8369;". number_format($total,2) ?></h1>
		<h1 class="order-total-title">Products:</h1>
		<div class="order-details">
		<style>
			table{
				border-collapse: collapse;
				width: 20%;
			}
			p{
				padding:0;
				margin:0;
			}
		</style>
			<?php 
				echo "<table>";
				for($i=0;$i<count($names);$i++){
					echo '<tr>
						<td><b><p>'.$names[$i].'</p></b></td>
						<td><b><p>&#8369;'.number_format($prices[$i],2).'</p></b></td>
						<td><b><p>&times;</p></b></td>
						<td><b><p>'.$quantity[$i].'</p></b></td>
					</tr>';
				}
				echo "</table><br>";
				if($stat== 'delivered'){
					$color = '#5cbd2f';
				}elseif($stat=='pending'){
					$color = "#d9d8c3";
				}elseif($stat=='processed'){
					$color = "#e0bb36";
				}elseif($stat=='shipped'){
					$color = "#f7a839";
				}elseif($stat=='cancelled'){
					$color = "#a31000";
				}
			?>
			<p>Name: <?php echo $name; ?></p>
			<p>Address: <?php echo $add; ?></p>
			<p>Mode of Payment: <?php echo ($mop==1)?"Cash on Delivery":"GCash"; ?></p>
			<p>Order made on: <?php echo date_format($date,'F d, Y'); ?></p>
			<p>Estimated Time of Delivery: <?php echo date_format($eta,'F d, Y')." onwards"; ?></p>
			<div class="radio-toolbar">
			<input type="radio" name="stat" id="" checked>
			<label for="stat" style="background-color:<?php echo $color; ?>"><?= ucfirst($_SESSION['stat']); ?></label>
			</div>
		</div>
		<div class="order-confirm-btn-layout">
			<form method="post">
			<a href="orders.php"><button class="btn-confirm" type="button">Ok</button><!---returns-to-orderlist--->
			<button class="btn-cancel" type="submit" name="cancel">Cancel</button>
			</form>
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