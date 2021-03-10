<?php 
$host = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "DailyGrainDB";

$conn = new mysqli($host,$username,$password);
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
$conn->query($sql);
$conn->close();
$conn = new mysqli($host,$username,$password,$dbname);
$sql = "CREATE TABLE IF NOT EXISTS users(
    `uname` VARCHAR(40) PRIMARY KEY,
    `pword` VARCHAR(40) NOT NULL,
    `fname` VARCHAR(40) NOT NULL,
    `lname` VARCHAR(40) NOT NULL,
    `addr` VARCHAR(100) NOT NULL,
    `cno` VARCHAR(20) NOT NULL,
    `email` VARCHAR(30) NOT NULL UNIQUE,
    `utype` VARCHAR(1) NOT NULL CHECK (utype IN('A','U','u','a'))
    )";
$conn->query($sql);
$sql = "CREATE TABLE IF NOT EXISTS prods(
    `prod_id` INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `prod_name` VARCHAR(20) NOT NULL,
    `prod_stock` INT(4) NOT NULL,
    `prod_price` FLOAT NOT NULL,
    `sticky` VARCHAR(10) CHECK (`sticky` in ('malagkit','buhaghag')),
    `tender` VARCHAR(10) CHECK (`tender` in ('maalsa','maligat')),
    `cook` VARCHAR(10) CHECK (`cook` in ('sinaing','sinangag')),
    `color` VARCHAR(10) CHECK (`color` in ('white','brown'))
    )";
$conn->query($sql);
if($conn->errno){
    echo $conn->error;
}
$sql = "CREATE TABLE IF NOT EXISTS orders(
        `ord_id` INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        `uname` VARCHAR(40),
        `prod_id` INT(4) UNSIGNED,
        `qty` INT(4),
        CONSTRAINT FK_USERS FOREIGN KEY (uname) REFERENCES users(uname),
        CONSTRAINT FK_PROD FOREIGN KEY (prod_id) REFERENCES prods(prod_id)  
    )";
$conn->query($sql);
if($conn->errno){
    echo $conn->error;
}


?>