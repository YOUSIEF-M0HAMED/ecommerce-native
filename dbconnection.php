<?php 
$server="localhost";
$userName="root";
$Password="";
$dbName="ecommerce";

$conn=new mysqli($server,$userName,$Password,$dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}