<?php 
session_start();
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
	header("location:logout.php");
}
if($_SESSION['type']=="U"){
	header("location:index.php?error=1");
}
include "config.php";
$id = $_SESSION['id'];
if(isset($_POST['go'])){
    $id = $_POST['go'];
    $prod_name = $_POST['prod_name'];
    $prod_price = $_POST['prod_price'];
    $stock = $_POST['stock'];
    $sticky = $_POST['sticky'];
    $tender = $_POST['tender'];
    $cook = $_POST['cook'];
    $color = $_POST['color'];
    $sql = "UPDATE prods SET prod_name = '$prod_name', prod_price = '$prod_price', prod_stock = '$stock', sticky = '$sticky', tender = '$tender', cook='$cook', color = '$color' WHERE prod_id ='$id'";
    $conn->query($sql);
    header("location:a_products.php");
    }
$sql = "SELECT * FROM prods WHERE prod_id = '$id'";
$result = $conn->query($sql);
if($conn->error){
    die("Error ".$conn->errno.": ".$conn->error);
}
if($result->num_rows>0){
    $rows = $result->fetch_array(MYSQLI_ASSOC);
}else{
    echo "error";
}
$uname = $_SESSION['uname'];
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
                <li><a href="a_dashboard.php">Dashboard</a></li>
                <li><a href="a_users.php">Users</a></li>
                <li><a href="a_products.php" class="active">Products</a></li>
                <li><a href="a_orders.php">Orders</a></li>
                <?php 
                if(@$_SESSION['loggedin']){
                    echo "<li><a href='logout.php'>Logout</a></li>";
                    echo "<li><b>Hi,".$_SESSION['uname']."</b></li>";
                }else{
                   echo "<li><a href='login.php'>Login</a></li>
                    ";
                }
            
            ?>
            </ul>
        </nav> <!-- .cd-primary-nav -->
    </header>
    <main class ="cd-main-content">
        <div class="center-main">
            <div class="form">
                <h2 class="title-heavy">Edit product</h2>
                 <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    <div class="edit-img-layout">
                        <img src="resources/<?php echo $rows['image'] ?>" class="edit-img"><br>
                        <span id="spann"><?php echo $rows['image'] ?></span>
                    </div>
                    <div class="edit-img-top-info">
                        
                        <input type="text" id="form-orange" class="inpt" name="prod_name" placeholder="Product name" value="<?php echo $rows['prod_name'] ?>">
                        <input type="text" id="form-orange" class="inpt" name="prod_price" placeholder="Product price per kg" value="<?php echo $rows['prod_price'] ?>">
                        <input type="text" id="form-orange" class="inpt" name="stock" placeholder="Stock in kg" value="<?php echo $rows['prod_stock'] ?>">
                    </div>
                    
                   

                    <select name="sticky" id="form-orange" class="inpt">
                        <option value="" selected disabled>Stickiness</option>
                        <option value="malagkit" <?php if($rows['sticky']=='malagkit'){echo "selected";}?>>Malagkit</option>
                        <option value="buhaghag" <?php if($rows['sticky']=='buhaghag'){echo "selected";}?>>Buhaghag</option>
                    </select>
                    <select name="tender" id="form-orange" class="inpt">
                        <option value="" selected disabled>Tenderness</option>
                        <option value="maalsa" <?php if($rows['tender']=='maalsa'){echo "selected";}?>>Maalsa</option>
                        <option value="maligat" <?php if($rows['tender']=='maligat'){echo "selected";}?>>Maligat</option>
                    </select>
                    <select name="cook" id="form-orange" class="inpt">
                        <option value="" selected disabled>Style of Cooking</option>
                        <option value="sinaing" <?php if($rows['cook']=='sinaing'){echo "selected";}?>>Sinaing</option>
                        <option value="sinangag" <?php if($rows['cook']=='sinangag'){echo "selected";}?>>Sinangag</option>
                    </select>
                    <select name="color" id="form-orange" class="inpt">
                        <option value="" selected disabled>Color</option>
                        <option value="white" <?php if($rows['color']=='white'){echo "selected";}?>>White</option>
                        <option value="brown" <?php if($rows['color']=='brown'){echo "selected";}?>>Brown</option>
                    </select><br>
                    <button type="submit" value="<?php echo $rows['prod_id'] ?>" name="go" class="btn-submit">Update</button>
                </form>

            </div>
       
    </div>
    </main>
    
    <div class="mess">
  
    
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