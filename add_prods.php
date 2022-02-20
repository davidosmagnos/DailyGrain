<?php 
session_start();
include "config.php";
if($_SESSION['type']=='U'){
    header("location:logout.php");
}
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
                <li><a href="#0">Dashboard</a></li>
                <li><a href="#0">Users</a></li>
                <li><a href="#0" class="active">Products</a></li>
                <li><a href="#0">Orders</a></li>
                <li><a href="#0">Logout</a></li>
            </ul>
        </nav> <!-- .cd-primary-nav -->
    </header>
    <main class ="cd-main-content">
        <div class="center-main">
            <div class="form">
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

            </div>
       
    </div>
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