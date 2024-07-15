<?php

include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])  && isset($_POST['customer_id'])) {

    if(empty($_POST['order_id'])){
        echo "error not received order id ";
       exit();
    }

    $order_id=$_POST['order_id'];

    if(empty($_POST['customer_id'])){
        $_SESSION['error']="error not received customer id";
    header("Location: edit.php?order_id=$order_id ");
    exit();
    }

    $customer_id=$_POST['customer_id'];
    $currentTimestamp = new DateTime();
    $updated_at = $currentTimestamp->format('Y-m-d H:i:s');


    if(empty($customer_id)){
        $_SESSION['error'] ="Customer ID is required";
        header("Location:edit.php?category_id=$category_id ");
    }else{


        $updateQuery = "UPDATE orders SET customer_id='$customer_id', updated_at='$updated_at' WHERE id=$order_id";
        // Execute the query
if ($conn->query($updateQuery) === TRUE) {
    $_SESSION['success']="category updated successfully";
header("Location: display_all.php");
} else {
echo "Error: " . $updateQuery . "<br>" . $conn->error;
}

}
$conn->close();
}

else{
    $_SESSION['error']="error on submitting data";
    header("Location: edit.php?order_id=$order_id ");

}
}else{
    header("Location: ../../forbidden_page.php");
}