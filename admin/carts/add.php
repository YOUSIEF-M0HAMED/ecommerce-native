<?php 
  include '../../dbconnection.php';
    session_start();
    if(isset($_SESSION['id']) && $_SESSION['role'] == 'customer' ){
        
    if(  isset($_POST['product_id']) && isset($_POST['quantity']) ){


    
    $customer_id=$_SESSION['id'];
         
if(empty($_POST['product_id'])){
    $_SESSION['error']="product id  is required";
    header("Location:../../index.php ");
    exit();
}

    $product_id=$_POST['product_id'];

    $selectQuery2="SELECT * FROM products WHERE id='$product_id' ";
    $result2=$conn->query($selectQuery2); 
    if ($result2->num_rows > 0) {
    $product=$result2->fetch_assoc();
    }else{
        $_SESSION['error']="Error: " . $selectQuery2 . "<br>" . $conn->error;
        header("Location:../../index.php ");
        }

$product_price=$product['price'];



        if(empty($_POST['quantity'])){
            $_SESSION['error']="quantity field is required";
            header("Location:../../index.php ");
            exit();
        }
        
            $quantity=$_POST['quantity'];   

            $total_price=$product_price*$quantity;
            $insertQuery = "INSERT INTO carts (customer_id,product_id,quantity,total_price )
             VALUES ('$customer_id','$product_id','$quantity','$total_price')";
            // Execute the query
            if ($conn->query($insertQuery) === TRUE) {
                
                $_SESSION['success']=" Added To Cart Successfully";
                header("location: ../../index.php");

            } else {
                $_SESSION['error']="Error: " . $insertQuery . "<br>" . $conn->error;
                header("Location:../../index.php ");
            }




    }else{
        $_SESSION['error']="Error on submitting data ";
        header("Location:../../index.php ");
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

    
       