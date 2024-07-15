<?php

include_once "../../dbconnection.php";
session_start();
if($_SESSION['role']==="admin" ){
    
    if ($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['order_id'])  && isset($_POST['product_id']) 
        && isset($_POST['old_order_id']) && isset($_POST['old_product_id']) && isset($_POST['quantity'])) {
    
            if(empty($_POST['old_order_id'])){
                echo "old order id is not found";
                exit();
            }
            $old_order_id = $_POST['old_order_id'];

            if(empty($_POST['old_product_id'])){
                echo " old product id is not found";
                exit();
            }
            $old_product_id = $_POST['old_product_id'];

        if(empty($_POST['order_id'])){
            $_SESSION['error']="new order id is required";
            header("Location: edit.php?order_id=$order_id&product_id=$old_product_id ");
            exit();
        }
        $order_id = $_POST['order_id'];
        
           
        if(empty($_POST['product_id'])){
            $_SESSION['error']="new product id is required";
            header("Location: edit.php?order_id=$old_order_id&product_id=$old_product_id ");
            exit();
        }
        $product_id = $_POST['product_id'];

        if(empty($_POST['quantity'])){
            $_SESSION['error']="Quantity is required";
            header("Location:edit.php?order_id=$old_order_id&product_id=$old_product_id ");
            exit();
        }
        $quantity = $_POST['quantity'];
        
        $updated_at=date("Y-m-d H:i:s");


        $selectProduct="SELECT * FROM products where id = '$product_id'";
        $product=$conn->query($selectProduct)->fetch_assoc();

        if($quantity > $product['quantity']){
            $_SESSION['error']="Quantity Filed Must be less Than: ".$product['quantity']  ;
            header("Location:edit.php?order_id=$old_order_id&product_id=$old_product_id ");
            exit();

        }

        $updateQuery = "UPDATE order_items SET order_id='$order_id', 
        product_id='$product_id', quantity='$quantity', updated_at='$updated_at'
         WHERE order_id='$old_order_id' AND product_id='$old_product_id' ";
        // Execute the query
if ($conn->query($updateQuery) === TRUE) {
    $_SESSION['success']="order_items updated successfully";
header("Location: display_all.php");
} else {
    $_SESSION['error']="Error: " . $updateQuery . "<br>" . $conn->error;
    header("Location: edit.php?order_id=$old_order_id&product_id=$old_product_id ");
    exit();
}


$conn->close();

}else{
    $_SESSION['error']="error on received data";
    header("Location: edit.php?order_id=$old_order_id&product_id=$old_product_id ");
    exit();

}
}else{
    header("Location: ../../forbidden_page.php");
}