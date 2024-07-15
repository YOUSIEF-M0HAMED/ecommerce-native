<?php 
include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if (isset($_GET['order_id'])){

    if(empty($_GET['order_id'])){
        $_SESSION['error']="Order ID is required";
        header("Location:display_all.php ");
        exit();
    }

    $order_id=$_GET['order_id'];

    $deleteQuery = "DELETE FROM orders WHERE id=$order_id ";

    if($conn->query($deleteQuery)===TRUE){

        $_SESSION['success']="Order deleted successfully";
        header("location: display_all.php");
    }
    
else{
    echo "Error: " . $deleteQuery . "<br>" . $conn->error;

}
}else{
   $_SESSION['error']="No received Order ID to delete";
   header("location: display_all.php");
}

}else{
    header("Location: ../../forbidden_page.php");
}