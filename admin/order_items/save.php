<?php 

include_once "../../dbconnection.php";
session_start(); 
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])  && isset($_POST['product_id']) && isset($_POST['quantity'])) {
    
if(empty($_POST['order_id'])){
    $_SESSION['error']="Order ID is required";
    header("Location:create.php ");
    exit();
}
$order_id = $_POST['order_id'];

   
if(empty($_POST['product_id'])){
    $_SESSION['error']="Product ID is required";
    header("Location:create.php ");
    exit();
}
$product_id = $_POST['product_id'];

    if(empty($_POST['quantity'])){
    $_SESSION['error']="Quantity is required";
    header("Location:create.php ");
    exit();
}
$quantity = $_POST['quantity'];

$selectProduct="SELECT * FROM products where id = '$product_id'";
$product=$conn->query($selectProduct)->fetch_assoc();


if($quantity > $product['quantity']){
    $_SESSION['error']="Quantity Filed Must be less Than: ".$product['quantity']  ;
    header("Location:create.php ");
    exit();

}
    $insertQuery = "INSERT INTO order_items (order_id,product_id,quantity) VALUES ('$order_id','$product_id','$quantity')";
                // Execute the query
                if ($conn->query($insertQuery) === TRUE) {
                    
                    $_SESSION['success']=" order_items inserted successfully";
                    header("location: create.php");

                } else {

                    $_SESSION['error']="Error: " . $insertQuery . "<br>" . $conn->error;
                    header("Location:create.php ");
                    exit();
                }
                
                // Close the connection
                $conn->close();
            

            } else {
                $_SESSION['error']=" error on submitting data ";
                header("location: create.php");

            }

            }else{
                header("Location: ../../forbidden_page.php");
            }
    