<?php session_start();
$_SESSION['question']= 1;
$sticky ="";
$tender ="";
$cook ="";
$color = "";

$questions = array("How sticky do you like your rice?","How Tender do you Like your rice?","How do you often cook your rice?","What color of rice do you like?");

if(isset($_POST['sticky'])){
    $_SESSION['question']=2;
    $_SESSION['sticky'] = $_POST['sticky'];
}
elseif(isset($_POST['tender'])){
    $_SESSION['question']=3;
    $_SESSION['tender'] = $_POST['tender'];
}
elseif(isset($_POST['cook'])){
    $_SESSION['question']=4;
    $_SESSION['cook'] = $_POST['cook'];
}
elseif(isset($_POST['color'])){
    $_SESSION['color'] = $_POST['color'];
    header("location:quiz_result.php");
}
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time(); ?>">
    
    <link rel="icon" href="resources/Untitled-1.png">
    <title>Quiz |  DailyGrain</title>
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
            <li><a href="#0"class="active">Take Quiz</a></li>
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
</header>
   <div class = "center-main">
    <div class = "form">

      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
              <h2 class='form-h2'>Question <?php echo $_SESSION['question'] ?>:</h2>
              
              
             <?php  
                if($_SESSION['question']==1){
                    echo "<h2 class='form-h2'>",$questions[0],"</h1><br>";
                    echo '<div class="order-confirm-btn-layout"><input type="submit" class="btn-choices" value="Malagkit" name="sticky" id="malagkit" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" class="btn-choices" value="Buhaghag" name="sticky" id="buhaghag" onmouseover ="disp(this.id)" onmouseout="out()"></div>';
                }elseif($_SESSION['question']==2){
                    echo "<h2 class='form-h2'>",$questions[1],"</h1><br>";
                    echo '<div class="order-confirm-btn-layout"><input type="submit" class="btn-choices" value="Maalsa" name="tender" id="maalsa" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" class="btn-choices" value="Maligat" name="tender" id="maligat" onmouseover ="disp(this.id)" onmouseout="out()"></div>';
                }elseif($_SESSION['question']==3){
                    echo "<h2 class='form-h2'>",$questions[2],"</h1><br>";
                    echo '<div class="order-confirm-btn-layout"><input type="submit" class="btn-choices" value="Sinangag" name="cook" id="fried" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" class="btn-choices" value="Sinaing" name="cook" id="steam" onmouseover ="disp(this.id)" onmouseout="out()"></div>';
                }elseif($_SESSION['question']==4){
                    echo "<h2 class='form-h2'>",$questions[3],"</h1><br>";
                    echo '<div class="order-confirm-btn-layout"><input type="submit" class="btn-choices" value="White" name="color" id="white" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" class="btn-choices" value="Brown" name="color" id="brown" onmouseover ="disp(this.id)" onmouseout="out()"></div>';
                }
            
            ?>

             
                    
      </form>

      <div class="description">
        <h2>Description Legend:</h2>
        <span id="desc"> </span>
      </div>

    </div>
    </div><br>
     <?php 
                if(isset($_POST['save'])){
                    $imgname= $_POST['imgname'];
                    $pname = $_POST['pname'];
                    $price= $_POST['price'];
                    $info = $_POST['p_info'];

                    $saveqry = ("
                      INSERT INTO products(IMGNAME,NAME,PRICE,INFORMATION) VALUES ('$imgname','$pname','$price','$info');
                  ");
                    if($conn->query($saveqry)===TRUE){
                        echo '<script>alert("Item added succesfully.")</script>';
                    }else{
                        echo '<script>alert("$conn->error")</script>'; 
                    }
                  
              }
    ?>

<footer>
<p id="title" class="ft">DailyGrain</p>
<p>All rights reserved.</p>
</footer>   
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>--->
<script>
    if( !window.jQuery ) document.write('<script src="js/jquery-3.0.0.min.js"><\/script>');
</script>
<script src="js/main.js"></script> <!-- Resource jQuery -->

  <script>
        function disp(id){
            var spann = document.getElementById("desc");
            if(id=="malagkit"){
                spann.textContent = "The rice is moist and sticky";
            }else if(id == "buhaghag"){
                spann.textContent = "The rice is not as moist and is loose";
            }else if(id == "maalsa"){
                spann.textContent = "The rice is tender and soft in texture, usually described as fluffy";
            }else if(id == "maligat"){
                spann.textContent = "The rice is grainy in texture";
            }else if(id == "fried"){
                spann.textContent = "The rice is stir fried in oil seasoning";
            }else if(id == "steam"){
                spann.textContent = "The rice is boiled or steamed until cooked";
            }else if(id == "white"){
                spann.textContent = "The most nutritious parts of the rice, bran and germ, are removed";
            }else if(id == "brown"){
                spann.textContent = "It is more fibrous, the grain and bran are not removed, it is a whole grain";
            }
        }
        function out(){
            document.getElementById("desc").textContent="";
        }
    </script>
</body>
</html>