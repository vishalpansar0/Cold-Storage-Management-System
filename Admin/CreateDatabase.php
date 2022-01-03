<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = " CREATE DATABASE final_project_edureka";

$connection = new mysqli($servername,$username,$password);

if($connection->connect_error){
    die("Connection Failed. ".$connection->connect_error);
}

if($connection->query($database)==false){
    echo "Error ".$connection->connect_error;
}


?>