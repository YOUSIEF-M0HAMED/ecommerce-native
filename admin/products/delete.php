<?php 
include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if ( isset($_GET['product_id'])){


    if(empty($_GET['product_id'])){
       echo " error cannot find product id to delete";
        exit();
    
    }

    $product_id=$_GET['product_id'];
    $deleteQuery = "DELETE FROM products WHERE id=$product_id ";

    if($conn->query($deleteQuery)===TRUE){
        
        $_SESSION['success'] = " Product deleted successfully";
        header("location: display_all.php");
        exit();
    }
    
else{
    $_SESSION['error'] = "Error: " . $deleteQuery . "<br>" . $conn->error;
        header("location: display_all.php");
        exit();
}
}else{

    echo "error on submitting data";
}

}else{
    header("Location: ../../forbidden_page.php");
}