<?php session_start();
$_SESSION['question']= 1;
$sticky ="";
$tender ="";
$cook ="";
$color = "";

$questions = array("How sticky do you like your rice?","How Tender do you Like your rice?","How do you often cook your rice?","What color of rice do you like?");

if(isset($_POST['sticky'])){
    $_SESSION['question']=2;
    $sticky = $_POST['sticky'];
}
if(isset($_POST['tender'])){
    $_SESSION['question']=3;
    $tender = $_POST['tender'];
}
if(isset($_POST['cook'])){
    $_SESSION['question']=4;
    $cook = $_POST['cook'];
}
if(isset($_POST['color'])){
    $_SESSION['question'] = 0;
    $color = $_POST['color'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles_quiz.css">
</head>
<body>
    <div class="head">
        <h1>DailyGrain</h1>
        <div class="links">
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#" style="color:#ff7252;"><b>Take Quiz</b></a></li>
            <li><a href="#">Order Summary</a></li>
            <li><a href="#">Sack</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
        </div>
    </div>
    <div class="container">
       <h1 style="text-align:center;">Question <?php echo $_SESSION['question'] ?>:</h1><br>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <?php  
                if($_SESSION['question']==1){
                    echo "<h1 class='que'>",$questions[0],"</h1><br>";
                    echo '<input type="submit" value="Malagkit" name="sticky" id="malagkit" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" value="Buhaghag" name="sticky" id="buhaghag" onmouseover ="disp(this.id)" onmouseout="out()">';
                }elseif($_SESSION['question']==2){
                    echo "<h1 class='que'>",$questions[1],"</h1><br>";
                    echo '<input type="submit" value="Maalsa" name="tender" id="maalsa" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" value="Maligat" name="tender" id="maligat" onmouseover ="disp(this.id)" onmouseout="out()">';
                }elseif($_SESSION['question']==3){
                    echo "<h1 class='que'>",$questions[2],"</h1><br>";
                    echo '<input type="submit" value="Sinangag" name="cook" id="fried" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" value="Sinaing" name="cook" id="steam" onmouseover ="disp(this.id)" onmouseout="out()">';
                }elseif($_SESSION['question']==4){
                    echo "<h1 class='que'>",$questions[3],"</h1><br>";
                    echo '<input type="submit" value="White Rice" name="color" id="white" onmouseover ="disp(this.id)" onmouseout="out()">';
                    echo '<input type="submit" value="Brown Rice" name="color" id="brown" onmouseover ="disp(this.id)" onmouseout="out()">';
                }
            
            ?>
        </form>
    </div>
    <br>
    <div class="description">
        <h2>Description Legend:</h2>
        <span id="desc"> </span>
    </div>
    <footer>
    <h4>All rights reserved</h4>
    </footer>
        
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