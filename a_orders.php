<?php
session_start();
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}
if($_SESSION['type']=="U"){
	header("location:index.php?error=1");
}
include "config.php";
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
                <li><a href="a_users.php">Users</a></li>
                <li><a href="a_products.php">Products</a></li>
                <li><a href="#0" class="active">Orders</a></li>
                <li><a href="#0">Logout</a></li>
            </ul>
        </nav> <!-- .cd-primary-nav -->
 </header>

<main class="cd-main-content">
	<div class="full-main-content">
		<h1 id="label-ex-heavy">Orders</h1>
		<div class="scrollable-content">
			<?php
				$sql = "SELECT DISTINCT O.ord_id, O.qty, O.stat, U.utype FROM orders O, users U WHERE O.uname = U.uname AND stat <> 'delivered'";
						$result = $conn->query($sql);
						if($conn->error){
							die("Error ".$conn->errno.":".$conn->error);
						}
						if($result->num_rows>0){
							while($rows = $result->fetch_assoc()){
							echo'<div class="orders-item">
								<a href="a_order-view.php?id='.$rows['ord_id'].'" class="orders-list-item">'.$rows['ord_id'].'| '.$rows['utype'].'| '.$rows['stat'].'</a>
							</div>';
							}
						}else{
							echo'<div class="orders-item">
								<a href="a_order-view.php?#0 class="orders-list-item">No orders yet</a>
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