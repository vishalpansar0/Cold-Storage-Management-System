<?php

$servername = "localhost";
$username = "root";
$password = "";
$connection = new mysqli($servername,$username,$password,"final_project_edureka");



$storage_table = "
CREATE TABLE Storage(
    s_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    cost INT NOT NULL,
    quantity INT,
    description VARCHAR(1000),
    img_path VARCHAR(1000),
    remains int(2)
   ) 
";

$user_table = " 
    CREATE TABLE Users(
    u_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL , 
    password VARCHAR(100) NOT NULL,
    avatar VARCHAR(1000)
)";


$booking_table = "
    CREATE TABLE Booking(
        booking_id INT  PRIMARY KEY AUTO_INCREMENT,
        user_id INT FOREIGN KEY REFERENCES Users(u_id),
        storage_id INT FOREIGN KEY REFERENCES Storage(s_id),
        item_cost INT REFERENCES Storage(cost),
        item_quantity INT,
        cost INT,
        order_date TIMESTAMP,
        end_date TIMESTAMP
)";


if($connection->query($booking_table)===TRUE);{
    echo "hello";
}

?>