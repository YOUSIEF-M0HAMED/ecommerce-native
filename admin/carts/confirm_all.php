<?php 
include_once "../../dbconnection.php";
session_start();
if (isset($_SESSION['id']) && $_SESSION['role'] == 'customer') {

$customer_id=$_SESSION['id'];
    
    $selectCart = "SELECT * FROM carts WHERE customer_id = '$customer_id' ";
    $result = $conn->query($selectCart);

    if ($result){
        while($cart=$result->fetch_assoc()){
            $cart_id=$cart['id'];
            $customer_id=$cart['customer_id'];

            $insertOrder = "INSERT INTO orders (customer_id ) VALUES ('$customer_id')";
           // Execute the query
           $conn->query($insertOrder);
        
        
           $last_order_id =$conn->insert_id;
           $product_id = $cart['product_id'];
           $quantity = $cart['quantity'];
   
           $selectProduct = "SELECT * FROM products WHERE id = '$product_id' ";
           $result2 = $conn->query($selectProduct);
   
           if ($result2) {
               $product = $result2->fetch_assoc();
           } else {
               $_SESSION['error'] = "Error: " . $selectProduct . "<br>" . $conn->error;
               header("Location:customer_cart.php");
               exit();
           }
   
           $availableQuantity = $product['quantity'] - $quantity;
           $updated_at = date('Y-m-d H:i:s');
   
           $updateProduct = "UPDATE products SET quantity='$availableQuantity',updated_at='$updated_at' WHERE id=$product_id";
   
           if (!$conn->query($updateProduct) === TRUE) {
               $_SESSION['error'] = "Error: " . $updateProduct . "<br>" . $conn->error;
               header("Location: customer_cart.php");
               exit();
           }
        
           $insertOrderItems = "INSERT INTO order_items (order_id,product_id,quantity )
            VALUES ('$last_order_id','$product_id','$quantity')";
           // Execute the query
           if($conn->query($insertOrderItems)){
        
            $deleteQuery = "DELETE FROM carts WHERE id='$cart_id' ";
            $conn->query($deleteQuery);
            $_SESSION['success']="All Confirmed Successfully";
            header("Location:customer_cart.php ");
           }else{
            $_SESSION['error']="Error: " . $insertOrderItems . "<br>" . $conn->error;
            header("Location:customer_cart.php");
           }

        }
    }else{
        $_SESSION['error']="Error: " . $selectCart . "<br>" . $conn->error;
        header("Location:customer_cart.php ");
    }


}else{
    if(! isset($_SESSION['id'] )){
        header("Location:../../authentication/login.php");
        exit();
    }
        
    if($_SESSION['role'] != 'customer'){
    header("Location:../../forbidden_page.php");
    exit();

    }


}