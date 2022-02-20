<?php 
session_start();
include "config.php";
if(!($_SESSION['loggedin'] && isset($_SESSION['loggedin']))){
    header("location:sack-cart.php?error=1");
    exit();
}
$ord_id = uniqid();
$uname = $_SESSION['uname'];
$date = date('Y-m-d');
$eta = date('Y-m-d',strtotime("+1 days"));
if(isset($_POST['paymentType'])){
    $mop = $_POST['paymentType'];
}else{
    header("location:sack-cart.php?error=2");
    exit();
}
$sql = "SELECT C.uname,C.prod_id,C.sack_id,C.qty,P.prod_price FROM cart C, prods P WHERE C.prod_id = P.prod_id";
$result = $conn->query($sql);
if($result->num_rows > 0){
    while($rows = $result->fetch_assoc()){
        $sack_id = $rows['sack_id'];
        $qty = $rows['qty'];
        $prod_id = $rows['prod_id'];
        $price = $rows['prod_price'];
        $sql1 = "INSERT INTO orders(ord_id,sack_id,uname,mop,`date`,eta,qty,price,prod_id) VALUES('$ord_id','$sack_id','$uname','$mop','$date','$eta','$qty','$price','$prod_id')";
        if($conn->query($sql1)===FALSE){
            die($conn->error);
        }
        $sql2 = "UPDATE prods SET sold = sold+$qty, prod_stock = prod_stock-$qty WHERE prod_id = '$prod_id'";
        if($conn->query($sql2)===FALSE){
            die($conn->error);
        }
    }
}else{
    header("location:sack-cart.php?error=3");
    exit();
}
    $sql = "DELETE FROM cart";
    if($conn->query($sql)===FALSE){
        die($conn->error);
    }


    
    header("location:orders.php?id=$ord_id");
    exit();
?>