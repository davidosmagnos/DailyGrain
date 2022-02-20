<?php 
$host = "localhost";
$username = "root";
$password = "";
$dbname = "dailygraindb";




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
    `img` VARCHAR(40) DEFAULT 'ph.jpg',
    `utype` VARCHAR(1) NOT NULL CHECK (utype IN('A','U','u','a'))
    )";
$conn->query($sql);
$sql = "CREATE TABLE IF NOT EXISTS prods(
    `prod_id` INT(4) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `prod_name` VARCHAR(20) NOT NULL,
    `prod_stock` INT(4) NOT NULL,
    `prod_price` FLOAT NOT NULL,
    `sold` INT DEFAULT 0,
    `image` TEXT,
    `sticky` VARCHAR(10) CHECK (`sticky` in ('malagkit','buhaghag')),
    `tender` VARCHAR(10) CHECK (`tender` in ('maalsa','maligat')),
    `cook` VARCHAR(10) CHECK (`cook` in ('sinaing','sinangag')),
    `color` VARCHAR(10) CHECK (`color` in ('white','brown'))
    )";
$conn->query($sql);
if($conn->errno){
    echo $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS cart(
    `sack_id` INT(5) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `uname` VARCHAR(40),
    `prod_id` INT(4) UNSIGNED,
    `qty` INT(5) NOT NULL DEFAULT 5 CHECK(qty >= 5),
    CONSTRAINT FK_USERS FOREIGN KEY (uname) REFERENCES users(uname),
    CONSTRAINT FK_PROD FOREIGN KEY (prod_id) REFERENCES prods(prod_id)  
)";
$conn->query($sql);
if($conn->errno){
echo $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS orders(
        `ord_id` VARCHAR(500),
        `uname` VARCHAR(40),
        `sack_id` INT(5) UNSIGNED ,
        `prod_id` INT(4) UNSIGNED,
        `qty` INT(4),
        `date` DATE,
        `eta` DATE,
        `price`FLOAT NOT NULL,
        `mop` INT CHECK(`mop` in (1,2)),
        `stat` VARCHAR(20)  DEFAULT 'pending' CHECK(`stat`in ('shipped','delivered','processed','pending','cancelled')),
        PRIMARY KEY (`ord_id`, `sack_id`),
        CONSTRAINT FK_user FOREIGN KEY (uname) REFERENCES users(uname)
        ON UPDATE CASCADE
    )";
$conn->query($sql);
if($conn->errno){
    echo $conn->error;
}

$sql = "SELECT * FROM users WHERE uname = 'admin'";
$data = $conn->query($sql);
$row = $data->fetch_array(MYSQLI_ASSOC);
$admin = md5("admin");
if($data->num_rows<=0){
    $init = "INSERT INTO users(uname,pword,fname,lname,addr,cno,email,utype) VALUES('admin','$admin','Daily','Grain','Alabang','09176652937','dailygrain@gmail.com','A')";
    $conn->query($init);
}

?>