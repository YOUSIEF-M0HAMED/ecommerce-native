<?php 
include_once "../../dbconnection.php";
session_start();
if (isset($_SESSION['id']) && $_SESSION['role'] == 'customer') {



$customer_id=$_SESSION['id'];
    
$selectCart = "SELECT * FROM carts WHERE customer_id = '$customer_id' ";
$result = $conn->query($selectCart);

if ($result){
    while($cart=$result->fetch_assoc()){
    
$cart_id =$cart['id'];
$deleteQuery = "DELETE FROM carts WHERE id=$cart_id ";
    if($conn->query($deleteQuery) ) {

        $_SESSION['success']="All deleted successfully";
        header("Location:customer_cart.php ");
    }else{

        $_SESSION['error']="Error: " . $deleteQuery . "<br>" . $conn->error;
        header("Location:customer_cart.php"); 
    }
}
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