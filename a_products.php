<?php 
session_start();
include "config.php";
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}
if($_SESSION['type']=="U"){
	header("location:index.php?error=1");
}
if(isset($_POST['del'])){
	$_SESSION['id'] = $_POST['del'];
	header("location:a_edit-product.php");
}
?>
<?php 
			if(isset($_POST['sub'])){
				$sql = "DELETE FROM prods WHERE prod_id = '$_POST[sub]'";
				if($conn->query($sql)===FALSE){
					die($conn->error);
				}
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
                <li><a href="#0" class="active">Products</a></li>
                <li><a href="a_orders.php">Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav> <!-- .cd-primary-nav -->
    </header>

<main class="cd-main-content">
	<div class="center-main">

			<div class="grid-container" id="dash-products">

			  	
				<?php 
					$sql = "SELECT * FROM prods";
					$result = $conn->query($sql);
					if($conn->error){
						die("Error ".$conn->errno.":".$conn->error);
					}
					if($result->num_rows>0){
						while($rows = $result->fetch_assoc()){
							echo '<div class="item1">
									<div class="prod-pic"><!--product picture-->
										<img src="resources/'.$rows["image"].'" class="prod-img"><!--db-->
									</div>
			  
									<div class="prod-details"><!--product information-->
											<div class="prod-info">
												<h1 class="admin-name-products">'.$rows['prod_name'].' | ₱'.$rows['prod_price']. '</h1><!--db-->
												<h1 class="prod-info-details">'.$rows['sticky']."-".$rows['tender']."-".$rows['cook']."-".$rows['color'].'</h1><!--db-->
											</div>
									</div>
									    <form method="post" class="btn-form">
										<button class="btn-edit-admin" name="del" value="'.$rows['prod_id'].'" type="submit">Edit
										</button>
										<button class="btn-delete-admin" id="products-btn" type="submit" name="sub" value="'.$rows['prod_id'].'">Delete<span class="price-btn">x</span>
										</button>
									</form>
								</div>';
						}
					}
				?>
				
			  </div><!--end of grid-container-->

				
				

		
		<div id="buttonh">
			<button id="myBtn" class="float-add-btn">+</button>
		</div>
	</div><!--end of center-main-->

	
</main> <!-- .cd-main-content -->

<!-- The Modal -->
	<div id="myModal" class="modal">

	  <!-- Add Modal Product -->
	  <div id="modal-content" class="form">
	  		<span class="close">&times;</span>
              <h2 class="title-heavy">Add a product</h2>
                 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    <label><input type="file" name="image" id="img">Add photo</label><span id="spann">  No File Chosen</span> <br><br>
                    <input type="text" id="form-orange" class="inpt" name="prod_name" placeholder="Product name">
                    <input type="text" id="form-orange" class="inpt" name="prod_price" placeholder="Product price per kg">
                    <input type="text" id="form-orange" class="inpt" name="stock" placeholder="Stock in kg">

                    <select name="sticky" id="form-orange" class="inpt">
                        <option value="#" selected disabled>Stickiness</option>
                        <option value="malagkit">Malagkit</option>
                        <option value="buhaghag">Buhaghag</option>
                    </select>
                    <select name="tender" id="form-orange" class="inpt">
                        <option value="#" selected disabled>Tenderness</option>
                        <option value="maalsa">Maalsa</option>
                        <option value="maligat">Maligat</option>
                    </select>
                    <select name="cook" id="form-orange" class="inpt">
                        <option value="#" selected disabled>Style of Cooking</option>
                        <option value="sinaing">Sinaing</option>
                        <option value="sinangag">Sinangag</option>
                    </select>
                    <select name="color" id="form-orange" class="inpt">
                        <option value="#" selected disabled>Color</option>
                        <option value="white">White</option>
                        <option value="brown">Brown</option>
                    </select><br>
                    <input type="submit" value="Add" name="go" class="btn-submit">
               </form>
               <div class="mess">
			    <?php 
			            if(isset($_POST['go'])){
			            $prod_name = $_POST['prod_name'];
			            $prod_price = $_POST['prod_price'];
			            $stock = $_POST['stock'];
			            @$sticky = $_POST['sticky'];
			            @$tender = $_POST['tender'];
			            @$cook = $_POST['cook'];
			            @$color = $_POST['color'];
			            $filename=$_FILES['image']['name'];
			            $temp = $_FILES['image']['tmp_name'];
			            @$type = explode(".",$filename)[1];
			            $type = strtolower($type);
			            $error = $_FILES['image']['error'];
			            $ext = array("jpg","jpeg","png","gif");
			                if(!empty($filename)){
			                    if(in_array($type,$ext)){
			                        if($error===0){
			                            $newFn =strtolower($prod_name).".".$type;
			                            $newFn = str_replace(" ","",$newFn);
			                            $destination = "resources/".$newFn;
			                            $sql = "INSERT INTO prods (prod_name,prod_price,prod_stock,`image`,sticky,tender,cook,color) VALUES('$prod_name','$prod_price','$stock','$newFn','$sticky','$tender','$cook','$color')";
			                            if($conn->query($sql)==true && ($prod_name!="" && $prod_price!="" && $stock!="") ){
			                                move_uploaded_file($temp,$destination);
			                                echo '<p style="color:green;">Succesful</p>';
			                                header("refresh:1;a_products.php");
			                            }else{
			                                echo "<p style='color:red;'>Error Adding Product</p>";
			                            }
			                        }
			                        else{
			                            echo "<p style='color:red;'>Error occured while uploading</p>";
			                        }
			                    }
			                    else{
			                        echo "<p style='color:red;'>Invalid Filetype</p>";
			                    }
			                }
			                else{
			                    echo '<p style="color:red;">No image selected</p>';
			                }
			            }
			        ?>
    
    			</div>
			    <script>
			        var spann = document.getElementById('spann');
			        var imgg = document.getElementById("img");

			        imgg.addEventListener("change",function(){
			            spann.textContent = " " + this.files[0].name;
			        })
			        
				</script>

		</div>

	</div>

<footer>
<p id="title" class="ft">DailyGrain</p>
<p>All rights reserved.</p>
</footer>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>--->
<script type="text/javascript" src="js/modal.js"></script>
<script>
	if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="js/main.js"></script> <!-- Resource jQuery -->
</body>
</html>