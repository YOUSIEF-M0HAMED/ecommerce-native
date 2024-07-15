<?php

include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart_id']) && isset($_POST['customer_id']) 
    && isset($_POST['product_id']) && isset($_POST['quantity']) ) {

    if(empty($_POST['cart_id'])){
        echo "Error: Cart ID is required";
       exit();
    }

    $cart_id=$_POST['cart_id'];

           
if(empty($_POST['customer_id'])){
    $_SESSION['error']="Customer ID is required";
    header("Location:edit.php?cart_id='$cart_id' ");
    exit();
}

$customer_id = $_POST['customer_id'];

if(empty($_POST['product_id'])){
    $_SESSION['error']="Product ID is required";
    header("Location:edit.php?cart_id='$cart_id' ");
    exit();
}

$product_id = $_POST['product_id'];

if(empty($_POST['quantity'])){
    $_SESSION['error']="quantity field is required";
    header("Location:edit.php?cart_id='$cart_id' ");
    exit();
}

$quantity = $_POST['quantity'];


$selectProduct="SELECT * FROM products Where id ='$product_id' ";
$result=$conn->query($selectProduct);
    if($row=$result->fetch_assoc()){
    
        if( $quantity > $row['quantity']  ){
            $_SESSION['error']="Quantity Field must be less than : " .$row['quantity'];
            header("location:edit.php?cart_id='$cart_id'");
            exit();
        }
        $product_price=$row['price'];
                }
$total_price= $product_price*$quantity;

$updated_at =  Date('Y-m-d H:i:s');


$updateQuery = "UPDATE carts SET customer_id='$customer_id',product_id='$product_id',
                quantity='$quantity',total_price='$total_price', updated_at='$updated_at' WHERE id=$cart_id";
        // Execute the query
if ($conn->query($updateQuery) === TRUE) {
    $_SESSION['success']="cart updated successfully";
header("Location: display_all.php");
} else {
    $_SESSION['error']="Error: " . $updateQuery . "<br>" . $conn->error;
    header("location:edit.php?cart_id='$cart_id'");
}

$conn->close();

}else{
    echo "error on submitting data";
}
}else{
    header("Location: ../../forbidden_page.php");
}