<?php 
include_once "../../dbconnection.php";
session_start();
if (isset($_SESSION['id']) && $_SESSION['role'] == 'customer') {

if ( isset($_GET['cart_id']) ){

    if(empty($_GET['cart_id'])){
        $_SESSION['error']="cart id  is required";
        header("Location:customer_cart.php ");
        exit();
    }
    
    $cart_id =$_GET['cart_id'];

$deleteQuery = "DELETE FROM carts WHERE id=$cart_id ";
    if($conn->query($deleteQuery) ) {

        $_SESSION['success']="deleted successfully";
        header("Location:customer_cart.php ");
    }

    
}else{

    $_SESSION['error']="Error on received data";
    header("Location:customer_cart.php"); 
}
    
}else{
    if(! isset($_SESSION['id'] )){
        header("Location:../../authentication/login.php");
        exit();
    }
        
    if($_SESSION['role'] == 'admin'){
    header("Location:../../forbidden_page.php");
    exit();

    }
}