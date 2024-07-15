<?php 
include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if (isset($_GET['category_id'])){

    if(empty($_GET['category_id'])){
        $_SESSION['error']="Category ID is required";
        header("Location:display_all.php ");
        exit();
    }
    
    $category_id=$_GET['category_id'];

    $deleteQuery = "DELETE FROM categories WHERE id=$category_id ";

    if($conn->query($deleteQuery)===TRUE){

        $_SESSION['success']="Category deleted successfully";
        header("location: display_all.php");
    }
    
else{
    echo "Error: " . $deleteQuery . "<br>" . $conn->error;

}
}else{
   $_SESSION['error']="No received Category ID to delete";
   header("location: display_all.php");
}

}else{
header('Location: ../../forbidden_page.php');
}