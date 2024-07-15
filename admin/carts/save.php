<?php 

include_once "../../dbconnection.php";
session_start(); 
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_id']) 
    && isset($_POST['product_id']) && isset($_POST['quantity']) ) {
    
        
if(empty($_POST['customer_id'])){
    $_SESSION['error']="Customer ID is required";
    header("Location:create.php ");
    exit();
}

$customer_id = $_POST['customer_id'];

if(empty($_POST['product_id'])){
    $_SESSION['error']="Product ID is required";
    header("Location:create.php ");
    exit();
}

$product_id = $_POST['product_id'];

if(empty($_POST['quantity'])){
    $_SESSION['error']="quantity field is required";
    header("Location:create.php ");
    exit();
}

$quantity = $_POST['quantity'];

$selectProduct="SELECT * FROM products Where id ='$product_id' ";
$result=$conn->query($selectProduct);
    if($row=$result->fetch_assoc()){
    
        if( $quantity > $row['quantity']  ){
            $_SESSION['error']="Quantity Field must be less than : " .$row['quantity'];
            header("location: create.php");
            exit();
        }
        $product_price=$row['price'];
                }
$total_price= $product_price*$quantity;

    $insertQuery = "INSERT INTO carts (customer_id,product_id,quantity,total_price) 
                    VALUES ('$customer_id','$product_id','$quantity','$total_price')";
                // Execute the query
                if ($conn->query($insertQuery) === TRUE) {
                    
                    $_SESSION['success']=" Cart inserted successfully";
                    header("location: create.php");

                } else {
                    $_SESSION['error']="Error: " . $insertQuery . "<br>" . $conn->error;
                    header("location: create.php");
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
    