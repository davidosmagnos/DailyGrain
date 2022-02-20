<?php 
session_start();
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}

include "config.php";
$user_name = $_SESSION['uname'];

$sql = "SELECT * FROM users WHERE uname = '$user_name'";
$result = $conn->query($sql);
if($conn->error){
    die("Error ".$conn->errno.": ".$conn->error);
}
if($result->num_rows>0){
    $rows = $result->fetch_array(MYSQLI_ASSOC);
}
?>
<?php 
    if(isset($_POST['ok'])){
            $filename=$_FILES['image']['name'];
            $temp = $_FILES['image']['tmp_name'];
            @$type = explode(".",$filename)[1];
            $type = strtolower($type);
            $error = $_FILES['image']['error'];
            $ext = array("jpg","jpeg");
                if(!empty($filename)){
                    if(in_array($type,$ext)){
                        if($error===0){
                            $newFn =strtolower($user_name).".".$type;
                            $newFn = str_replace(" ","",$newFn);
                            $destination = "resources/dp/".$newFn;
                            $sql = "UPDATE users SET img = '$newFn' WHERE uname ='$user_name'";
                            if($conn->query($sql)==true){
                                if(file_exists($destination)){
                                    unlink($destination);
                                    move_uploaded_file($temp,$destination);
                                    header("refresh:0");
                                }else{
                                    move_uploaded_file($temp,$destination);
                                    header("refresh:0");
                                }
                                echo '<p style="color:green;">Succesful</p>';
                            }else{
                                 $mess="<p style='color:red;'>Error Adding Product</p>";
                            }
                        }
                        else{
                             $mess="<p style='color:red;'>Error occured while uploading</p>";
                        }
                    }
                    else{
                         $mess="<p style='color:red;'>Invalid Filetype</p>";
                    }
                }
                else{
                     $mess='<p style="color:red;">No image selected</p>';
                }
            }
    
?>
<?php 
            if(isset($_POST['uppass'])){
                if(md5($_POST['pass'])==$rows['pword'] && !empty($_POST['pass'])){
                    if($_POST['npass']==$_POST['rnpass'] && (!empty($_POST['npass'] && !empty($_POST['rnpass'])))){
                        $sql = 'UPDATE users SET pword="'.md5($_POST['npass']).'" WHERE uname="'.$user_name.'"';
                        if($conn->query($sql)===FALSE){
                            die($conn->error);
                        }
                    }
                }
                header('location:user-view.php?user_name='.$rows['uname']);
            }
            if(isset($_POST['upuname'])){
                if($_POST['uname']!=""){
                    $sql = 'SELECT * FROM orders WHERE uname = "'.$user_name.'"';
                $result = $conn->query($sql);
                if($result->num_rows>0){
                    $sql1 = 'UPDATE orders SET uname="'.$_POST['uname'].'" WHERE uname="'.$user_name.'"';
                    $conn->query($sql1);
                }
                    $sql = 'UPDATE users SET uname="'.$_POST['uname'].'" WHERE uname="'.$user_name.'"';
                    $_SESSION['uname'] = $_POST['uname'];
                    if($conn->query($sql)===FALSE){
                        die($conn->error);
                }
                
                
                        
                header("refresh:0");
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
			<li><a href="sack-cart.php">Sack</a></li>
			<li><a href="orders.php">Order Summary</a></li>
            <?php 
                if(@$_SESSION['loggedin']){
                    echo "<li><a href='logout.php'>Logout</a></li>";
                    echo "<li><a href='user-view.php?user_name=".$_SESSION['uname']."'class='active'><b>Hi,".$_SESSION['uname']."</b></a></li>";
                }else{
                   echo "<li><a href='login.php'>Login</a></li>
                    ";
                }
            
            ?>
		</ul>
	</nav> <!-- .cd-primary-nav -->
</header> <!-- .cd-auto-hide-header -->
<style>
   
    }
</style>
<script>
  
  
</script>
        
<main class="cd-main-content">
	<div class="full-main-content">
		<h1 class="order-id-title">Hello <?=$rows['uname'];?>!</h1>
        <img class="view-user-img" src="resources/dp/<?php echo $rows['img']; ?>" alt="Image not found" 
                    onerror="this.onerror=null;this.src='resources/dp/ph.jpg';">
		<h1 class="order-total-title">User Type: <?=($rows['utype']=='A')?"Admin":"User";?></h1>
		<div class="order-details">
			<p>Name: <?=$rows['fname'].' '.$rows['lname'];?></p>
			<p>Contact Number: <?=$rows['cno'];?></p>
			<p>Address: <?=$rows['addr']?></p>
            <div class="order-confirm-btn-layout">
                <button class="btn-confirm" id="myBtn">Edit Account Information</button>
            </div>
		</div>
		<div class="order-confirm-btn-layout">
			<button class="btn-confirm" onclick="window.location.href='index.php';">Ok</button><!---returns-to-orderlist--->
			<button class="btn-cancel">Cancel</button><!---cancel-order--->
		</div>
        
        <?php
            if(isset($mess)){
                echo $mess;
            }
        ?>
        

        <!-- The Modal -->
    <div id="myModal" class="modal">

      <!-- Add Modal Product -->
      <div id="modal-content" class="form">
            <span class="close">&times;</span>
              <h2 class="title-heavy">Edit Profile</h2>
                 
                    
                    <div class="edit-user-top">
                        <form method="post" enctype="multipart/form-data" id="f1">
                            <input class="chng-submit" type="submit" value="OK" name="ok" id="ok">
                                <label class="chng-lbl">
                                    <input class="chng-src" type="file" name="image" id="image" onchange="clickk();"><img class="chng-img" src="resources/dp/<?php echo $rows['img']; ?>" alt="Image not found" 
                    onerror="this.onerror=null;this.src='resources/dp/ph.jpg';">
                                </label>
                            <p>Username:</p>
                            <h2 class="title-heavy"><?=$rows['uname'];?></h2>    
                        </form>
                    </div>
                    
                    <form method="post" autocomplete="off">
                        <div class="updt-user-info">
                            <input type="text" id="form-orange" class="inpt" name="uname" placeholder="New Username"><br><br>
                            <button type="submit" value="Add" name="upuname" class="btn-submit">Update</button>
                            <div class="btn-layout">
                                <a id="myUpBtn" class="a-btn">Reset Password</a>
                            </div>
                        </div>
                        
                    </form>
               

        </div>

    </div>

    <div id="myModal2" class="modal2">

      <!-- Add Modal Product -->
      <div id="modal-content2" class="form">
            <span class="close2">&times;</span>
              <h2 class="title-heavy">Reset Password</h2>

                    <form method="post" autocomplete="off">
                        <input type="password" id="form-orange" class="inpt" name="pass" placeholder="Current Password">
                        <input type="password" id="form-orange" class="inpt" name="npass" placeholder="New Password">
                        <input type="password" id="form-orange" class="inpt" name="rnpass" placeholder="Re-enter New Password">
                        <button type="submit" value="Add" name="uppass" class="btn-submit">Ok</button>
                    </form>
               

        </div>

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
    function show(){
        var div = document.getElementById('up');
        div.style.display='block';
    }

    function clickk(){
     var pic = document.getElementById("ok");
     pic.click();
  }

</script>
<script type="text/javascript" src="js/modal.js"></script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>