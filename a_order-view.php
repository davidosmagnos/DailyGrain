<?php 
session_start();
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}
if($_SESSION['type']!="A"){
	header("location:index.php?error=1");
}
include "config.php";
$ord_id = $_GET['id'];

//$uname = $_SESSION['uname'];
?>
 <?php 
		$total = 0;
		$name ="";
		$add = "";
		$mop = "";
		$names = array();
		$prices = array();
		$quantity = array();
		$uname = "";
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
				$_SESSION['stat'] = $rows['stat'];
				$eta = date_create($rows['eta']);
				$date = date_create($rows['date']);
				$uname = $rows['uname'];
			}
		}else{
            echo "No Orders";
        }


?>
<?php if(isset($_POST['updt_ord'])){
			$os = $_POST['ord_status'];
			$_SESSION['stat'] = $os;
			$sql = "UPDATE orders SET stat = '$os' WHERE ord_id='$ord_id' AND uname = '$uname'";
			if($conn->query($sql)===FALSE){
				die($conn->error);
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
  	
  	<link rel="icon" href="resources/Untitled-1.png">
	<title>Home | DailyGrain</title>
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
</head>
<body>
<header class="cd-auto-hide-header">
        <div class="logo"><a href="a_dashboard.php" id="title" class="lg">DailyGrain</a> Admin</div>

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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav> <!-- .cd-primary-nav -->
 </header>
<main class="cd-main-content">
	<div class="full-main-content">
	<h1 class="order-id-title">Order ID#<?php echo $ord_id; ?></h1>
		<h1 class="order-total-title">Total Amount:<?php echo"&#8369;". number_format($total,2) ?></h1>
		<h1 class="order-total-title">Products:</h1>
		<div class="order-details">
		
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
				echo "</table><br>"
			?>
			<p>Name: <?php echo $name; ?></p>
			<p>Address: <?php echo $add; ?></p>
			<p>Mode of Payment: <?php echo ($mop==1)?"Cash on Delivery":"GCash"; ?></p>
			<p>Order made on: <?php echo date_format($date,'F d, Y'); ?></p>
			<p>Estimated Time of Delivery: <?php echo date_format($eta,'F d, Y')." onwards"; ?></p>
			
			<form method="post" class="btn-form">
			<div class="radio-toolbar">
				<input type="radio" id="radioPending" name="ord_status" value="pending" <?php echo ($_SESSION['stat']=="pending")?"checked":"";?>>
				<label for="radioPending">Pending</label>

				<input type="radio" id="radioProcess" name="ord_status" value="processed" <?php echo ($_SESSION['stat']=="processed")?"checked":"";?>>
				<label for="radioProcess">Processed</label>

				<input type="radio" id="radioShipped" name="ord_status" value="shipped" <?php echo ($_SESSION['stat']=="shipped")?"checked":"";?>>
				<label for="radioShipped">Shipped</label> 

				<input type="radio" id="radioDelivered" name="ord_status" value="delivered" <?php echo ($_SESSION['stat']=="delivered")?"checked":"";?>>
				<label for="radioDelivered">Delivered</label> 

				<input type="radio" id="radioCancel" name="ord_status" value="cancelled" <?php echo ($_SESSION['stat']=="cancelled")?"checked":"";?>>
				<label for="radioCancel">Cancelled</label> 
				</div>
			</div>
		<div class="order-confirm-btn-layout">
				<button class="btn-confirm" type="submit" name="updt_ord">Update</button><!---updates order--status-->
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