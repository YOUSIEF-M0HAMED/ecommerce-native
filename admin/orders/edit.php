<?php 
    include '../../dbconnection.php';
    session_start();
    if($_SESSION['role']==="admin" ){

    if(isset($_GET['order_id']) ){
        
        if(empty($_GET['order_id'])){
            $_SESSION['error']="Order ID is required";
            header("Location:display_all.php ");
            exit();
        }
        $order_id=$_GET['order_id'];
       
        $selectQuery = "SELECT * FROM orders where id = '$order_id' ";
        $result = $conn->query($selectQuery);

        if ($result) 
            $old_order=$result->fetch_assoc();

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order info</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        z-index: 100;
        padding: 48px 0 0;
        box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
    }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo  $_SESSION['username'] ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="../users/edit.php?user_id=<?php echo $_SESSION['id'] ?>">Edit
                            Profile</a>
                        <a class="dropdown-item" href="../../authentication/logout.php">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <h2 class="sidebar-heading">Admin Panel</h2>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('usersItemList')">
                                <h5>Users</h5>
                            </button>
                            <ul class="item-list" id="usersItemList" style="display: none;">
                                <li><a class="dropdown-item" href="../users/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="../users/display_all.php">View all </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('categoriesItemList')">
                                <h5>Categories</h5>
                            </button>
                            <ul class="item-list" id="categoriesItemList" style="display: none;">
                                <li><a class="dropdown-item" href="../categories/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="../categories/display_all.php">View all </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('productsItemList')">
                                <h5>Products</h5>
                            </button>
                            <ul class="item-list" id="productsItemList" style="display: none;">
                                <li><a class="dropdown-item" href="../products/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="../products/display_all.php">View all </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('ordersItemList')">
                                <h5>Orders</h5>
                            </button>
                            <ul class="item-list" id="ordersItemList" style="display: none;">
                                <li><a class="dropdown-item" href="create.php">Create</a></li>
                                <li><a class="dropdown-item" href="display_all.php">View all </a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('orderItemsItemList')">
                                <h5>Order Items</h5>
                            </button>
                            <ul class="item-list" id="orderItemsItemList" style="display: none;">
                                <li><a class="dropdown-item" href="../order_items/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="../order_items/display_all.php">View all </a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <button class="btn btn-block nav-link" onclick="toggleItemList('cartsItemsItemList')">
                                <h5>Carts</h5>
                            </button>
                            <ul class="item-list" id="cartsItemsItemList" style="display: none;">
                                <li><a class="dropdown-item" href="../carts/create.php">Create</a></li>
                                <li><a class="dropdown-item" href="../carts/display_all.php">View all </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- End of Sidebar -->


            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="content">

                    <div class="container">
                        <h2>Edit Order : <?php echo $old_order['id'] ?></h2>
                        <?php
        
        if (isset($_SESSION['error'])) { 
            ?>
                        <div class="alert alert-danger" role="alert">
                            <p> <?php echo $_SESSION['error']; ?></p>
                        </div>
                        <?php
             }
        unset($_SESSION['error']);
       

        if (isset($_SESSION['success'])) { 
                    ?>
                        <div class="alert alert-success" role="alert">
                            <p> <?php echo $_SESSION['success']; ?></p>
                        </div>
                        <?php
                    }
                unset($_SESSION['success']);
                ?>

                        <form action="update.php" method="POST">


                            <div class="form-group">
                                <label for="name">Chose Customer </label>
                                <select class="form-control" name="customer_id">
                                    <?php
                    $query="SELECT * FROM users WHERE role = 'customer'";
                    $result=$conn->query($query);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()){
                    ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['username'] ?> </option>
                                    <?php 
                        }
                    }else{
                        echo "Error: " . $query . "<br>" . $conn->error;
                    }
                
                    ?>
                                </select>
                            </div>


                            <input type="hidden" name="order_id" value=" <?php echo $order_id ?> ">
                            <button type="submit" class="btn btn-primary">UPDATE</button>
                        </form>
                    </div>

                </div>
            </main>

        </div>
        <!-- End of Row -->
    </div>

    <!-- Include Bootstrap JS (optional, for certain components) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>


    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    function toggleItemList(itemListId) {
        var itemList = document.getElementById(itemListId);
        if (itemList.style.display === "none") {
            itemList.style.display = "block";
        } else {
            itemList.style.display = "none";
        }
    }
    </script>
</body>

</html>
<?php 
    }else{
        echo "order id is not found";
    }
}else{
    header("Location: ../../forbidden_page.php");
    }
    ?>