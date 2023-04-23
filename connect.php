<?php
$severname = "localhost";
$username = "root";
$password = "";
$database = "Fashion";
$conn = new mysqli ($severname,$username,$password );
if($conn -> connect_error){
    die("Unable to connect".$conn -> connect_error);
}
try{
    $sql = "Create database if not exists $database";
    $conn->query($sql);
    $conn->select_db("$database");
    $sql = "Create table if not exists Role (
        id int  PRIMARY KEY AUTO_INCREMENT,
	    name varchar(100)
        )";
    $conn->query($sql);
    $res = $conn->query($sql);
    $sql = "Create table if not exists Users (
        id int  PRIMARY KEY AUTO_INCREMENT,
	    fullname varchar(100), 
	    username varchar(100), 
	    email varchar(100),
	    phone_number varchar(100), 
	    password varchar(100), 
	    role_id int,
    	 FOREIGN KEY (role_id) REFERENCES Role(id)
    )";
    $conn->query($sql);
    $res = $conn->query($sql);
    $sql ="Create table if not exists Stylists(
        id int  PRIMARY KEY AUTO_INCREMENT,
	    stylists_name varchar(100)
        )";
    $conn->query($sql);
    $res = $conn->query($sql);
    $sql ="Create table if not exists Collection(
        id int  PRIMARY KEY AUTO_INCREMENT,
	    collection_name  varchar(100), 
	    stylists_id int,
         FOREIGN KEY (stylists_id)REFERENCES Stylists(id)
        )";
    $conn->query($sql);
    $res = $conn->query($sql); 
    $sql ="Create table if not exists Products(
        id int  PRIMARY KEY AUTO_INCREMENT,
        title varchar(100),
        price float,
        discount float,
        thumbnail varchar(100),
        description longtext,
        created_at datetime,
        updated_at datetime,
        collection_id int,
        FOREIGN KEY (collection_id) REFERENCES Collection(id)
        )";
    $conn->query($sql);
    $res = $conn->query($sql); 
    $sql ="Create table if not exists `Order`(
        id int  PRIMARY KEY AUTO_INCREMENT,
		fullname varchar(100), 
		email varchar(100),
		phone_number varchar(100), 
		address varchar(100),
		payment_methods varchar(100),  
		note longtext,
		order_date datetime,
		status varchar(100),
		total_money float
        )";
    $conn->query($sql);
    $res = $conn->query($sql); 
    $sql ="Create table if not exists Order_details(
        id int  PRIMARY KEY AUTO_INCREMENT,
		payment_method varchar(100),
		num int,
		price float,
		total_money float,
        order_id int,
         FOREIGN KEY (`order_id`) REFERENCES `Order`(`id`),
        	product_id int,
         FOREIGN KEY (`product_id`) REFERENCES `products`(id))";
    $conn->query($sql);
    $res = $conn->query($sql);
    $sql ="Create table if not exists Feedback(
        id int  PRIMARY KEY AUTO_INCREMENT,
        content varchar(100),
        user_id int,
        products_id int,
    	FOREIGN KEY(products_id) REFERENCES Products(id),
        FOREIGN KEY (user_id) REFERENCES Users(id)
)";
    $conn->query($sql);
    $res = $conn->query($sql);
}
catch(Exception $e){
    echo"Error create database :".$e->getMessage();
}  
?>