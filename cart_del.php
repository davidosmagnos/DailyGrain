<?php 
session_start();
include "config.php";
$sack = $_GET['sack'];

$sql = "DELETE FROM cart WHERE sack_id = '$sack'";
$conn->query($sql);
header("location:sack-cart.php");



?>