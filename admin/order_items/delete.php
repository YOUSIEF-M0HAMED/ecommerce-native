<?php 
include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

    if(isset($_GET['order_id']) && isset($_GET['product_id'])  ){

        if(empty($_GET['order_id'])){
            $_SESSION['error']=" order id is not found";
            header("Location: display_all.php ");
            exit();
        }
        $order_id = $_GET['order_id'];
        
           
        if(empty($_GET['product_id'])){
            $_SESSION['error']=" product id is not found";
            header("Location: display_all.php ");
            exit();
        }
        $product_id = $_GET['product_id'];

    $deleteQuery = "DELETE FROM order_items WHERE order_id=$order_id AND product_id=$product_id";

    if($conn->query($deleteQuery)===TRUE){

        $_SESSION['success']="Order Items deleted successfully";
        header("location: display_all.php");
    }
    
else{
    $_SESSION['error']="Error: " . $deleteQuery . "<br>" . $conn->error;
    header("Location: display_all.php ");
    exit();
}
}else{
   $_SESSION['error']="error on submitting data";
   header("location: display_all.php");
}

}else{
    header("Location: ../../forbidden_page.php");
}