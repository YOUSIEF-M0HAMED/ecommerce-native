<?php 
include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if (isset($_GET['cart_id'])){

    
    if(empty($_GET['cart_id'])){
        echo "Error: Cart ID is required";
       exit();
    }
    
    $cart_id=$_GET['cart_id'];


    $deleteQuery = "DELETE FROM carts WHERE id=$cart_id ";

    if($conn->query($deleteQuery)===TRUE){

        $_SESSION['success']="Cart deleted successfully";
        header("location: display_all.php");
    }
    
else{
    $_SESSION['error']="Error: " . $deleteQuery . "<br>" . $conn->error;
    header("location:display_all.php");
}
}else{
   $_SESSION['error']="Error on Submitting Data";
   header("location: display_all.php");
}

}else{
    header("Location: ../../forbidden_page.php");
}