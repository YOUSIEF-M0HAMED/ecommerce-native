<?php 
include_once "../../dbconnection.php";
session_start();

if(! isset($_SESSION['id'] )){
    header("Location:../../authentication/login.php");
    exit();
}
    
if($_SESSION['role'] != 'customer'){
header("Location:../../forbidden_page.php");
exit();
}

if ($_SESSION['role'] == 'customer') {
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <div class="container">

        <h1>Your Cart</h1>

        <?php
        
        if (isset($_SESSION['success'])) { 
            ?>
        <div class="alert alert-success" role="alert">
            <p> <?php echo $_SESSION['success']; ?></p>
        </div>
        <?php
             }
        unset($_SESSION['success']);

        if (isset($_SESSION['error'])) { 
            ?>
        <div class="alert alert-error" role="alert">
            <p> <?php echo $_SESSION['error']; ?></p>
        </div>
        <?php
             }
        unset($_SESSION['error']);
        ?>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>customer ID</th>
                    <th>Product ID</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Created_at</th>
                    <th>Updated_at</th>
                    <th>Actions</th>
                    <!-- Add more columns as needed -->
                </tr>
            </thead>

            <?php 

             $current_user_id=$_SESSION['id'];
             $selectQuery = "SELECT * FROM carts WHERE customer_id = '$current_user_id' ";
             $result = $conn->query($selectQuery);

             if ($result) {
              while ($row = $result->fetch_assoc()) {

            ?>
            <tbody id="user-table-body">
                <tr>
                    <td><?php echo $row['customer_id'] ?> </td>
                    <td><?php echo $row['product_id'] ?></td>
                    <td><?php echo $row['quantity'] ?></td>
                    <td><?php echo $row['total_price'] ?></td>
                    <td><?php echo $row['created_at'] ?></td>
                    <td><?php echo $row['updated_at'] ?></td>
                    <td>

                        <a href="confirm_one.php?cart_id=<?php echo $row['id'] ?>"
                            class="btn btn-primary btn-sm edit-btn">Confirm</a>

                        <a href="delete_one.php?cart_id=<?php echo $row['id'] ?>"
                            class="btn btn-danger btn-sm delete-btn">Delete</a>

                    </td>
                    <!-- Add more columns as needed -->
                </tr>
            </tbody>
            <?php 
              }
            }else{
                $_SESSION['error']="Error: " . $selectQuery . "<br>" . $conn->error;
                header("Location:customer_cart.php");
            }
                ?>



        </table>


    </div>

    <?php 
if ($result && $result->num_rows > 0) {    ?>
    <div class="container" style="text-align: center; margin-top: 50px">
        <a href="confirm_all.php" class="btn btn-primary btn-sm edit-btn" style="width:200px;">Confirm All</a>

        <a href="delete_all.php" class="btn btn-danger btn-sm delete-btn" style="width:200px;">Delete All</a>

    </div>
    <?php 
}
?>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php 
}else{
    if(! isset($_SESSION['id'] )){
        header("Location:../../authentication/login.php");
    }
        
    if($_SESSION['role'] == 'admin'){
    header("Location:../../forbidden_page.php");

    }
}
?>