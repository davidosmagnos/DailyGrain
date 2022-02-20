<?php 
session_start();
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}
if($_SESSION['type']=="U"){
	header("location:index.php?error=1");
}
include "config.php";
$user_name = $_GET['user_name'];

$sql = "SELECT * FROM users WHERE uname = '$user_name'";
$result = $conn->query($sql);
if($conn->error){
    die("Error ".$conn->errno.": ".$conn->error);
}
if($result->num_rows>0){
    $rows = $result->fetch_array(MYSQLI_ASSOC);
}

if(isset($_POST['del'])){
    $sql = "DELETE FROM users WHERE uname = '$user_name'";
    $conn->query($sql);
    header("location:a_users.php");
    

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
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav> <!-- .cd-primary-nav -->
 </header>
<style>
    .full-main-content img{
        border-radius: 100%;
        margin-bottom: 20px;
        max-width: 200px;
        min-width: 200px;

    }
</style>
<main class="cd-main-content">
	<div class="full-main-content">
		<h1 class="order-id-title">Hello <?=$rows['uname'];?>!</h1>
		<h1 class="order-total-title">User Type: <?=($rows['utype']=='A')?"Admin":"User";?></h1>
         <img class="view-user-img" src="resources/dp/<?php echo $rows['img']; ?>" alt="Image not found" 
                    onerror="this.onerror=null;this.src='resources/dp/ph.jpg';">
		<div class="order-details">
			<p>Name: <?=$rows['fname'].' '.$rows['lname'];?></p>
			<p>Contact Number: <?=$rows['cno'];?></p>
			<p>Address: <?=$rows['addr']?></p>
		</div>
        <form method="post">
		<div class="order-confirm-btn-layout">
			<button class="btn-confirm" onclick="window.location.href='a_dashboard.php';">Ok</button><!---returns-to-orderlist--->
            <button class="btn-cancel" name="del">Delete</button><!---returns-to-orderlist--->
		</div>
        </form>
		
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