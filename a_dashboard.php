<?php 
session_start();
include "config.php";
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}
if($_SESSION['type']=="U"){
	header("location:index.php?error=1");
}
if(isset($_GET['error'])&&$_GET['error']==1){
    echo '<script>alert("You do not have Access in this page!")</script>';
}
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
$u = $result->num_rows;
$sql = "SELECT * FROM prods";
$result = $conn->query($sql);
$p = $result->num_rows;
$sql = "SELECT DISTINCT ord_id FROM orders";
$result = $conn->query($sql);
$o = $result->num_rows;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>"> <!-- Resource style -->
    
    <link rel="icon" href="resources/Untitled-1.png">
    <title>Sign-up | DailyGrain</title>
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
                <li><a href="a_dashboard.php" class="active">Dashboard</a></li>
                <li><a href="a_users.php">Users</a></li>
                <li><a href="a_products.php">Products</a></li>
                <li><a href="a_orders.php">Orders</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav> <!-- .cd-primary-nav -->
    </header>
    <main class ="cd-main-content">
        <div class="center-main">
            
            <div class="top-content-dash">
                <h1 id="title">Welcome, Admin!</h1>
                <div class="grid-container" id="dashboard"><!--grid-container-->

                    
                    <div class="item1">
                        <a href="a_orders.php" class="a-link">
                        <div class="top-item-dash"><!--product picture-->
                            <h1><?php echo $o; ?></h1>
                        </div>

                        <div class="bottom-item-dash"><!--product information-->                            
                            <p class="details">Orders</p>                                                
                        </div></a>
                    </div>

                   
                    <div class="item2">
                         <a href="a_users.php" class="a-link">
                        <div class="top-item-dash"><!--product picture-->
                            <h1><?php echo $u; ?></h1>
                        </div>

                        <div class="bottom-item-dash" class="a-link"><!--product information-->                            
                            <p class="details">Users</p>                                                
                        </div></a>
                    </div>

                    
                    <div class="item3">
                        <a href="a_products.php" class="a-link">
                        <div class="top-item-dash"><!--product picture-->
                            <h1><?php echo $p; ?></h1>
                        </div>

                        <div class="bottom-item-dash"><!--product information-->                            
                            <p class="details">Products</p>                                                
                        </div>
                    </div></a>
                </div>
             </div><!--end of top-dash-->
        </div>
        <div class="bottom-content-dash">
                <h1 id="label-heavy">List of Pending Orders:</h1>
                <div class="scrollable-content-admin">
                    <?php 
                        $sql = "SELECT DISTINCT ord_id FROM orders WHERE stat = 'pending' AND stat <> 'delivered'";
                        $result =$conn->query($sql);
                        if($conn->error){
                            die($conn->error);
                        }
                        if($result->num_rows > 0){
                            while($rows = $result->fetch_assoc()){
                                echo
                                '<div class="orders-item">
                                <a href="a_order-view.php?id='.$rows['ord_id'].'" class="orders-list-item">Order ID#'.$rows['ord_id'].'</a>
                            </div>';
                            }
                        }
                        
                    ?>
        </div>
             </div><!--end of bottom-dash-->
            
                

                
       
    </main>
    
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
</body>
</html>